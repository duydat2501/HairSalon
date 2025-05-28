<?php 
 extract($_REQUEST);
 comment_approve($id,'1');
 $_SESSION['message']= 'Bình luận đã được phê duyệt';
 header('Location:'. ROOT . 'admin/?page=comment');
 die();