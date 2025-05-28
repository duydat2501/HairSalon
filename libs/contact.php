<?php 
require_once "database.php";

//Hàm hiển thị toàn bộ danh mục
function list_all_contact(){
    return listAll('contacts');
}

//Hàm lấy ra 1 bản ghi
function list_one_contact($id,$value){
    return listOne('contacts',$id,$value);
}
//Thêm dữ liệu vào bảng
function insert_contact($content,$name,$phone,$email){
    $data =[
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'content' => $content
    ];
    return insert('contacts',$data);
}

//function Xóa dữ liệu bình luận
function contact_delete($id) {
    delete('contacts', 'id', $id);
}

// Bảng Reply_contact

//Hàm hiển thị tất cả trả lòi theo id_contact
function list_reply_contact($id_contact){
    $sql = "SELECT reply_contact.*,account FROM reply_contact inner join users on users.id = reply_contact.id_user 
    where id_contact = $id_contact";
    return query_exe($sql);
}
//Thêm dữ liệu vào bảng
function insert_reply_contact($content,$id_user,$id_contact){
    $data =[
        'id_contact' => $id_contact,
        'id_user' => $id_user,
        'content' => $content
    ];
    return insert('reply_contact',$data);
}

//function Xóa dữ liệu bình luận
function contact_reply_delete($id) {
    delete('reply_contact', 'id', $id);
}