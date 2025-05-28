<?php 
require_once "database.php";

//Hàm hiển thị toàn bộ danh mục
function list_all_type(){
    return listAll('types');
}

function list_limit_type($limit, $nRows){
    $sql = "SELECT * from types order by id limit $limit, $nRows";
    return query_exe($sql);
}

//Hàm lấy ra 1 bản ghi
function list_one_type($id,$value){
    return listOne('types',$id,$value);
}

//Thêm dữ liệu vào bảng
function insert_type($name,$images){
    $data =[
        'name' => $name,
        'images'=>$images
    ];
    return insert('types',$data);
}

//function cập nhật loại hàng
function type_update($id, $name,$images) {
    $data = ['name'=>$name,'images'=>$images];
    update('types', $data, 'id', $id);
}
//function Xóa dữ liệu loại hàng
function type_delete($id) {
    $row = list_one_type('id',$id);
    
    if ( $row ) {
        //Xóa cả hình khi xóa dữ liệu
        $images = "../images/categories/" . $row['images'];
        
        if ( file_exists($images)) {
            unlink($images);
        } 
        delete('types', 'id', $id);
    }
}

//Ham tim kiem theo ten danh muc
function search_type($name){
    $sql = "SELECT *  FROM types Where name Like '%$name%'";
    return query_exe($sql);
}
