<?php
ob_start();
require_once 'admin_header.php';
$admin_header = ob_get_clean();
cms_require_permission('manage_pages');
$db = cms_get_db();
$langs = ['en','fr','de','it','es'];
$lang = in_array($_GET['lang'] ?? '', $langs, true) ? $_GET['lang'] : $langs[0];

// AJAX endpoints
if (isset($_GET['ajax']) && $_GET['ajax'] === 'get_graph') {
    $reqLang = in_array($_GET['lang'] ?? '', $langs, true) ? $_GET['lang'] : $langs[0];
    
    $stmt = $db->prepare('SELECT id, slug as file, title as label, content FROM troubleshooter_pages WHERE lang=?');
    $stmt->execute([$reqLang]);
    $nodes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($nodes as &$n) {
        $n['id'] = $n['file']; // use slug as node id
        if ($n['file'] === 's_main') $n['group'] = 'root';
        else $n['group'] = 'leaf';
    }
    
    $stmt = $db->prepare('SELECT id, from_slug as `from`, to_slug as `to`, label FROM troubleshooter_edges WHERE lang=?');
    $stmt->execute([$reqLang]);
    $edges = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode(['nodes' => $nodes, 'edges' => $edges]);
    exit;
}

if (isset($_POST['ajax'])) {
    header('Content-Type: application/json');
    $reqLang = in_array($_POST['lang'] ?? '', $langs, true) ? $_POST['lang'] : $langs[0];
    
    if ($_POST['ajax'] === 'save_node') {
        $slug = preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['file']);
        $title = trim($_POST['label']);
        $content = $_POST['content'];
        $original_slug = isset($_POST['original_file']) ? preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['original_file']) : '';
        
        $stmt = $db->prepare('SELECT id FROM troubleshooter_pages WHERE lang=? AND slug=?');
        $stmt->execute([$reqLang, $original_slug ?: $slug]);
        $row = $stmt->fetch();
        
        if ($row) {
            $stmt = $db->prepare('UPDATE troubleshooter_pages SET slug=?, title=?, content=?, updated=NOW() WHERE id=?');
            $stmt->execute([$slug, $title, $content, $row['id']]);
            
            if ($original_slug && $original_slug !== $slug) {
                $db->prepare('UPDATE troubleshooter_edges SET from_slug=? WHERE lang=? AND from_slug=?')->execute([$slug, $reqLang, $original_slug]);
                $db->prepare('UPDATE troubleshooter_edges SET to_slug=? WHERE lang=? AND to_slug=?')->execute([$slug, $reqLang, $original_slug]);
            }
        } else {
            $stmt = $db->prepare('INSERT INTO troubleshooter_pages(lang,slug,title,content,created,updated) VALUES(?,?,?,?,NOW(),NOW())');
            $stmt->execute([$reqLang, $slug, $title, $content]);
        }
        echo json_encode(['success' => true]);
        exit;
    }
    
    if ($_POST['ajax'] === 'delete_node') {
        $slug = preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['file']);
        $db->prepare('DELETE FROM troubleshooter_pages WHERE lang=? AND slug=?')->execute([$reqLang, $slug]);
        $db->prepare('DELETE FROM troubleshooter_edges WHERE lang=? AND (from_slug=? OR to_slug=?)')->execute([$reqLang, $slug, $slug]);
        echo json_encode(['success' => true]);
        exit;
    }
    
    if ($_POST['ajax'] === 'save_edge') {
        $from = preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['from']);
        $to = preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['to']);
        $label = trim($_POST['label']);
        
        $stmt = $db->prepare('SELECT id FROM troubleshooter_edges WHERE lang=? AND from_slug=? AND to_slug=?');
        $stmt->execute([$reqLang, $from, $to]);
        if ($row = $stmt->fetch()) {
            $db->prepare('UPDATE troubleshooter_edges SET label=? WHERE id=?')->execute([$label, $row['id']]);
            echo json_encode(['success' => true, 'id' => $row['id']]);
        } else {
            $db->prepare('INSERT INTO troubleshooter_edges(lang, from_slug, to_slug, label) VALUES(?,?,?,?)')->execute([$reqLang, $from, $to, $label]);
            echo json_encode(['success' => true, 'id' => $db->lastInsertId()]);
        }
        exit;
    }
    
    if ($_POST['ajax'] === 'delete_edge') {
        $id = (int)$_POST['id'];
        $db->prepare('DELETE FROM troubleshooter_edges WHERE id=? AND lang=?')->execute([$id, $reqLang]);
        echo json_encode(['success' => true]);
        exit;
    }
}

echo $admin_header;
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script type="text/javascript" src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>

<style>
    /* Scoped container for the Troubleshooter Editor */
    .ts-editor-wrapper {
        --steam-dark: #1e2321;
        --steam-panel: #2b322f;
        --steam-green: #678b40;
        --steam-green-light: #82a853;
        --steam-text: #c0c6c0;
        --steam-text-bright: #e1e8e1;
        --steam-border: #3f4743;
        --steam-danger: #a54040;
        
        background-color: var(--steam-dark);
        color: var(--steam-text);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        height: 85vh;
        display: flex;
        flex-direction: column;
        border: 1px solid var(--steam-border);
        border-radius: 8px;
        overflow: hidden;
        margin-top: 15px;
    }
    .ts-editor-wrapper * {
        box-sizing: border-box;
    }

    .ts-editor-wrapper .ts-header {
        background: linear-gradient(to right, #1a1e1d, #27302c);
        border-bottom: 1px solid var(--steam-border);
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .ts-editor-wrapper .ts-title {
        color: var(--steam-text-bright);
        font-weight: 700;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .ts-editor-wrapper .ts-title i { color: var(--steam-green); }

    .ts-workspace {
        display: flex;
        flex: 1;
        overflow: hidden;
    }

    #network-container {
        flex: 1;
        position: relative;
        background: radial-gradient(circle at center, #232927 0%, #171b19 100%);
    }

    #mynetwork {
        width: 100%;
        height: 100%;
        outline: none;
    }

    .graph-toolbar {
        position: absolute;
        top: 20px;
        left: 20px;
        display: flex;
        gap: 10px;
        background: rgba(43, 50, 47, 0.8);
        padding: 8px;
        border-radius: 8px;
        border: 1px solid var(--steam-border);
        z-index: 10;
    }

    .btn-toolbar-action {
        background: transparent;
        border: 1px solid transparent;
        color: var(--steam-text);
        padding: 6px 10px;
        border-radius: 4px;
        transition: all 0.2s;
        cursor: pointer;
    }
    .btn-toolbar-action:hover {
        background: var(--steam-green);
        color: white;
    }

    .ts-edit-panel {
        width: 400px;
        background-color: var(--steam-panel);
        border-left: 1px solid var(--steam-border);
        display: flex;
        flex-direction: column;
        box-shadow: -5px 0 25px rgba(0,0,0,0.3);
        z-index: 5;
    }

    .ts-panel-header {
        padding: 15px 20px;
        border-bottom: 1px solid var(--steam-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .ts-panel-header h3 { margin: 0; font-size: 1rem; color: var(--steam-text-bright); font-weight: 600; }

    .ts-panel-body { padding: 20px; overflow-y: auto; flex: 1; }

    .ts-form-label { font-size: 0.85rem; text-transform: uppercase; color: #8c9791; margin-bottom: 5px; display: block;}
    .ts-form-control, .ts-form-select {
        background-color: #1e2321; border: 1px solid var(--steam-border); color: var(--steam-text-bright);
        border-radius: 4px; padding: 8px 10px; width: 100%; transition: border-color 0.2s;
    }
    .ts-form-control:focus, .ts-form-select:focus {
        border-color: var(--steam-green); outline: none; background-color: #1a1e1d; color: white;
    }

    .connection-item {
        display: flex; justify-content: space-between; align-items: center;
        background: #1e2321; padding: 8px 12px; border-radius: 4px; margin-bottom: 8px; border: 1px solid var(--steam-border);
    }
    .connection-item .node-name { font-size: 0.9rem; }
    .btn-remove-conn { color: var(--steam-danger); background: none; border: none; cursor: pointer; padding: 0 5px; }

    .ts-panel-footer {
        padding: 15px 20px; border-top: 1px solid var(--steam-border); background: rgba(30, 35, 33, 0.5); display: flex; gap: 10px;
    }
    
    .btn-steam {
        background: linear-gradient(to bottom, var(--steam-green-light), var(--steam-green)); border: 1px solid #4a6a28; color: white; font-weight: 500;
        padding: 8px 16px; border-radius: 4px; cursor: pointer; flex: 1; transition: all 0.2s;
    }
    .btn-steam:hover { background: linear-gradient(to bottom, #8fba5a, #719946); border-color: #5b8331; color: white; }
    .btn-danger-outline {
        background: transparent; border: 1px solid var(--steam-danger); color: var(--steam-danger); font-weight: 500;
        padding: 8px 16px; border-radius: 4px; cursor: pointer; transition: all 0.2s;
    }
    .btn-danger-outline:hover { background: var(--steam-danger); color: white; }
    
    .empty-state { display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; text-align: center; color: #8c9791; padding: 20px; }
    .empty-state i { font-size: 3rem; margin-bottom: 15px; opacity: 0.5; }
</style>

<h2>Manage Troubleshooter Workflow</h2>
<p class="page-description" style="color:#666;margin-bottom:15px;">Manage troubleshooter guide pages.</p>

<div class="ts-editor-wrapper">
    <div class="ts-header">
        <div class="ts-title"><i class="fa-solid fa-network-wired"></i> Editor</div>
        <div>
            <select class="ts-form-select" style="width: auto; display: inline-block; padding: 5px 10px;" id="lang-selector">
                <?php foreach ($langs as $l) : ?>
                    <option value="<?php echo $l; ?>" <?php echo $l === $lang ? 'selected' : ''; ?>><?php echo strtoupper($l); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <div class="ts-workspace">
        <div id="network-container">
            <div id="mynetwork"></div>
            <div class="graph-toolbar">
                <button class="btn-toolbar-action" id="btn-add-node" title="Add New Page"><i class="fa-solid fa-plus"></i> Add Page</button>
                <div style="width: 1px; background: var(--steam-border); margin: 5px 0;"></div>
                <button class="btn-toolbar-action" id="btn-zoom-in" title="Zoom In"><i class="fa-solid fa-magnifying-glass-plus"></i></button>
                <button class="btn-toolbar-action" id="btn-zoom-out" title="Zoom Out"><i class="fa-solid fa-magnifying-glass-minus"></i></button>
                <button class="btn-toolbar-action" id="btn-fit" title="Fit to Screen"><i class="fa-solid fa-expand"></i></button>
            </div>
        </div>

        <div class="ts-edit-panel">
            <div id="panel-empty" class="empty-state">
                <i class="fa-regular fa-hand-pointer"></i>
                <h5>No Page Selected</h5>
                <p>Click on a bubble in the diagram to view and edit.</p>
            </div>

            <div id="panel-content" style="display: none; height: 100%; flex-direction: column;">
                <div class="ts-panel-header">
                    <h3 id="panel-title">Edit Page</h3>
                    <button class="btn-close btn-close-white" style="font-size: 0.8rem;" id="btn-close-panel"></button>
                </div>
                
                <div class="ts-panel-body">
                    <input type="hidden" id="node-original-file">
                    
                    <div style="margin-bottom: 1rem;">
                        <label class="ts-form-label">Page File / ID</label>
                        <input type="text" class="ts-form-control" id="node-file" placeholder="e.g. s_cd_01">
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label class="ts-form-label">Display Heading</label>
                        <input type="text" class="ts-form-control" id="node-label">
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label class="ts-form-label">Page HTML Content</label>
                        <textarea class="ts-form-control" id="node-content" rows="6"></textarea>
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label class="ts-form-label d-flex justify-content-between align-items-center">
                            Connected Pages
                            <button class="btn-link" style="color:#82a853; text-decoration:none; background:none; border:none; padding:0; cursor:pointer;" id="btn-add-edge"><i class="fa-solid fa-link"></i> Add Link</button>
                        </label>
                        
                        <div id="add-edge-form" style="display:none; background: #1a1e1d; border: 1px solid var(--steam-border); padding: 10px; border-radius: 4px; margin-bottom: 10px;">
                            <select class="ts-form-select" id="edge-target-select" style="margin-bottom: 5px;">
                                <option value="">Select target...</option>
                            </select>
                            <input type="text" class="ts-form-control" id="edge-label" placeholder="Link text" style="margin-bottom: 5px;">
                            <div style="display: flex; gap: 5px;">
                                <button class="btn-steam" style="padding: 4px 8px; font-size: 0.8rem;" id="btn-save-edge">Link</button>
                                <button class="btn-danger-outline" style="padding: 4px 8px; font-size: 0.8rem;" id="btn-cancel-edge">Cancel</button>
                            </div>
                        </div>

                        <div id="connections-list"></div>
                    </div>
                </div>

                <div class="ts-panel-footer">
                    <button class="btn-danger-outline" id="btn-delete-node" title="Delete Page"><i class="fa-solid fa-trash"></i></button>
                    <button class="btn-steam" id="btn-save-node">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let nodes = new vis.DataSet([]);
    let edges = new vis.DataSet([]);
    let network = null;
    let selectedNodeId = null;
    let currentLang = $('#lang-selector').val();

    function initNetwork() {
        let container = document.getElementById('mynetwork');
        let data = { nodes: nodes, edges: edges };
        let options = {
            nodes: {
                shape: 'box', margin: 15, borderWidth: 2,
                font: { color: '#ffffff', size: 14, face: 'Inter' },
                shadow: { enabled: true, color: 'rgba(0,0,0,0.5)', size: 10, x: 3, y: 3 }
            },
            edges: {
                arrows: 'to',
                color: { color: '#55605a', highlight: '#678b40', hover: '#82a853' },
                font: { color: '#a0a8a0', size: 11, background: '#1e2321' },
                smooth: { type: 'cubicBezier', forceDirection: 'vertical', roundness: 0.4 }
            },
            groups: {
                root: { color: { background: '#2e4a21', border: '#678b40', highlight: { background: '#3a5d2a', border: '#82a853' } } },
                leaf: { color: { background: '#202930', border: '#364959', highlight: { background: '#28333b', border: '#4b657a' } } }
            },
            layout: {
                hierarchical: { direction: 'UD', sortMethod: 'directed', levelSeparation: 150, nodeSpacing: 250 }
            },
            physics: false,
            interaction: { hover: true, navigationButtons: false, keyboard: false }
        };
        network = new vis.Network(container, data, options);
        
        network.on("selectNode", function (params) {
            if (params.nodes.length > 0) openEditPanel(params.nodes[0]);
        });
        network.on("deselectNode", function () { closeEditPanel(); });
    }

    function loadGraphData(lang) {
        $.getJSON('troubleshooter_manage.php', { ajax: 'get_graph', lang: lang }, function(data) {
            nodes.clear(); edges.clear();
            nodes.add(data.nodes);
            edges.add(data.edges);
            if(network) network.fit();
        });
    }

    $('#lang-selector').on('change', function() {
        currentLang = $(this).val();
        closeEditPanel();
        loadGraphData(currentLang);
    });

    function openEditPanel(nodeId) {
        selectedNodeId = nodeId;
        const node = nodes.get(nodeId);
        
        $('#node-original-file').val(node.file);
        $('#node-file').val(node.file);
        $('#node-label').val(node.label);
        $('#node-content').val(node.content || '');
        
        refreshConnectionsList(nodeId);
        
        $('#panel-empty').hide();
        $('#panel-content').css('display', 'flex');
    }

    function closeEditPanel() {
        selectedNodeId = null;
        if(network) network.unselectAll();
        $('#panel-empty').css('display', 'flex');
        $('#panel-content').hide();
        $('#add-edge-form').hide();
    }

    function refreshConnectionsList(nodeId) {
        const connList = $('#connections-list').empty();
        const connectedEdges = edges.get({ filter: function (item) { return item.from == nodeId; } });

        if (connectedEdges.length === 0) {
            connList.html('<div style="color: #8c9791; font-size: 0.85rem; font-style: italic;">No outgoing links.</div>');
            return;
        }

        connectedEdges.forEach(edge => {
            const toNode = nodes.get(edge.to);
            const toLabel = toNode ? toNode.label : 'Unknown';
            const edgeText = edge.label ? `"${edge.label}"` : 'Link';
            
            connList.append(`
                <div class="connection-item">
                    <div>
                        <div class="node-name"><i class="fa-solid fa-arrow-turn-down fa-rotate-270" style="font-size: 0.7em; color: var(--steam-green); margin-right: 5px;"></i> ${toLabel}</div>
                        <div style="color: #8c9791; font-size: 0.75rem;">Text: ${edgeText}</div>
                    </div>
                    <button class="btn-remove-conn" onclick="removeEdge('${edge.id}')"><i class="fa-solid fa-xmark"></i></button>
                </div>
            `);
        });
    }

    window.removeEdge = function(edgeId) {
        if(confirm("Remove this link?")) {
            $.post('troubleshooter_manage.php', { ajax: 'delete_edge', id: edgeId, lang: currentLang }, function(res) {
                edges.remove(edgeId);
                if (selectedNodeId) refreshConnectionsList(selectedNodeId);
            }, 'json');
        }
    };

    $('#btn-close-panel').on('click', closeEditPanel);

    $('#btn-save-node').on('click', function() {
        if (!selectedNodeId) return;
        const btn = $(this);
        const originalText = btn.html();
        btn.html('<i class="fa-solid fa-spinner fa-spin"></i> Saving...');
        
        const newFile = $('#node-file').val();
        const newLabel = $('#node-label').val();
        const newContent = $('#node-content').val();
        const originalFile = $('#node-original-file').val();
        
        $.post('troubleshooter_manage.php', {
            ajax: 'save_node', lang: currentLang,
            file: newFile, label: newLabel, content: newContent, original_file: originalFile
        }, function(res) {
            nodes.update({ id: selectedNodeId, file: newFile, label: newLabel, content: newContent });
            $('#node-original-file').val(newFile);
            btn.html('<i class="fa-solid fa-check"></i> Saved');
            setTimeout(() => btn.html(originalText), 2000);
            
            if (originalFile !== newFile) {
                // We changed the slug, need to update local edges in vis.js or just reload graph
                loadGraphData(currentLang);
                setTimeout(() => openEditPanel(newFile), 500); // Re-open after reload
            }
        }, 'json');
    });

    $('#btn-delete-node').on('click', function() {
        if (!selectedNodeId) return;
        if (confirm('Are you sure you want to delete this page and all its connections?')) {
            $.post('troubleshooter_manage.php', { ajax: 'delete_node', file: $('#node-file').val(), lang: currentLang }, function(res) {
                nodes.remove(selectedNodeId);
                closeEditPanel();
            }, 'json');
        }
    });

    $('#btn-add-edge').on('click', function() {
        const select = $('#edge-target-select').empty().append('<option value="">Select target...</option>');
        nodes.get().forEach(n => {
            if (n.id != selectedNodeId) select.append(`<option value="${n.id}">${n.label} (${n.file})</option>`);
        });
        $('#add-edge-form').show();
        $('#edge-label').val('');
    });

    $('#btn-cancel-edge').on('click', () => $('#add-edge-form').hide());

    $('#btn-save-edge').on('click', function() {
        const targetId = $('#edge-target-select').val();
        const label = $('#edge-label').val();
        if (!targetId) return alert("Select a target page.");
        
        const fromSlug = $('#node-file').val();
        
        $.post('troubleshooter_manage.php', {
            ajax: 'save_edge', lang: currentLang, from: fromSlug, to: targetId, label: label
        }, function(res) {
            if(res.success) {
                const existingEdges = edges.get({ filter: e => e.from == fromSlug && e.to == targetId });
                if (existingEdges.length > 0) {
                    edges.update({ id: existingEdges[0].id, label: label });
                } else {
                    edges.add({ id: res.id, from: fromSlug, to: targetId, label: label });
                }
                $('#add-edge-form').hide();
                refreshConnectionsList(selectedNodeId);
            }
        }, 'json');
    });

    $('#btn-add-node').on('click', function() {
        const newSlug = 'new_page_' + new Date().getTime();
        nodes.add({ id: newSlug, file: newSlug, label: 'New Page', content: '', group: 'leaf' });
        network.selectNodes([newSlug]);
        openEditPanel(newSlug);
    });

    $('#btn-zoom-in').on('click', () => network.moveTo({ scale: network.getScale() * 1.2 }));
    $('#btn-zoom-out').on('click', () => network.moveTo({ scale: network.getScale() / 1.2 }));
    $('#btn-fit').on('click', () => network.fit({ animation: true }));

    $(document).ready(function() {
        initNetwork();
        loadGraphData(currentLang);
    });
</script>

<?php include 'admin_footer.php'; ?>
