<?php 
require_once "database.php";

//Hàm hiển thị toàn bộ danh mục
function list_all_time(){
    return listAll('word_time');
}

//Hàm lấy ra 1 bản ghi
function list_one_time($id){
    return listOne('word_time','id',$id);
}
function check_time($id,$val){
    return listOne('word_time',$id,$val);
}
//Ham lay khung gio trống
function appointment_list_time($id_barber, $day) {
    $conn = connection();
    try {
        // Ép kiểu id_barber cho chắc chắn là số nguyên
        $id_barber = (int)$id_barber;
        
        // Kiểm tra định dạng ngày (YYYY-MM-DD)
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $day)) {
            return [];
        }
        
        $sql = "SELECT * FROM word_time WHERE id NOT IN (
                    SELECT id_time FROM appointments WHERE id_barber = :id_barber AND day = :day
                ) ORDER BY time ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_barber', $id_barber, PDO::PARAM_INT);
        $stmt->bindParam(':day', $day, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi truy vấn: " . $e->getMessage();
        return [];
    } finally {
        unset($conn);
    }
}




//Thêm dữ liệu vào bảng
function insert_time($time){
    $data =[
        'time' => $time
    ];
    return insert('word_time',$data);
}

//function cập nhật 
function time_update($id, $time) {
    $data = ['time'=>$time];
    update('word_time', $data, 'id', $id);
}
//function Xóa dữ liệu 
function time_delete($id) {
        delete('word_time', 'id', $id);
}