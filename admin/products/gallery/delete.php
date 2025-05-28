<?php 
extract($_REQUEST);
gallery_delete($id);
$_SESSION['message']= 'Xoá liệu thành công';
header('Location:'. ROOT . 'admin/?page=gallery&id='.$id_product);
die();