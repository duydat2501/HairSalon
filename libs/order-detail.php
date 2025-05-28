<?php 
//Hàm hiển thị toàn bộ danh mục
function list_all_detail($order){
    $sql = "SELECT order_detail.*, name,images,price,sale from order_detail inner join products on products.id= order_detail.id_product
    where id_order = $order
     ORDER BY id DESC";
    return query_exe($sql);
}

//Hàm lấy ra 1 bản ghi
function list_one_detail($id,$value){
    return listOne('order_detail',$id,$value);
}
//Thêm dữ liệu vào bảng
function insert_detail($id_order,$id_product,$quantity){
    $data =[
        'id_order' => $id_order,
        'id_product' => $id_product,
        'quantity'=>$quantity
    ];
    return insert('order_detail',$data);
}

//Xóa hóa đơn chi tiết theo hóa đơn
function detail_delete_order($id) {
    delete('order_detail', 'id_order', $id);
}
//function Xóa dữ liệu
function detail_delete($id) {
    delete('order_detail', 'id', $id);
}

//Hàm hiển thị toàn bộ hóa đơn chi tiet theo id_user va id_order
function list_all_purchase($id_user,$id_order){
    $sql = "SELECT id_product,name,images,price,sale,quantity from order_detail 
    inner join products on products.id= order_detail.id_product
    inner join orders on orders.id = order_detail.id_order
    where orders.id_user = $id_user and id_order=$id_order
     ORDER BY orders.id DESC";
    return query_exe($sql);
}

//Hàm hiển thị  hóa đơn chi tiet theo id_user, id_order và trạng thai
function order_status($id_user,$id_order,$status){
    $sql = "SELECT id_product,name,images,price,sale,quantity from order_detail 
    inner join products on products.id= order_detail.id_product
    inner join orders on orders.id = order_detail.id_order
    where orders.id_user = $id_user and id_order=$id_order and orders.status like '%$status%'
     ORDER BY orders.id DESC";
    return query_exe($sql);
}

//Hàm hiển thị toàn bộ hóa đơn chi tiet theo id_user và trạng thai
function user_order_status($id_user,$status){
    $sql = "SELECT order_detail.* from order_detail 
    inner join orders on orders.id = order_detail.id_order
    where orders.id_user = $id_user and  orders.status like '%$status%'
     ORDER BY orders.id DESC";
    return query_exe($sql);
}
