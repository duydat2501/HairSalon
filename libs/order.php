<?php 
require_once "database.php";

//Hàm hiển thị toàn bộ hoa dơn
function list_all_order(){
    $sql = "SELECT orders.*, name from orders inner join users on users.id= orders.id_user ORDER BY id DESC";
    return query_exe($sql);
}

//Hàm hiển thị toàn bộ hoa dơn theo user
function list_user_order($id_user){
    $sql = "SELECT orders.*, name from orders inner join users on users.id= orders.id_user where id_user =$id_user ORDER BY id DESC";
    return query_exe($sql);
}

//Hàm hien thi don hàng theo trang thai
function list_status_order($status){
    $sql = "SELECT orders.*, name from orders inner join users on users.id= orders.id_user where status like '%$status%' ORDER BY id DESC";
    return query_exe($sql);
}

//Hàm lấy ra hóa đơn theo id_user và trạng thái hóa don
function status_all_order($status,$id_user){
    $sql = "SELECT orders.*, name from orders inner join users on users.id= orders.id_user where id_user =$id_user and status like '%$status%' ORDER BY id DESC";
    return query_exe($sql);
}
//Hamf lấy 1 dòng hóa đơn mới thêm vào theo
function list_top_order($id_user){
    $sql = "SELECT * from orders  where id_user =$id_user ORDER BY id DESC limit 0,1";
    return query_limit($sql);
}
//Hàm lấy ra 1 bản ghi
function list_one_order($id,$value){
    return listOne('orders',$id,$value);
}

//Thêm dữ liệu vào bảng
function insert_order($id_user,$address,$phone){
    $data =[
        'id_user' => $id_user,
        'status'=>'Chờ lấy hàng',
        'address' => $address,
        'phone' => $phone
    ];
    return insert('orders',$data);
}

//function cập nhật hóa đơn
function order_update($id, $status) {
    $data = ['status'=>$status];
    update('orders', $data, 'id', $id);
}
//function Xóa dữ liệu hóa đơn
function order_delete($id) {
    delete('orders', 'id', $id);
}

// Thống kê đơn hàng theo ngày trong tuần (7 ngày gần nhất)
function get_order_stats_by_week() {
    $sql = "SELECT DATE_FORMAT(created_at, '%W') as label, COUNT(*) as total
            FROM orders
            WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)
            GROUP BY label";
    $results = query_exe($sql);

    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    $output = array_fill_keys($days, 0);

    foreach ($results as $row) {
        $output[$row['label']] = (int)$row['total'];
    }

    return [
        'labels' => array_keys($output),
        'counts' => array_values($output)
    ];
}


// Thống kê đơn hàng theo ngày trong tháng hiện tại
function get_order_stats_by_month() {
    $daysInMonth = date('t'); // total days in current month
    $output = [];

    // Fill all days with 0
    for ($i = 1; $i <= $daysInMonth; $i++) {
        $day = str_pad($i, 2, '0', STR_PAD_LEFT);
        $output[$day] = 0;
    }

    $sql = "SELECT DATE_FORMAT(created_at, '%d') as label, COUNT(*) as total
            FROM orders
            WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())
            GROUP BY label";
    $results = query_exe($sql);

    foreach ($results as $row) {
        $output[$row['label']] = (int)$row['total'];
    }

    return [
        'labels' => array_keys($output),
        'counts' => array_values($output)
    ];
}


// Thống kê đơn hàng theo tháng trong năm hiện tại
function get_order_stats_by_year() {
    $months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];
    $output = array_fill_keys($months, 0);

    $sql = "SELECT DATE_FORMAT(created_at, '%M') as label, COUNT(*) as total
            FROM orders
            WHERE YEAR(created_at) = YEAR(CURDATE())
            GROUP BY MONTH(created_at)";
    $results = query_exe($sql);

    foreach ($results as $row) {
        $output[$row['label']] = (int)$row['total'];
    }

    return [
        'labels' => array_keys($output),
        'counts' => array_values($output)
    ];
}
// Get 5 most recent orders
function get_recent_orders($limit = 5) {
    $sql = "SELECT o.id AS id,
       p.name AS product_name,
       od.quantity,
       o.status,
       p.price * od.quantity AS total,
       o.created_at
    FROM orders o
    JOIN order_detail od ON o.id = od.id_order
    JOIN products p ON od.id_product = p.id
    ORDER BY o.created_at DESC
    LIMIT 5
    ";
    return query_exe($sql, [$limit]);
}
function time_ago($datetime) {
    $time = strtotime($datetime);
    $diff = time() - $time;

    // Nếu mới hơn 60 giây
    if ($diff < 60) return $diff . ' giây trước';
    
    $diff = floor($diff / 60);
    // Nếu mới hơn 1 phút
    if ($diff < 60) return $diff . ' phút trước';
    
    $diff = floor($diff / 60);
    // Nếu mới hơn 1 giờ
    if ($diff < 24) return $diff . ' giờ trước';
    
    $diff = floor($diff / 24);
    // Nếu mới hơn 1 ngày
    if ($diff < 30) return $diff . ' ngày trước';
    
    $diff = floor($diff / 30);
    // Nếu mới hơn 1 tháng
    if ($diff < 12) return $diff . ' tháng trước';
    
    $diff = floor($diff / 12);
    // Nếu mới hơn 1 năm
    return $diff . ' năm trước';
}
