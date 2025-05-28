<?php 
require_once "../golbal.php";
extract($_REQUEST);
if($select_search==1){
    header('Location: ' .ROOT . "admin/?page=product&action=search&keyword=$keyword");
    die();
}else if($select_search==2){
    header('Location: ' .ROOT . "admin/?page=service&action=search&keyword=$keyword");
    die();
}else if($select_search==3){
    header('Location: ' .ROOT . "admin/?page=new&action=search&keyword=$keyword");
    die();
}else if($select_search==4){
    header('Location: ' .ROOT . "admin/?page=barber&action=search&keyword=$keyword");
    die();
}else if($select_search==5){
    header('Location: ' .ROOT . "admin/?page=user&action=search&keyword=$keyword");
    die();
}else{
    header('Location: ' .ROOT . "admin/?page=category&action=search&keyword=$keyword");
    die();
}
 
?>