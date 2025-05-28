<?php 
session_start();
/*
 * Định nghĩa các url cần thiết được sử dụng trong website
 */
define('ROOT','http://localhost/cattoc/');
date_default_timezone_set('Asia/Ho_Chi_Minh');
function check_session(){
    if(isset($_SESSION['user'])){
        header('location:'.ROOT.'admin');
        die;
    }
    return;
}
function check_role(){
    if(isset($_SESSION['user'])){
        if($_SESSION['user']['role']==1){
            return;
        }
        if($_SESSION['user']['role']!=1){
            header('location:'.ROOT);die();
        }
    }
    //TH người dùng chưa đăng nhập
    header('location:'.ROOT.'admin/login.php');
}

//Hàm kiểm tra size file
//$size = $fileUpload['size]
// $min = 100 *1024
function checkSize($size,$min,$max){
    $flag = false;
    if($size >= $min && $size <= $max) $flag = true;
    return $flag;
}
// checkSize($fileUpload['size'],5*1024,5*1024*1024);

//Hàm kiểm tra kiểu file
//$fileName =$fileUpload['type']
function checkType($fileName,$arrType){
    $ext = pathinfo($fileName,PATHINFO_EXTENSION);
    $flag = false;
    if(in_array(strtolower($ext),$arrType)==true) $flag = true;
    return $flag;
}
// checkType($fileUpload['name'],array('jpg','png','gif','tiff'));


//Lay url cua trang hiện tại
function getCurURL()
{
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $pageURL = "https://";
    } else {
      $pageURL = 'http://';
    }
    if (isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}