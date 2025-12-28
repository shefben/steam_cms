<?php
require_once 'admin_header.php';
cms_require_any_permission(['manage_content', 'admin']);
$db = cms_get_db();
$csrfToken = cms_get_csrf_token();
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

// Verify CSRF for POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !cms_verify_csrf($_POST['csrf_token'] ?? '')) {
    http_response_code(400);
    echo 'Invalid CSRF token';
    return;
}

// Handle delete
if (isset($_POST['delete'])) {
    $gid = $_POST['delete'];
    $stmt = $db->prepare('DELETE FROM MarketingMessages WHERE GID = ?');
    $stmt->execute([$gid]);
    cms_admin_log('Deleted marketing message GID: ' . $gid);
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok']);
        return;
    }
    header('Location: marketing_messages.php');
    exit;
}

// Handle save (create/update)
if (isset($_POST['save'])) {
    $gid = trim($_POST['gid'] ?? '');
    $datetime = trim($_POST['datetime'] ?? '');
    $html = $_POST['html'] ?? '';
    $isNew = !empty($_POST['is_new']);

    if ($gid === '' || $datetime === '') {
        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'GID and DateTime are required']);
            return;
        }
    }

    if ($isNew) {
        // Check if GID already exists
        $checkStmt = $db->prepare('SELECT COUNT(*) FROM MarketingMessages WHERE GID = ?');
        $checkStmt->execute([$gid]);
        if ($checkStmt->fetchColumn() > 0) {
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'GID already exists']);
                return;
            }
        }

        $stmt = $db->prepare('INSERT INTO MarketingMessages (GID, DATETIME, HTML) VALUES (?, ?, ?)');
        $stmt->execute([$gid, $datetime, $html]);
        cms_admin_log('Created marketing message GID: ' . $gid);
    } else {
        $stmt = $db->prepare('UPDATE MarketingMessages SET DATETIME = ?, HTML = ? WHERE GID = ?');
        $stmt->execute([$datetime, $html, $gid]);
        cms_admin_log('Updated marketing message GID: ' . $gid);
    }

    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok']);
        return;
    }
    header('Location: marketing_messages.php');
    exit;
}

// Handle fetch single record for editing
if (isset($_GET['fetch']) && isset($_GET['gid'])) {
    $gid = $_GET['gid'];
    $stmt = $db->prepare('SELECT GID, DATETIME, HTML FROM MarketingMessages WHERE GID = ?');
    $stmt->execute([$gid]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    if ($row) {
        echo json_encode([
            'status' => 'ok',
            'gid' => $row['GID'],
            'datetime' => $row['DATETIME'],
            'html' => $row['HTML']
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Not found']);
    }
    return;
}

// Pagination settings
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 20;
$offset = ($page - 1) * $perPage;

// Get filter
$gidFilter = trim($_GET['gid'] ?? '');

// Count total records
$countSql = 'SELECT COUNT(*) FROM MarketingMessages';
$countParams = [];
if ($gidFilter !== '') {
    $countSql .= ' WHERE GID LIKE ?';
    $countParams[] = '%' . $gidFilter . '%';
}
$countStmt = $db->prepare($countSql);
$countStmt->execute($countParams);
$total = (int)$countStmt->fetchColumn();
$pages = max(1, (int)ceil($total / $perPage));

// Fetch records
$sql = 'SELECT GID, DATETIME, SUBSTRING(HTML, 1, 256) AS html_snippet FROM MarketingMessages';
$params = [];
if ($gidFilter !== '') {
    $sql .= ' WHERE GID LIKE ?';
    $params[] = '%' . $gidFilter . '%';
}
$sql .= ' ORDER BY DATETIME DESC LIMIT ? OFFSET ?';
$params[] = $perPage;
$params[] = $offset;

$stmt = $db->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Build table body HTML
$tbodyHtml = '';
foreach ($rows as $row) {
    $gid = htmlspecialchars($row['GID']);
    $datetime = htmlspecialchars($row['DATETIME']);
    $snippet = htmlspecialchars(strip_tags($row['html_snippet']));
    if (strlen($snippet) >= 256) {
        $snippet .= '...';
    }
    $tbodyHtml .= "<tr data-gid=\"{$gid}\">";
    $tbodyHtml .= "<td>{$datetime}</td>";
    $tbodyHtml .= "<td class=\"gid-cell\">{$gid}</td>";
    $tbodyHtml .= "<td class=\"snippet-cell\">{$snippet}</td>";
    $tbodyHtml .= '<td class="actions-cell">';
    $tbodyHtml .= '<button type="button" class="btn btn-primary btn-small edit-btn" data-gid="' . $gid . '">Edit</button> ';
    $tbodyHtml .= '<button type="button" class="btn btn-danger btn-small delete-btn" data-gid="' . $gid . '">Remove</button>';
    $tbodyHtml .= '</td></tr>';
}

// Build pagination HTML
ob_start();
?>
<div class="pagination">
<?php if ($page > 1): ?>
    <button type="button" class="page-nav" data-page="<?php echo $page - 1; ?>">&laquo; Prev</button>
<?php endif; ?>
<?php
$firstEnd = min(5, $pages);
for ($i = 1; $i <= $firstEnd; $i++): ?>
    <a href="?page=<?php echo $i; ?>&gid=<?php echo urlencode($gidFilter); ?>" data-page="<?php echo $i; ?>"<?php if ($i == $page) echo ' class="current"'; ?>><?php echo $i; ?></a>
<?php endfor; ?>
<?php
$lastStart = max($pages - 4, $firstEnd + 1);
if ($lastStart > $firstEnd + 1): ?>
    <span class="ellipsis">...</span>
<?php endif; ?>
<?php for ($i = $lastStart; $i <= $pages; $i++): ?>
    <a href="?page=<?php echo $i; ?>&gid=<?php echo urlencode($gidFilter); ?>" data-page="<?php echo $i; ?>"<?php if ($i == $page) echo ' class="current"'; ?>><?php echo $i; ?></a>
<?php endfor; ?>
<?php if ($page < $pages): ?>
    <button type="button" class="page-nav" data-page="<?php echo $page + 1; ?>">Next &raquo;</button>
<?php endif; ?>
</div>
<?php
$paginationHtml = ob_get_clean();

// AJAX response for table refresh
if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');
    echo json_encode(['tbody' => $tbodyHtml, 'pagination' => $paginationHtml, 'total' => $total]);
    exit;
}
?>
<style>
.gid-cell { font-family: monospace; font-size: 0.9em; }
.snippet-cell { max-width: 400px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.actions-cell { white-space: nowrap; }
#messageModalOverlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; display: flex; align-items: center; justify-content: center; }
#messageModalOverlay .modal { background: #fff; padding: 20px; border-radius: 8px; max-width: 900px; width: 95%; max-height: 90vh; overflow-y: auto; }
#messageModalOverlay .modal-body label { display: block; margin-bottom: 10px; }
#messageModalOverlay .modal-body input[type="text"],
#messageModalOverlay .modal-body input[type="datetime-local"] { width: 100%; padding: 8px; box-sizing: border-box; }
#messageModalOverlay .modal-body textarea { width: 100%; height: 400px; font-family: monospace; font-size: 12px; }
#messageModalOverlay .modal-footer { margin-top: 15px; text-align: right; }
#messageModalOverlay .modal-footer button { margin-left: 10px; }
.pagination { margin: 15px 0; }
.pagination a, .pagination button { margin: 0 3px; padding: 5px 10px; }
.pagination a.current { font-weight: bold; background: #007bff; color: #fff; text-decoration: none; border-radius: 3px; }
</style>

<h2>Marketing Messages</h2>
<p>Manage Steam client marketing message popups from the MarketingMessages database table.</p>

<div id="filter-bar" style="margin-bottom: 10px;">
    <label>Filter by GID: <input type="text" id="filter-gid" value="<?php echo htmlspecialchars($gidFilter); ?>" placeholder="Enter GID..."></label>
    <button type="button" id="apply-filter" class="btn btn-primary">Filter</button>
    <button type="button" id="clear-filter" class="btn btn-secondary">Clear</button>
</div>

<p>Total records: <strong id="total-count"><?php echo $total; ?></strong></p>

<table id="messages-table" class="data-table">
<thead>
    <tr>
        <th>Date/Time</th>
        <th>GID</th>
        <th>HTML Preview</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody id="messages-body">
<?php echo $tbodyHtml; ?>
</tbody>
</table>

<div id="pagination-container">
<?php echo $paginationHtml; ?>
</div>

<p style="margin-top: 20px;">
    <button type="button" id="create-new" class="btn btn-success">Create New</button>
</p>

<p><a href="index.php">Back to Admin</a></p>

<!-- Edit/Create Modal -->
<div id="messageModalOverlay" style="display: none;">
    <div class="modal" role="dialog" aria-modal="true">
        <h3 id="modal-title">Edit Marketing Message</h3>
        <form id="messageForm">
            <input type="hidden" name="is_new" id="isNew" value="0">
            <div class="modal-body">
                <label>
                    GID:
                    <input type="text" name="gid" id="msgGid" required placeholder="e.g., 18162464089635255">
                </label>
                <label>
                    Date/Time (UTC):
                    <input type="datetime-local" name="datetime" id="msgDatetime" required>
                </label>
                <label>
                    HTML Content:
                    <textarea name="html" id="msgHtml" placeholder="Enter the full HTML content..."></textarea>
                </label>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" id="cancelModal" class="btn btn-secondary">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var csrfToken = '<?php echo htmlspecialchars($csrfToken, ENT_QUOTES); ?>';
    var currentPage = <?php echo $page; ?>;

    function refreshList() {
        var gid = document.getElementById('filter-gid').value;
        $.get('marketing_messages.php', {ajax: 1, gid: gid, page: currentPage}, function(res) {
            $('#messages-body').html(res.tbody);
            $('#pagination-container').html(res.pagination);
            $('#total-count').text(res.total);
            bindPagination();
        }, 'json');
    }

    function bindPagination() {
        $('.pagination [data-page]').off('click').on('click', function(e) {
            e.preventDefault();
            currentPage = parseInt($(this).data('page'));
            refreshList();
        });
    }

    function openModal(gid) {
        $('#messageForm')[0].reset();
        $('#msgGid').prop('readonly', false);
        $('#isNew').val('0');

        if (gid) {
            // Edit mode - fetch existing record
            $('#modal-title').text('Edit Marketing Message');
            $('#msgGid').prop('readonly', true);
            $.get('marketing_messages.php', {fetch: 1, gid: gid}, function(res) {
                if (res.status === 'ok') {
                    $('#msgGid').val(res.gid);
                    // Convert datetime to local format for input
                    var dt = res.datetime.replace(' ', 'T');
                    $('#msgDatetime').val(dt.substring(0, 16));
                    $('#msgHtml').val(res.html);
                    $('#messageModalOverlay').show();
                } else {
                    alert('Error: ' + res.message);
                }
            }, 'json');
        } else {
            // Create mode
            $('#modal-title').text('Create New Marketing Message');
            $('#isNew').val('1');
            // Set current datetime
            var now = new Date();
            var dtLocal = now.toISOString().substring(0, 16);
            $('#msgDatetime').val(dtLocal);
            $('#messageModalOverlay').show();
        }
    }

    function closeModal() {
        $('#messageModalOverlay').hide();
        $('#messageForm')[0].reset();
    }

    // Close modal on outside click
    $('#messageModalOverlay').on('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Cancel button
    $('#cancelModal').on('click', function() {
        closeModal();
    });

    // Form submit
    $('#messageForm').on('submit', function(e) {
        e.preventDefault();
        var data = {
            save: 1,
            gid: $('#msgGid').val(),
            datetime: $('#msgDatetime').val().replace('T', ' ') + ':00',
            html: $('#msgHtml').val(),
            is_new: $('#isNew').val(),
            csrf_token: csrfToken
        };

        $.post('marketing_messages.php', data, function(res) {
            if (res.status === 'ok') {
                closeModal();
                refreshList();
            } else {
                alert('Error: ' + (res.message || 'Failed to save'));
            }
        }, 'json').fail(function() {
            alert('Error saving record');
        });
    });

    // Edit button
    $('#messages-body').on('click', '.edit-btn', function() {
        var gid = $(this).data('gid');
        openModal(gid);
    });

    // Delete button
    $('#messages-body').on('click', '.delete-btn', function() {
        var gid = $(this).data('gid');
        if (confirm('Are you sure you want to delete message GID: ' + gid + '?')) {
            $.post('marketing_messages.php', {delete: gid, csrf_token: csrfToken}, function(res) {
                if (res.status === 'ok') {
                    refreshList();
                } else {
                    alert('Error deleting record');
                }
            }, 'json');
        }
    });

    // Create new button
    $('#create-new').on('click', function() {
        openModal(null);
    });

    // Filter buttons
    $('#apply-filter').on('click', function() {
        currentPage = 1;
        refreshList();
    });

    $('#clear-filter').on('click', function() {
        $('#filter-gid').val('');
        currentPage = 1;
        refreshList();
    });

    // Enter key in filter input
    $('#filter-gid').on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            currentPage = 1;
            refreshList();
        }
    });

    // Escape key closes modal
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && $('#messageModalOverlay').is(':visible')) {
            closeModal();
        }
    });

    bindPagination();
});
</script>

<?php include 'admin_footer.php'; ?>
