<?php
/*
    Các hàm làm việc với bảng khách hàng
*/
require_once "database.php";
// lấy ra 1 bản ghi theo id
function barber_list_one($id){
    return listOne('barbers','id', $id);
}

//Kiểm tra user đã tồn tại chưa
function barber_check($id,$values){
    return listOne('barbers',$id, $values);
}
//Lay ra tat ca khách hàng
function barber_list_all(){
    $sql = "SELECT * from barbers ORDER BY id DESC";
    return query_exe($sql);
}

function barber_limit($limit, $nRows){
    $sql = "SELECT * from barbers ORDER BY id DESC limit $limit, $nRows";
    return query_exe($sql);
}

//Thêm
function barber_insert($name,$account, $password, $phone,$address, $email, $images) {
    $data = [
        'name'=>$name,
        'account'=>$account,
        'password'=>password_hash($password,PASSWORD_DEFAULT),
        'phone'=>$phone,
        'address'=>$address,
        'email'=>$email,
        'images'=>$images
    ];
    insert('barbers', $data);
}


//Đổi mật khẩu
function barber_change_password($id, $password) {
    $data = [
        'password'=>password_hash($password,PASSWORD_DEFAULT)
    ];
    update('barbers', $data, 'id', $id);
}
//Đổi email
function barber_change_email($id, $email) {
    $data = [
        'email'=>$email,
    ];
    update('barbers', $data, 'id', $id);
}
//Đổi số điện thoại
function barber_change_phone($id, $phone) {
    $data = [
        'phone'=>$phone,
    ];
    update('barbers', $data, 'id', $id);
}
//Đổi địa chỉ
function barber_update($id, $name,$address,$images) {
    $data = [
        'name'=>$name,
        'address'=>$address,
        'images'=>$images
    ];
    update('barbers', $data, 'id', $id);
}
//Xóa 
function barber_delete($id) {
    return delete('barbers', 'id', $id);
}
//Tìm kiếm theo ten
function search_barber($name){
    $sql = "SELECT * FROM barbers Where name Like '%$name%' ORDER BY id DESC";
    return query_exe($sql);
}

//Update time_code
function update_code_barber($id,$code,$time_code){
    $data = [
        'code'=>$code,
        'time_code'=>$time_code
    ];
    update('barbers', $data, 'id', $id);
}

//Kiểm tra barbername khi login
function check_barber($name){
    $sql = "SELECT * from barbers WHERE account='$name' or phone='$name' or email='$name'";
    $barber = query_exe($sql);
    if(count($barber)>0){
        return $barber[0];
    }
    return false;
}