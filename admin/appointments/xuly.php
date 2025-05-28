<?php
require_once '../../libs/word_time.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');

$time = [];
$date = date('H:i:s');
$date_now = date("Y-m-d");

if (!empty($_POST['id']) && !empty($_POST['day'])) {
    $id = $_POST['id'];
    $day = $_POST['day'];

    // Validate ID is number and date is in correct format
    if (is_numeric($id) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $day)) {
        $time = appointment_list_time($id, $day);
    } else {
        echo "<p class='text-danger'>Dữ liệu không hợp lệ.</p>";
        exit;
    }
} else {
    echo "<p class='text-danger'>Thiếu thông tin stylist hoặc ngày hẹn.</p>";
    exit;
}

?>
<label for="id_time">Chọn giờ hẹn</label>
<select name="id_time" id="id_time" class="form-control" required>
    <option value="" selected>Chọn giờ hẹn</option>
    <?php foreach ($time as $t) : ?>
        <?php if((strtotime($t['time']) > strtotime($date)) && (strtotime($day) == strtotime($date_now))): ?>
        <option value="<?= $t['id'] ?>"><?= $t['time'] ?></option>
        <?php elseif(strtotime($day) > strtotime($date_now)): ?>
            <option value="<?= $t['id'] ?>"><?= $t['time'] ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>
<div class="invalid-feedback">
    Vui lòng chọn giờ hẹn
</div>
