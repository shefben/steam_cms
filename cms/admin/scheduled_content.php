<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();

if (isset($_POST['delete_single'])) {
    $id = (int)$_POST['delete_single'];
    $db->prepare('DELETE FROM scheduled_content WHERE content_id=?')->execute([$id]);
}

$errors = [];
if (isset($_POST['save'])) {
    if (!empty($_POST['content_id'])) {
        foreach ($_POST['content_id'] as $idx => $id) {
            $id = (int)$id;
            $type = $_POST['schedule_type'][$idx] ?? 'every_n_days';
            if (!in_array($type, ['every_n_days','day_of_month','fixed_range'], true)) {
                $errors[] = 'Invalid schedule type for row '.$id;
                continue;
            }
            $stmt = $db->prepare('UPDATE scheduled_content SET theme_name=?, description=?, tag_name=?, content=?, schedule_type=?, every_n_days=?, day_of_month=?, start_date=?, end_date=?, fixed_start_datetime=?, fixed_end_datetime=?, active=? WHERE content_id=?');
            $stmt->execute([
                $_POST['theme_name'][$idx] ?? null,
                $_POST['description'][$idx] ?? '',
                $_POST['tag_name'][$idx] ?? '',
                $_POST['content'][$idx] ?? '',
                $type,
                $_POST['every_n_days'][$idx] ?: null,
                $_POST['day_of_month'][$idx] ?: null,
                $_POST['start_date'][$idx] ?: null,
                $_POST['end_date'][$idx] ?: null,
                $_POST['fixed_start_datetime'][$idx] ?: null,
                $_POST['fixed_end_datetime'][$idx] ?: null,
                isset($_POST['active'][$idx]) ? 1 : 0,
                $id
            ]);
        }
    }
    if (!empty($_POST['new_tag_name'])) {
        $stmt = $db->prepare('INSERT INTO scheduled_content(theme_name,description,tag_name,content,schedule_type,every_n_days,day_of_month,start_date,end_date,fixed_start_datetime,fixed_end_datetime,active) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)');
        $count = count($_POST['new_tag_name']);
        for ($i=0;$i<$count;$i++) {
            if ($_POST['new_tag_name'][$i] === '') continue;
            $type = $_POST['new_schedule_type'][$i] ?? 'every_n_days';
            if (!in_array($type, ['every_n_days','day_of_month','fixed_range'], true)) {
                $errors[] = 'Invalid schedule type for new row';
                continue;
            }
            $stmt->execute([
                $_POST['new_theme_name'][$i] ?? null,
                $_POST['new_description'][$i] ?? '',
                $_POST['new_tag_name'][$i],
                $_POST['new_content'][$i] ?? '',
                $type,
                $_POST['new_every_n_days'][$i] ?: null,
                $_POST['new_day_of_month'][$i] ?: null,
                $_POST['new_start_date'][$i] ?: null,
                $_POST['new_end_date'][$i] ?: null,
                $_POST['new_fixed_start_datetime'][$i] ?: null,
                $_POST['new_fixed_end_datetime'][$i] ?: null,
                isset($_POST['new_active'][$i]) ? 1 : 0
            ]);
        }
    }
}

$rows = $db->query('SELECT * FROM scheduled_content ORDER BY content_id')->fetchAll(PDO::FETCH_ASSOC);
?>
<?php if ($errors): ?>
<ul class="errors">
<?php foreach ($errors as $e): ?>
 <li><?php echo htmlspecialchars($e); ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<h2>Scheduled Content</h2>
<form method="post">
<table class="table" id="new-scheduled-table">
<tr><th>ID</th><th>Theme</th><th>Description</th><th>Tag</th><th>Content</th><th>Type</th><th>N Days</th><th>Day</th><th>Start</th><th>End</th><th>Fixed Start</th><th>Fixed End</th><th>Active</th><th>Delete</th></tr>
<tbody>
<?php foreach ($rows as $i => $r): ?>
<tr>
  <td><?php echo $r['content_id']; ?><input type="hidden" name="content_id[]" value="<?php echo $r['content_id']; ?>"></td>
  <td><input type="text" name="theme_name[]" value="<?php echo htmlspecialchars($r['theme_name']); ?>"></td>
  <td><input type="text" name="description[]" value="<?php echo htmlspecialchars($r['description']); ?>"></td>
  <td><input type="text" name="tag_name[]" value="<?php echo htmlspecialchars($r['tag_name']); ?>"></td>
  <td><textarea name="content[]" rows="2"><?php echo htmlspecialchars($r['content']); ?></textarea></td>
  <td><select name="schedule_type[]">
      <option value="every_n_days"<?php if($r['schedule_type']==='every_n_days') echo ' selected'; ?>>every_n_days</option>
      <option value="day_of_month"<?php if($r['schedule_type']==='day_of_month') echo ' selected'; ?>>day_of_month</option>
      <option value="fixed_range"<?php if($r['schedule_type']==='fixed_range') echo ' selected'; ?>>fixed_range</option>
  </select></td>
  <td><input type="number" name="every_n_days[]" value="<?php echo htmlspecialchars($r['every_n_days']); ?>" style="width:60px"></td>
  <td><input type="number" name="day_of_month[]" value="<?php echo htmlspecialchars($r['day_of_month']); ?>" style="width:60px"></td>
  <td><input type="date" name="start_date[]" value="<?php echo htmlspecialchars($r['start_date']); ?>"></td>
  <td><input type="date" name="end_date[]" value="<?php echo htmlspecialchars($r['end_date']); ?>"></td>
  <td><input type="datetime-local" name="fixed_start_datetime[]" value="<?php echo str_replace(' ','T', $r['fixed_start_datetime']); ?>"></td>
  <td><input type="datetime-local" name="fixed_end_datetime[]" value="<?php echo str_replace(' ','T', $r['fixed_end_datetime']); ?>"></td>
  <td><input type="checkbox" name="active[<?php echo $i; ?>]" value="1"<?php if($r['active']) echo ' checked'; ?>></td>
  <td><button type="submit" name="delete_single" value="<?php echo $r['content_id']; ?>" onclick="return confirm('Delete?')">Delete</button></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<h3>Add New</h3>
<div class="new-scheduled-item" id="new-scheduled-item">
  <label>Theme: <input type="text" name="new_theme_name[]" style="width:120px"></label>
  <label>Description: <input type="text" name="new_description[]" style="width:150px"></label>
  <label>Tag: <input type="text" name="new_tag_name[]" style="width:120px"></label>
  <label>Content:<br><textarea name="new_content[]" rows="2" style="width:200px"></textarea></label>
  <label>Type:
    <select name="new_schedule_type[]" style="width:130px">
        <option value="every_n_days">every_n_days</option>
        <option value="day_of_month">day_of_month</option>
        <option value="fixed_range">fixed_range</option>
    </select>
  </label>
  <label>Every N Days: <input type="number" name="new_every_n_days[]" style="width:60px"></label>
  <label>Day of Month: <input type="number" name="new_day_of_month[]" style="width:60px"></label>
  <label>Start Date: <input type="date" name="new_start_date[]" style="width:140px"></label>
  <label>End Date: <input type="date" name="new_end_date[]" style="width:140px"></label>
  <label>Fixed Start: <input type="datetime-local" name="new_fixed_start_datetime[]" style="width:180px"></label>
  <label>Fixed End: <input type="datetime-local" name="new_fixed_end_datetime[]" style="width:180px"></label>
  <label>Active: <input type="checkbox" name="new_active[]" value="1" checked></label>
</div>
<button type="submit" name="save" value="1">Save</button>
</form>
<?php include 'admin_footer.php'; ?>
