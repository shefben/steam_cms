<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db = cms_get_db();

if (isset($_POST['toggle_hidden'])) {
    $sub = (int)$_POST['sub'];
    $hidden = isset($_POST['hidden']) ? 1 : 0;
    $db->prepare('UPDATE `0405_storefront_packages` SET isHidden=? WHERE subid=?')->execute([$hidden, $sub]);
    exit('ok');
}

if (isset($_GET['load'])) {
    $sub = (int)$_GET['load'];
    $stmt = $db->prepare('SELECT * FROM `0405_storefront_packages` WHERE subid=?');
    $stmt->execute([$sub]);
    header('Content-Type: application/json');
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    exit;
}

if (isset($_GET['ajax']) && $_GET['ajax'] === 'upload' && isset($_FILES['file'])) {
    $sub = (int)($_POST['subid'] ?? 0);
    $type = $_POST['type'] ?? 'thumb';
    $dir = CMS_ROOT . '/storefront/images';
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $uid = $sub ?: uniqid();
    if ($type === 'screen') {
        $fname = "p2_{$uid}.{$ext}";
    } else {
        $fname = "p{$sub}.{$ext}";
    }
    $dest = "$dir/$fname";
    move_uploaded_file($_FILES['file']['tmp_name'], $dest);
    echo '/storefront/images/' . $fname;
    exit;
}

if (isset($_POST['delete'])) {
    $sub = (int)$_POST['delete'];
    $db->prepare('DELETE FROM `0405_storefront_packages` WHERE subid=?')->execute([$sub]);
    header('Location: legacy_storefront_packages.php');
    exit;
}

if (isset($_POST['save_package'])) {
    $sub = (int)$_POST['subid'];
    $title = trim($_POST['title']);
    $desc = trim($_POST['description']);
    $price = trim($_POST['price']);
    $badge = (int)($_POST['badge'] ?? 0);
    $thumb = $_POST['current_thumb'] ?? '';
    $screen = $_POST['current_screen'] ?? '';
    if (!empty($_POST['remove_screenshot'])) {
        $screen = '';
    }
    $stmt = $db->prepare('REPLACE INTO `0405_storefront_packages`(subid,title,description,image_thumb,image_screenshot,price,steamOnlyBadge,isHidden) VALUES(?,?,?,?,?,?,?,0)');
    $stmt->execute([$sub, $title, $desc, $thumb, $screen, $price, $badge]);
}

$packages = $db->query('SELECT * FROM `0405_storefront_packages` ORDER BY subid')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Legacy Storefront Package Management</h2>
<table class="data-table" id="pkg-table">
<thead><tr><th class="sortable">Subscription ID</th><th class="sortable">Title</th><th>Image Preview</th><th>Price</th><th>Hidden</th><th>Tasks</th></tr></thead>
<tbody>
<?php foreach ($packages as $p): ?>
<tr data-id="<?php echo $p['subid']; ?>">
 <td><?php echo $p['subid']; ?></td>
 <td><?php echo htmlspecialchars($p['title']); ?></td>
 <td><?php if ($p['image_thumb']): ?><img src="<?php echo htmlspecialchars($p['image_thumb']); ?>" width="32" height="32"><?php endif; ?></td>
 <td><?php echo htmlspecialchars($p['price']); ?></td>
 <td><input type="checkbox" class="toggle-hidden" data-id="<?php echo $p['subid']; ?>" <?php if ($p['isHidden']) echo 'checked'; ?>></td>
 <td>
  <button type="button" class="edit-btn btn btn-small" data-id="<?php echo $p['subid']; ?>">Edit</button>
  <form method="post" style="display:inline"><input type="hidden" name="delete" value="<?php echo $p['subid']; ?>"><button class="btn btn-danger btn-small">Delete</button></form>
 </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<hr>
<h3>Add or Edit Steam Packages/Subscriptions</h3>
<form method="post" enctype="multipart/form-data" id="pkgForm">
<input type="hidden" name="save_package" value="1">
<input type="hidden" name="current_thumb" id="current_thumb">
<input type="hidden" name="current_screen" id="current_screen">
<input type="hidden" name="remove_screenshot" id="remove_screenshot" value="0">
<label>Package/Subscription ID <input type="number" name="subid" id="subid"></label><br>
<label>Package Name <input type="text" name="title" id="title"></label><br>
<label>Main Image <span id="thumbPrev"></span> <button type="button" id="uploadThumbBtn">Upload New Image</button><input type="file" id="thumbFile" style="display:none"></label><br>
<div>
 ScreenShot or Steam Only Badge:<br>
 <label><input type="radio" name="badge" value="0" id="optScreen" checked> Screen Shot</label>
 <span id="screenWrap"><span id="screenPrev">No Image selected</span> <button type="button" id="uploadScreenBtn">Upload New Screenshot</button> <button type="button" id="removeShot" disabled>Remove Screenshot</button><input type="file" id="screenFile" style="display:none"></span><br>
 <label><input type="radio" name="badge" value="1" id="optBadge"> Steam Only Badge</label>
 <div id="badgeWrap" style="display:none;"><br><br><div class="discount" align="right" style="padding-top:12px;"><br>Offer<br>available<br>only on<br>STEAM!</div></div>
</div><br>
<label>Description</label>
<div id="descToolbar">
  <button type="button" data-cmd="bold"><b>B</b></button>
  <button type="button" data-cmd="italic"><i>I</i></button>
  <button type="button" data-cmd="underline"><u>U</u></button>
</div>
<div id="pkgDesc" class="wysiwyg" contenteditable="true"></div>
<input type="hidden" name="description" id="pkgDescInput">
<br>
<label>Price <input type="text" name="price" id="price"></label><br>
<button type="submit" class="btn btn-primary">Save Package</button> <button type="reset" id="cancelBtn" class="btn">Cancel</button>
</form>
<script>
$(function () {
    function uploadFilePkg(input, type) {
        var fd = new FormData();
        fd.append('file', input.files[0]);
        fd.append('subid', $('#subid').val());
        fd.append('type', type);
        $.ajax({
            url: 'legacy_storefront_packages.php?ajax=upload',
            method: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            success: function (p) {
                if (type === 'thumb') {
                    $('#thumbPrev').html('<img src="' + p + '" width="32">');
                    $('#current_thumb').val(p);
                } else {
                    $('#screenPrev').html('<img src="' + p + '" width="32">');
                    $('#current_screen').val(p);
                    $('#removeShot').prop('disabled', false);
                }
            }
        });
    }

    $(document).on('change', '.toggle-hidden', function () {
        var id = $(this).data('id');
        $.post('legacy_storefront_packages.php', {
            toggle_hidden: 1,
            sub: id,
            hidden: this.checked ? 1 : 0
        });
    });

    $(document).on('click', '.edit-btn', function () {
        var id = $(this).data('id');
        $('#pkgForm')[0].reset();
        $('#thumbPrev').empty();
        $('#screenPrev').text('No Image selected');
        $('#removeShot').prop('disabled', true);
        $('#badgeWrap').hide();
        $('#screenWrap').show();
        $('html,body').animate({scrollTop: $('#pkgForm').offset().top}, 'fast');
        $.getJSON('legacy_storefront_packages.php', { load: id }, function (d) {
            $('#subid').val(d.subid);
            $('#title').val(d.title);
            $('#price').val(d.price);
            $('#current_thumb').val(d.image_thumb);
            $('#thumbPrev').html(d.image_thumb ? '<img src="' + d.image_thumb + '" width="32">' : '');
            $('#current_screen').val(d.image_screenshot);
            $('#screenPrev').html(d.image_screenshot ? '<img src="' + d.image_screenshot + '" width="32">' : 'No Image selected');
            $('#pkgDesc').html(d.description);
            $('#pkgDescInput').val(d.description);
            if (d.steamOnlyBadge == 1) {
                $('#optBadge').prop('checked', true);
                $('#badgeWrap').show();
                $('#screenWrap').hide();
            } else {
                $('#optScreen').prop('checked', true);
                $('#badgeWrap').hide();
                $('#screenWrap').show();
                $('#removeShot').prop('disabled', !d.image_screenshot);
            }
        });
    });

    $('#uploadThumbBtn').on('click', function () {
        $('#thumbFile').click();
    });

    $('#thumbFile').on('change', function () {
        uploadFilePkg(this, 'thumb');
    });

    $('#uploadScreenBtn').on('click', function () {
        $('#screenFile').click();
    });

    $('#screenFile').on('change', function () {
        uploadFilePkg(this, 'screen');
    });

    $('#removeShot').on('click', function () {
        $('#screenPrev').empty();
        $('#current_screen').val('');
        $('#remove_screenshot').val('1');
        $(this).prop('disabled', true);
    });

    $('#optBadge').on('change', function () {
        if (this.checked) {
            $('#badgeWrap').show();
            $('#screenWrap').hide();
        }
    });

    $('#optScreen').on('change', function () {
        if (this.checked) {
            $('#badgeWrap').hide();
            $('#screenWrap').show();
        }
    });

    $('#pkgForm').on('reset', function () {
        setTimeout(function () {
            $('#thumbPrev').empty();
            $('#screenPrev').text('No Image selected');
            $('#current_thumb, #current_screen').val('');
            $('#removeShot').prop('disabled', true);
            $('#remove_screenshot').val('0');
            $('#badgeWrap').hide();
            $('#screenWrap').show();
            $('#pkgDesc').empty();
            $('#pkgDescInput').val('');
        });
    });

    $('#pkgForm').on('submit', function () {
        $('#pkgDescInput').val($('#pkgDesc').html());
    });

    $('#descToolbar button').on('click', function () {
        document.execCommand($(this).data('cmd'), false, null);
    });
});
</script>
<style>
#descToolbar button{margin-right:4px;}
.wysiwyg{border:1px solid #ccc;min-height:100px;padding:4px;}
</style>
<?php include 'admin_footer.php'; ?>

