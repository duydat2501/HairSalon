<?php 
require_once "database.php";

//Hàm hiển thị toàn bộ danh mục
function list_all_category(){
    return listAll('categories');
}

//Hàm lấy ra 1 bản ghi
function list_one_category($id,$value){
    return listOne('categories',$id,$value);
}
//Thêm dữ liệu vào bảng
function insert_category($name,$images){
    $data =[
        'name' => $name,
        'images'=>$images
    ];
    return insert('categories',$data);
}

//function cập nhật loại hàng
function category_update($id, $name,$images) {
    $data = ['name'=>$name,'images'=>$images];
    update('categories', $data, 'id', $id);
}
//function Xóa dữ liệu loại hàng
function category_delete($id) {
    $row = list_one_category('id',$id);
    
    if ( $row ) {
        //Xóa cả hình khi xóa dữ liệu
        $images = "../images/categories/" . $row['images'];
        
        if ( file_exists($images)) {
            unlink($images);
        } 
        delete('categories', 'id', $id);
    }
}

//Ham tim kiem theo ten danh muc
function search_cate($name){
    $sql = "SELECT *  FROM categories Where name Like '%$name%'";
    return query_exe($sql);
}
