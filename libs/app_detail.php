<?php 
//Hàm hiển thị toàn bộ lich hen chi tiet theo id_appointment
function all_app_detail($appointment){
    $sql = "SELECT app_detail.*, name,images,price,sale,time from app_detail inner join services on services.id= app_detail.id_service
    where id_appointment = $appointment
     ORDER BY id DESC";
    return query_exe($sql);
}
//Hàm lấy ra 1 bản ghi
function one_app_detail($id,$value){
    return listOne('app_detail',$id,$value);
}
//Thêm dữ liệu vào bảng
function insert_app_detail($id_appointment,$id_service){
    $data =[
        'id_appointment' => $id_appointment,
        'id_service' => $id_service
    ];
    return insert('app_detail',$data);
}
//function xóa theo id_apppointment
function app_book_delete($id) {
    delete('app_detail', 'id_appointment', $id);
}
//function Xóa dữ liệu
function app_detail_delete($id) {
    delete('app_detail', 'id', $id);
}
