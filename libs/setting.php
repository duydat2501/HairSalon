<?php 
require_once "database.php";

//Hàm hiển thị toàn bộ danh mục
function list_all_setting(){
    return listAll('setting');
}
function list_limit_setting(){
    $sql = "SELECT * from setting order by id limit 0,1";
    return query_limit($sql);
}

//Hàm lấy ra 1 bản ghi
function list_one_setting($id,$value){
    return listOne('setting',$id,$value);
}

//Thêm dữ liệu vào bảng
function insert_setting($logo,$file_ico,$title,$introduce,$slogan){
    $data =[
        'logo' => $logo,
        'file_ico'=>$file_ico,
        'title' => $title,
        'introduce'=>$introduce,
        'slogan'=>$slogan
    ];
    return insert('setting',$data);
}

//function cập nhật loại hàng
function setting_update($id, $logo,$file_ico,$title,$introduce,$slogan) {
    $data = [
        'logo' => $logo,
        'file_ico'=>$file_ico,
        'title' => $title,
        'introduce'=>$introduce,
        'slogan'=>$slogan
    ];
    update('setting', $data, 'id', $id);
}
//function Xóa dữ liệu loại hàng
function setting_delete($id) {
    delete('setting', 'id', $id);
}
