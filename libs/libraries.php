<?php 
require_once "database.php";
//Hàm hiển thị toàn bộ danh mục
function list_all_library($role){
    $sql = "SELECT * from libraries where role = $role order by id desc";
    return query_exe($sql);
}
//Ham hien thi mẫu tóc theo gioi han
function library_list_limit($limit, $nRows) {
    $sql = "SELECT * from libraries where role = 1 order by id desc limit $limit, $nRows";
    return query_exe($sql);
}

//Ham hien thi slider
function slider_list_limit($limit, $nRows) {
    $sql = "SELECT * from libraries where role = 0 order by id desc limit $limit, $nRows";
    return query_exe($sql);
}
//Hàm lấy ra 1 bản ghi
function list_one_library($id){
    return listOne('libraries','id',$id);
}
//Thêm dữ liệu vào bảng
function insert_library($name,$images,$link,$role){
    $data =[
        'name' => $name,
        'images' => $images,
        'link' => $link,
        'role' => $role
    ];
    return insert('libraries',$data);
}

//function cập nhật
function library_update($id, $name, $images,$link) {
    $data = ['name'=>$name,'images'=>$images,'link'=>$link];
    update('libraries', $data, 'id', $id);
}
//function Xóa dữ liệu slide
function library_delete($id) {
    $row = list_one_library($id);
    
    if ( $row ) {
        //Xóa cả hình khi xóa dữ liệu
        $images = "../images/sliders/" . $row['images'];
        
        if ( file_exists($images)) {
            unlink($images);
        } 
        delete('libraries', 'id', $id);
    }
}