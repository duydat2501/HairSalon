<?php 
require_once "database.php";

//Hàm hiển thị toàn bộ danh mục
function list_all_new(){
    $sql = "SELECT news.*,users.name as user from news inner join users on users.id = news.id_user 
    ORDER BY id DESC";
    return query_exe($sql);
}

function list_limit_new($limit, $nRows){
    $sql = "SELECT news.*,users.name as user from news inner join users on users.id = news.id_user 
    ORDER BY id DESC limit $limit,$nRows";
    return query_exe($sql);
}
function check_new($id,$value){
    return listOne('news',$id,$value);
}
//Hàm lấy ra 1 bản ghi
function list_one_new($id){
    return listOne('news','id',$id);
}
//Thêm dữ liệu vào bảng
function insert_new($title,$content,$images,$id_user){
    $data =[
        'title' => $title,
        'content' => $content,
        'id_user' => $id_user,
        'images'=>$images
    ];
    return insert('news',$data);
}

//function cập nhật loại hàng
function new_update($id, $title,$content,$images) {
    $data = [
        'title' => $title,
        'content' => $content,
        'images'=>$images
    ];
    update('news', $data, 'id', $id);
}

//hàm cập nhật số lượt xem
function update_view_blog($id){
    $sql = "UPDATE news SET views=views+1 where id=$id";
    return query_exe($sql);
}
//function Xóa dữ liệu loại hàng
function new_delete($id) {
    $row = list_one_new($id);
    
    if ( $row ) {
        //Xóa cả hình khi xóa dữ liệu
        $images = "../images/sliders/" . $row['images'];
        
        if ( file_exists($images)) {
            unlink($images);
        } 
        delete('news', 'id', $id);
    }
}

//Ham tim kiem theo tieu de
function search_new($title){
    $sql = "SELECT news.*,users.name as user from news inner join users on users.id = news.id_user Where title Like '%$title%'";
    return query_exe($sql);
}
