<?php
require_once '../libs/word_time.php';

if (isset($_POST['id']) && isset($_POST['day'])) {
    $id = $_POST['id'];
    $day = $_POST['day'];
    $time = appointment_list_time($id, $day);
} else {
    $time = list_all_time();
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
$date_time=date('H:i:s');
$date_now=date("Y-m-d");
?>
<select name="id_time" id="id_time" class="form-control" required>
    <option value="" selected>Chọn giờ hẹn</option>
    <?php foreach ($time as $t) : ?>
        <?php if((strtotime($t['time']) > strtotime($date_time)) && (strtotime($day) == strtotime($date_now))): ?>
        <option value="<?= $t['id'] ?>"><?= $t['time'] ?></option>
        <?php elseif(strtotime($day) > strtotime($date_now)): ?>
            <option value="<?= $t['id'] ?>"><?= $t['time'] ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>
<div class="invalid-feedback">
    Vui lòng chọn giờ hẹn
</div>
