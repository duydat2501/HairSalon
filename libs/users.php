<?php
/*
    Các hàm làm việc với bảng thành viên
*/
require_once "database.php";

//Hàm lấy ra 1 bản ghi
function list_one_user($id){
    return listOne('users','id',$id);
}
//Lay ra tat ca user tru tai khoan dang nhap
function user_list_all($id){
    $sql = "SELECT * from users Where id != $id ORDER BY id DESC";
    return query_exe($sql);
}

function user_list(){
    $sql = "SELECT * from users ORDER BY id DESC";
    return query_exe($sql);
}
//Ham lay thợ cắt có giờ rảnh 
function user_list_time($id_time,$day) {
    $sql = "SELECT * from users WHERE role= 3 and id not in (SELECT id_user from appointments WHERE id_time=$id_time and day='$day')";
    return query_exe($sql);
}

function guest_insert($name, $phone,$address, $images,$role) {
    $data = [
        'name'=>$name,
        'phone'=>$phone,
        'address'=>$address,
        'images'=>$images,
        'role'=>$role
    ];
    insert('users', $data);
}

function user_change($id,$account, $password,$name,$address, $images,$email,$role) {
    $data = [
        'account'=>$account,
        'password'=>password_hash($password,PASSWORD_DEFAULT),
        'name'=>$name,
        'address'=>$address,
        'images'=>$images,
        'email'=>$email,
        'role'=>$role
    ];
    update('users', $data, 'id', $id);
}
//Hàm lấy ra danh sách users theo role
function user_list_role($role){
    $sql = "SELECT * from users Where role = $role";
    return query_exe($sql);
}

function user_check($id,$value){
    return listOne('users',$id,$value);
}


//Lấy ra thợ cắt theo limit
function user_list_limit($limit, $nRows) {
    $sql = "SELECT * from users where role = 3 order by id limit $limit, $nRows";
    return query_exe($sql);
}

//Thêm
function user_insert($account, $password, $name,$address,$phone, $email, $images, $role) {
    $data = [
        'account'=>$account,
        'password'=>password_hash($password,PASSWORD_DEFAULT),
        'name'=>$name,
        'address'=>$address,
        'phone'=>$phone,
        'email'=>$email,
        'images'=>$images,
        'role'=>$role
    ];
    insert('users', $data);
}

//Cập nhật
function user_update($id, $role) {
    $data = [
        'role'=>$role
    ];
    update('users', $data, 'id', $id);
}

//Đổi mật khẩu
function user_change_password($id, $password) {
    $data = [
        'password'=>password_hash($password,PASSWORD_DEFAULT),
    ];
    update('users', $data, 'id', $id);
}
//Đổi email
function user_change_email($id, $email) {
    $data = [
        'email'=>$email,
    ];
    update('users', $data, 'id', $id);
}
//Đổi số điện thoại
function user_change_phone($id, $phone) {
    $data = [
        'phone'=>$phone,
    ];
    update('users', $data, 'id', $id);
}
//Đổi địa chỉ
function user_update_limit($id, $name,$address,$images) {
    $data = [
        'name'=>$name,
        'address'=>$address,
        'images'=>$images
    ];
    update('users', $data, 'id', $id);
}
//Xóa 
function user_delete($id) {
    return delete('users', 'id', $id);
}
//Tìm kiếm theo account khác tai khoan dang nhap
function search_user($name,$id){
    $sql = "SELECT *  FROM users Where name Like '%$name%' and id != $id ORDER BY id DESC";
    return query_exe($sql);
}

//Update time_code
function update_code_user($id,$code,$time_code){
    $data = [
        'code'=>$code,
        'time_code'=>$time_code
    ];
    update('users', $data, 'id', $id);
}

//Kiểm tra username khi login
function check_user($account){
    $sql = "SELECT * from users WHERE account='$account' or phone='$account' or email='$account'";
    $user = query_exe($sql);
    if(count($user)>0){
        return $user[0];
    }
    return false;
}