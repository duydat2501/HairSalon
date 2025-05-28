<?php 
session_start();

/**Tinh tong tien */
function total_price($cart){
    $total_price = 0;
    foreach ($cart as $key => $value){
      $price = $value['price']- ($value['price']*$value['sale']);
      $total_price += $value['quantity'] * $price;
    }
    return $total_price;
  }

extract($_REQUEST);
if(isset($_SESSION['user'])){
    $_SESSION['cartCustom'][$_SESSION['user']['id']][$id_pro]['quantity']=$qty;
    $cart = $_SESSION['cartCustom'][$_SESSION['user']['id']];
}else{
    $_SESSION['cart'][$id_pro]['quantity'] = $qty;
    $cart =$_SESSION['cart'];
}
$sub_total_new = $price * $qty;
$total_new = total_price($cart);  
$result = array(
    'sub_total_new' => number_format($sub_total_new, 0, ',', '.') . 'đ',
    'total_new' => number_format($total_new, 0, ',', '.') . 'đ'
);
echo json_encode($result);
?>
