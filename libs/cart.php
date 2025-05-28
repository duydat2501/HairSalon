<?php 
//Tinh gia cua tất cả sản pham
function total_price($cart){
    $total_price = 0;
    foreach ($cart as $key => $value){
      $price = $value['price']- ($value['price']*$value['sale']);
      $total_price += $value['quantity'] * $price;
    }
    return $total_price;
  }
  
  //Tinh tong so hang co trong gio
  function total_item($cart){
    $total = 0;
    foreach ($cart as $key => $value){
      $total += $value['quantity'];
    }
    return $total;
  }
 