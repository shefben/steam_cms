<?php
ob_start();
require_once 'admin_header.php';
$admin_header = ob_get_clean();
cms_require_permission('manage_pages');
$db = cms_get_db();

// Get current theme and available versions
$theme = cms_get_setting('theme', '2004');
$availableVersions = [];
$defaultVersion = '';

if ($theme === '2003_v2') {
    $availableVersions = [
        'v1' => 'Version 1',
        'v2' => 'Version 2', 
        'v3' => 'Version 3'
    ];
    $defaultVersion = 'v2';
} elseif ($theme === '2004') {
    $availableVersions = [
        'v1' => 'Version 1',
        'v2' => 'Version 2',
        'v3' => 'Version 3'
    ];
    $defaultVersion = 'v3';
}

$selectedVersion = $_GET['version'] ?? $defaultVersion;

// Render type options based on theme and version
function getRenderOptions($theme, $version) {
    $main = [
        'title_size_mirrors_buttons' => 'Title (with size) w/ mirrors as buttons',
        'title_size_mirrors_links' => 'Title (with size) w/ mirrors as links',
        'title_no_size_mirrors_links' => 'Title (no size) w/ mirrors as links',
        'mirrors_buttons_no_title' => 'Mirrors as buttons w/o title',
        'single_button' => 'Single button',
        'single_link' => 'Single link',
        'title_single_link_with_size' => 'Title w/ single link with size next to link as text'
    ];

    $floating = [];

    if ($theme === '2004' && ($version === 'v2' || $version === 'v3')) {
        $floating = [
            'single_link' => 'Single link',
            'title_no_size_mirrors_links' => 'Title (no size) w/ mirrors as links'
        ];
    }

    return [
        'main_content' => $main,
        'floating_box' => $floating
    ];
}

// AJAX handlers
if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');
    
    if (isset($_GET['load_version'])) {
        $version = $_GET['version'] ?? $defaultVersion;
        
        // Get files with their version-specific settings
        $sql = "SELECT df.id, df.title, df.file_size,
                       COALESCE(dfv.is_visible, 1) as is_visible,
                       COALESCE(dfv.render_type, 'title_size_mirrors_buttons') as render_type,
                       COALESCE(dfv.location, 'main_content') as location,
                       COALESCE(dfv.sort_order, df.sort_order, 0) as sort_order
                FROM download_files df
                LEFT JOIN download_file_versions dfv ON df.id = dfv.file_id
                    AND dfv.theme = ? AND dfv.page_version = ?
                ORDER BY COALESCE(dfv.sort_order, df.sort_order, 0), df.id";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([$theme, $version]);
        $files = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Get mirror counts
        foreach ($files as &$file) {
            $cnt = $db->prepare('SELECT COUNT(*) FROM download_file_mirrors WHERE file_id=?');
            $cnt->execute([$file['id']]);
            $file['mirror_count'] = $cnt->fetchColumn();
        }
        
        echo json_encode([
            'files' => $files,
            'render_options' => getRenderOptions($theme, $version)
        ]);
        exit;
    }
    
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $stmt = $db->prepare('SELECT * FROM download_files WHERE id=?');
        $stmt->execute([$id]);
        $file = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($file) {
            $m = $db->prepare('SELECT host,url FROM download_file_mirrors WHERE file_id=? ORDER BY ord,id');
            $m->execute([$id]);
            $file['mirrors'] = $m->fetchAll(PDO::FETCH_ASSOC);
        }
        echo json_encode($file);
        exit;
    }
}

// POST handlers
if (isset($_POST['ajax'])) {
    if (isset($_POST['update_file_settings'])) {
        $fileId = (int)$_POST['file_id'];
        $version = $_POST['version'];
        $isVisible = isset($_POST['is_visible']) ? 1 : 0;
        $renderType = $_POST['render_type'];
        $location = $_POST['location'] ?? 'main_content';
        $sortOrder = (int)$_POST['sort_order'];

        // Update or insert version settings
        $stmt = $db->prepare('
            INSERT INTO download_file_versions (file_id, theme, page_version, is_visible, render_type, location, sort_order)
            VALUES (?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
                is_visible = VALUES(is_visible),
                render_type = VALUES(render_type),
                location = VALUES(location),
                sort_order = VALUES(sort_order),
                updated_at = CURRENT_TIMESTAMP
        ');
        $stmt->execute([$fileId, $theme, $version, $isVisible, $renderType, $location, $sortOrder]);
        
        echo 'ok';
        exit;
    }
    
    if (isset($_POST['update_sort_order'])) {
        $items = $_POST['items'] ?? [];
        $version = $_POST['version'];
        
        foreach ($items as $index => $fileId) {
            $stmt = $db->prepare('
                INSERT INTO download_file_versions (file_id, theme, page_version, sort_order)
                VALUES (?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                    sort_order = VALUES(sort_order),
                    updated_at = CURRENT_TIMESTAMP
            ');
            $stmt->execute([(int)$fileId, $theme, $version, $index + 1]);
        }
        
        echo 'ok';
        exit;
    }
    
    if (isset($_POST['delete'])) {
        $id = (int)$_POST['delete'];
        $db->prepare('DELETE FROM download_files WHERE id=?')->execute([$id]);
        echo 'ok';
        exit;
    }
    
    // File create/update
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $title = trim($_POST['title']);
    $desc = $_POST['description'];
    $size = trim($_POST['file_size']);
    $url = trim($_POST['main_url']);
    $usingButton = isset($_POST['usingbutton']) ? 1 : 0;
    $buttonText = trim($_POST['buttonText'] ?? '');
    
    if (isset($_FILES['main_file']) && $_FILES['main_file']['tmp_name']) {
        $fname = basename($_FILES['main_file']['name']);
        $dest = CMS_ROOT.'/downloads/'.$fname;
        move_uploaded_file($_FILES['main_file']['tmp_name'], $dest);
        $url = 'downloads/'.$fname;
    }
    
    if ($id) {
        $stmt = $db->prepare('UPDATE download_files SET title=?,description=?,file_size=?,main_url=?,usingbutton=?,buttonText=?,updated=NOW() WHERE id=?');
        $stmt->execute([$title, $desc, $size, $url, $usingButton, $buttonText, $id]);
        $db->prepare('DELETE FROM download_file_mirrors WHERE file_id=?')->execute([$id]);
    } else {
        $stmt = $db->prepare('INSERT INTO download_files(title,description,file_size,main_url,usingbutton,buttonText,created,updated) VALUES(?,?,?,?,?,?,NOW(),NOW())');
        $stmt->execute([$title, $desc, $size, $url, $usingButton, $buttonText]);
        $id = $db->lastInsertId();
    }
    
    if (isset($_POST['mirror_urls']) && is_array($_POST['mirror_urls'])) {
        $hosts = $_POST['mirror_hosts'] ?? [];
        $urls = $_POST['mirror_urls'];
        $m = $db->prepare('INSERT INTO download_file_mirrors(file_id,host,url,ord) VALUES(?,?,?,?)');
        $ord = 1;
        foreach ($urls as $i => $u) {
            $u = trim($u); 
            $h = trim($hosts[$i] ?? ''); 
            if ($u === '') continue;
            $m->execute([$id, $h, $u, $ord++]);
        }
    }
    
    echo 'ok';
    exit;
}

echo $admin_header;
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

<h2>Download File Management</h2>

<!-- Version Selection -->
<div class="version-selector" style="margin-bottom: 20px;">
    <label for="versionSelect">Page Version:</label>
    <select id="versionSelect">
        <?php foreach ($availableVersions as $value => $label): ?>
            <option value="<?php echo $value; ?>" <?php echo $value === $selectedVersion ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($label); ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<!-- Files Table -->
<table class="data-table" id="filesTable">
    <thead>
        <tr>
            <th>Sort</th>
            <th>ID</th>
            <th>Filename</th>
            <th>File Size</th>
            <th>Mirrors</th>
            <th>Visible</th>
            <th>Location</th>
            <th>Rendering</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="filesTableBody">
        <!-- Will be populated by AJAX -->
    </tbody>
</table>

<button id="addFile" class="btn btn-primary" style="margin-top: 10px;">Add Download</button>

<!-- Modal -->
<div id="modalOverlay" style="display:none;"></div>
<div id="fileModal" style="display:none;" aria-modal="true" role="dialog">
    <form id="fileForm">
        <input type="hidden" name="id" id="fileId">
        <label class="half">File title <input type="text" name="title" id="fileTitle" required></label>
        <label class="half">File size <input type="text" name="file_size" id="fileSize"></label>
        <div class="full-width">
            <label>Description</label>
            <div id="descToolbar">
                <button type="button" data-cmd="bold"><b>B</b></button>
                <button type="button" data-cmd="italic"><i>I</i></button>
                <button type="button" data-cmd="underline"><u>U</u></button>
            </div>
            <div id="fileDesc" class="wysiwyg" contenteditable="true"></div>
            <input type="hidden" name="description" id="fileDescInput">
        </div>
        <div class="full-width">
            <label>Main download <input type="text" name="main_url" id="fileUrl"><input type="file" name="main_file"></label>
        </div>
        <div id="mirrorFields" class="full-width">
            <!-- mirrors -->
            <button type="button" id="addMirror">+</button>
        </div>
        <label class="full-width" style="margin-top:8px;">
            <input type="checkbox" name="usingbutton" id="usingButton"> Generate Steam Download Button (2004 theme only!)
            <input type="text" name="buttonText" id="buttonText" style="width:60%;" disabled>
        </label>
        <div class="full-width actions">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" id="cancelBtn" class="btn">Cancel</button>
        </div>
        <input type="hidden" name="ajax" value="1">
    </form>
</div>

<script>
$(function() {
    let currentVersion = '<?php echo $selectedVersion; ?>';
    let renderOptions = {};
    let sortable;
    
    // Load files for selected version
    function loadFiles(version) {
        $.get('download_files.php', {ajax: 1, load_version: 1, version: version}, function(data) {
            renderOptions = data.render_options;
            renderFilesTable(data.files);
            initializeSortable();
        }, 'json');
    }
    
    // Render files table
    function renderFilesTable(files) {
        const tbody = $('#filesTableBody');
        tbody.empty();
        
        files.forEach(function(file) {
            const visibleChecked = file.is_visible == 1 ? 'checked' : '';
            const locationSelect = createLocationSelect(file.location, file.id);
            const renderSelect = createRenderSelect(file.render_type, file.id, file.location);
            
            const row = `
                <tr data-id="${file.id}">
                    <td class="sort-handle" style="cursor: move;">⋮⋮</td>
                    <td>${file.id}</td>
                    <td>${escapeHtml(file.title)}</td>
                    <td>${escapeHtml(file.file_size || '')}</td>
                    <td>${file.mirror_count}</td>
                    <td><input type="checkbox" class="visible-checkbox" data-id="${file.id}" ${visibleChecked}></td>
                    <td>${locationSelect}</td>
                    <td>${renderSelect}</td>
                    <td>
                        <button class="edit btn btn-small" data-id="${file.id}">Edit</button>
                        <button class="delete btn btn-small" data-id="${file.id}">Delete</button>
                    </td>
                </tr>
            `;
            tbody.append(row);
        });
        
        // Attach event handlers
        $('.visible-checkbox').on('change', updateFileSettings);
        $('.render-select').on('change', updateFileSettings);
        $('.location-select').on('change', function() {
            const row = $(this).closest('tr');
            const fileId = $(this).data('id');
            const loc = $(this).val();
            // Rebuild render options based on new location
            row.find('.render-select').replaceWith(createRenderSelect(row.find('.render-select').val(), fileId, loc));
            row.find('.render-select').on('change', updateFileSettings);
            updateFileSettings.call(this);
        });
        $('#filesTable').off('click', '.edit').on('click', '.edit', editFile);
        $('#filesTable').off('click', '.delete').on('click', '.delete', deleteFile);
    }
    
    // Create render type select
    function createRenderSelect(selectedValue, fileId, location) {
        let options = '';
        const loc = location || 'main_content';
        const optSource = renderOptions[loc] || {};
        for (const [value, label] of Object.entries(optSource)) {
            const selected = value === selectedValue ? 'selected' : '';
            options += `<option value="${value}" ${selected}>${escapeHtml(label)}</option>`;
        }
        return `<select class="render-select" data-id="${fileId || ''}">${options}</select>`;
    }

    function createLocationSelect(selectedValue, fileId) {
        let options = '<option value="main_content"' + (selectedValue === 'main_content' ? ' selected' : '') + '>Main Content</option>';
        if (renderOptions.floating_box && Object.keys(renderOptions.floating_box).length > 0) {
            options += '<option value="floating_box"' + (selectedValue === 'floating_box' ? ' selected' : '') + '>Floating Box</option>';
        }
        return `<select class="location-select" data-id="${fileId || ''}">${options}</select>`;
    }
    
    // Update file settings
    function updateFileSettings() {
        const fileId = $(this).data('id');
        const row = $(this).closest('tr');
        const isVisible = row.find('.visible-checkbox').is(':checked');
        const renderType = row.find('.render-select').val();
        const location = row.find('.location-select').val();
        const sortOrder = row.index() + 1;

        $.post('download_files.php', {
            ajax: 1,
            update_file_settings: 1,
            file_id: fileId,
            version: currentVersion,
            is_visible: isVisible ? 1 : 0,
            render_type: renderType,
            location: location,
            sort_order: sortOrder
        });
    }
    
    // Initialize sortable
    function initializeSortable() {
        if (sortable) {
            sortable.destroy();
        }
        
        sortable = new Sortable(document.getElementById('filesTableBody'), {
            handle: '.sort-handle',
            animation: 150,
            onEnd: function() {
                const items = [];
                $('#filesTableBody tr').each(function() {
                    items.push($(this).data('id'));
                });
                
                $.post('download_files.php', {
                    ajax: 1,
                    update_sort_order: 1,
                    version: currentVersion,
                    items: items
                });
            }
        });
    }
    
    // Version change handler
    $('#versionSelect').on('change', function() {
        currentVersion = $(this).val();
        loadFiles(currentVersion);
        
        // Update URL without refresh
        const url = new URL(window.location);
        url.searchParams.set('version', currentVersion);
        window.history.replaceState({}, '', url);
    });
    
    // File editing functions
    function editFile() {
        const id = $(this).data('id');
        $.get('download_files.php', {ajax: 1, id: id}, function(d) {
            $('#fileForm')[0].reset();
            $('#mirrorFields .mirror-row').remove();
            $('#addMirror').show();
            
            $('#fileId').val(d.id);
            $('#fileTitle').val(d.title);
            $('#fileDesc').html(d.description);
            $('#fileDescInput').val(d.description);
            $('#fileSize').val(d.file_size);
            $('#fileUrl').val(d.main_url);
            
            if (d.usingbutton == 1) {
                $('#usingButton').prop('checked', true);
                $('#buttonText').prop('disabled', false).val(d.buttonText);
            } else {
                $('#usingButton').prop('checked', false);
                $('#buttonText').prop('disabled', true).val('');
            }
            
            if (d.mirrors) {
                d.mirrors.forEach(function(m) {
                    addMirror(m.host, m.url);
                });
                if ($('#mirrorFields .mirror-row').length >= 10) {
                    $('#addMirror').hide();
                }
            }
            
            openModal();
        }, 'json');
    }
    
    function deleteFile() {
        if (confirm('Delete this file?')) {
            const id = $(this).data('id');
            $.post('download_files.php', {ajax: 1, delete: id}, function() {
                loadFiles(currentVersion);
            });
        }
    }
    
    // Mirror management
    function addMirror(host, url) {
        const cnt = $('#mirrorFields .mirror-row').length;
        if (cnt >= 10) return;
        
        const row = $(`
            <div class="mirror-row">
                <input type="text" name="mirror_hosts[]" placeholder="Host ${cnt + 1}" value="${host || ''}">
                <input type="text" name="mirror_urls[]" placeholder="URL ${cnt + 1}" value="${url || ''}">
            </div>
        `);
        row.insertBefore('#addMirror');
        
        if (cnt >= 9) $('#addMirror').hide();
    }
    
    $('#addMirror').on('click', function() { addMirror(); });
    
    // Modal functions
    function openModal() { $('#modalOverlay').show(); $('#fileModal').show(); }
    function closeModal() { $('#modalOverlay').hide(); $('#fileModal').hide(); }
    
    $('#modalOverlay').on('click', closeModal);
    $('#addFile').on('click', function() {
        $('#fileForm')[0].reset();
        $('#mirrorFields .mirror-row').remove();
        $('#addMirror').show();
        $('#fileId').val('');
        $('#usingButton').prop('checked', false);
        $('#buttonText').prop('disabled', true).val('');
        $('#fileDesc').empty();
        $('#fileDescInput').val('');
        openModal();
    });
    
    $('#cancelBtn').on('click', closeModal);
    $('#fileForm').on('submit', function(e) {
        e.preventDefault();
        $('#fileDescInput').val($('#fileDesc').html());
        const fd = new FormData(this);
        $.ajax({
            url: 'download_files.php',
            method: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            success: function() {
                closeModal();
                loadFiles(currentVersion);
            }
        });
    });
    
    $('#usingButton').on('change', function() {
        $('#buttonText').prop('disabled', !this.checked);
    });
    
    $('#descToolbar button').on('click', function() {
        document.execCommand($(this).data('cmd'), false, null);
    });
    
    // Utility function
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    // Initial load
    loadFiles(currentVersion);
});
</script>

<style>
#modalOverlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 999;
}

#fileModal {
    background: #fff;
    border: 1px solid #333;
    padding: 20px;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
    width: 80%;
    max-width: 900px;
    max-height: 90vh;
    overflow-y: auto;
}

#fileModal form {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

#fileModal label {
    display: block;
    margin-top: 5px;
}

#fileModal label.half {
    width: 48%;
}

#fileModal .full-width {
    width: 100%;
}

#fileModal .actions {
    margin-top: 10px;
}

.mirror-row {
    margin-bottom: 4px;
}

.mirror-row input[type=text] {
    margin-right: 4px;
}

#descToolbar button {
    margin-right: 4px;
}

.wysiwyg {
    border: 1px solid #ccc;
    min-height: 100px;
    padding: 4px;
}

.version-selector {
    background: #f5f5f5;
    padding: 10px;
    border-radius: 4px;
}

.version-selector label {
    font-weight: bold;
    margin-right: 10px;
}

.version-selector select {
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 3px;
}

.sort-handle {
    text-align: center;
    font-weight: bold;
    color: #999;
}

.data-table th, .data-table td {
    padding: 8px;
    border: 1px solid #ddd;
}

.data-table th {
    background: #f5f5f5;
    font-weight: bold;
}

.btn {
    padding: 6px 12px;
    border: 1px solid #ddd;
    background: #fff;
    cursor: pointer;
    border-radius: 3px;
}

.btn-primary {
    background: #007cba;
    color: white;
    border-color: #005a87;
}

.btn-small {
    padding: 4px 8px;
    font-size: 12px;
}

.render-select {
    width: 100%;
    padding: 4px;
}
</style>

<?php include 'admin_footer.php'; ?>