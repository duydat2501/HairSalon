<?php 
require_once "database.php";

//Hàm hiển thị toàn bộ danh mục
function list_all_appointment(){
    $sql = "SELECT appointments.*, barbers.account, users.name,users.phone ,time,barbers.images as barber_images
    from appointments inner join barbers on barbers.id = appointments.id_barber
    inner join users on users.id = appointments.id_user
    inner join word_time on word_time.id = appointments.id_time ORDER BY id DESC";
    return query_exe($sql);
}

//Ham hien thi lich hen theo cancel
function appointment_list_cancel($cancel) {
    $sql = "SELECT appointments.*, barbers.account, users.name,users.phone ,time,barbers.images as barber_images
    from appointments inner join barbers on barbers.id = appointments.id_barber
    inner join users on users.id = appointments.id_user
    inner join word_time on word_time.id = appointments.id_time where cancel = $cancel ORDER BY id DESC";
    return query_exe($sql);
}

//Hàm lấy ra 1 bản ghi
function list_one_appointment($id){
    return listOne('appointments','id',$id);
}
//Hamf lấy 1 dòng  mới thêm vào theo
function list_top_app($id_user){
    $sql = "SELECT * from appointments  where id_user =$id_user ORDER BY id DESC limit 0,1";
    return query_limit($sql);
}
//Thêm dữ liệu vào bảng
function insert_appointment($id_barber,$id_user,$day,$id_time){
    $data =[
        'id_barber' => $id_barber,
        'id_user'=>$id_user,
        'day'=>$day,
        'id_time'=>$id_time,
        'cancel'=>0
    ];
    return insert('appointments',$data);
}

//function cập nhật loại hàng
function appointment_update($id,$cancel) {
    $data = [
    'cancel'=>$cancel
];
    update('appointments', $data, 'id', $id);
}
//function Xóa dữ liệu loại hàng
function appointment_delete($id) {
   return delete('appointments', 'id', $id);
}

//Ham hien thi toan bo lich hen theo id_customer
function appointment_user($id_user){
    $sql = "SELECT appointments.*, barbers.account,time,users.name,users.phone,barbers.name as barber_name,barbers.images as barber_images
    from appointments inner join users on users.id = appointments.id_user
    inner join barbers on barbers.id = appointments.id_barber
    inner join word_time on word_time.id = appointments.id_time 
    where id_user= $id_user ORDER BY id DESC";
    return query_exe($sql);
}

//Ham hien thi toan bo lich hen theo id_barber
function appointment_barber($id_barber){
    $sql = "SELECT appointments.*, barbers.account, users.name,users.phone ,time,barbers.images as barber_images
    from appointments inner join users on users.id = appointments.id_user
    inner join barbers on barbers.id = appointments.id_barber
    inner join word_time on word_time.id = appointments.id_time 
    where id_barber= $id_barber ORDER BY id DESC";
    return query_exe($sql);
}
//Ham hien thi lich hen theo id_user va trang thai
function appointment_custom_status($id_user,$cancel){
    $sql = "SELECT appointments.*, barbers.account,time,users.name,users.phone,barbers.name as barber_name,barbers.images as barber_images
    from appointments inner join users on users.id = appointments.id_user
    inner join barbers on barbers.id = appointments.id_barber
    inner join word_time on word_time.id = appointments.id_time 
    where id_user= $id_user and cancel=$cancel ORDER BY id DESC";
    return query_exe($sql);
}

//Ham hien thi lich hen theo id_barber va trang thai
function appointment_barber_status($id_barber,$cancel){
    $sql = "SELECT appointments.*, barbers.account,time,users.name,users.phone,barbers.images as barber_images
    from appointments inner join users on users.id = appointments.id_user
    inner join barbers on barbers.id = appointments.id_barber
    inner join word_time on word_time.id = appointments.id_time 
    where id_barber= $id_barber and cancel=$cancel ORDER BY id DESC";
    return query_exe($sql);
}