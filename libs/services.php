<?php
require_once "database.php";

//hàm lấy ra dữ liệu danh sách dịch vụ
function service_list_all() {
    $sql = "SELECT services.*,types.name as name_type from services inner join types on types.id = services.id_type 
    ORDER BY id DESC";
    return query_exe($sql);
}


//Lấy ra 1 bản ghi dịch vụ theo điều kiện id
function service_list_one($id,$value) {
    return listOne('services',$id,$value);
}
//function lấy ra dữ liệu theo loại hàng
//$id_cate là dữ liệu được lọc
function service_list_cate($id_type) {
    $sql = "SELECT * from services Where id_type=$id_type ORDER BY id DESC";
    return query_exe($sql);
}

//hàm lấy ra dữ liệu danh sách dịch vụ theo danh mục và giới hạn
function service_list_types($id_type,$limit, $nRows) {
    $sql = "SELECT services.* from services inner join types on services.id_type = types.id 
    Where id_type=$id_type
    ORDER BY services.id DESC limit $limit,$nRows";
    return query_exe($sql);
}

//Ham tinh tong so ban ghi trong bảng services theo dieu kien
function num_row_ser($id_type){
    $conn = connection();
    $sql = $conn->prepare("SELECT COUNT(*) from services inner join types on services.id_type = types.id 
    Where id_type=$id_type");
    $sql->execute(); 
    $num_row = $sql->fetchColumn();
    return $num_row;
}

//dich vu liên quan
function service_list_type($id_type,$id) {
    $sql = "SELECT * from services  Where id_type=$id_type and id != $id ORDER BY id DESC";
    return query_exe($sql);
}

//function lấy ra dữ liệu theo limit
//$sql câu lệnh select
function service_list_limit($limit, $nRows) {
    $sql = "SELECT * from services order by id desc limit $limit, $nRows";
    return query_exe($sql);
}


//Chỉnh sửa dữ liệu dịch vụ
function service_update($id, $name, $price,$sale, $images, $id_type, $detail, $time) {
    $data = [        
        "name"=>$name,
        "price"=>$price,
        "sale"=>$sale,
        "time"=>$time,
        "images"=>$images,
        "id_type"=>$id_type,
        "detail"=>$detail
    ];
    return update('services', $data,'id', $id);
}

//function thêm dịch vụ vào bảng dịch vụ
function service_insert($name, $price,$sale, $images, $id_type, $detail, $time) {
    $data = [        
        "name"=>$name,
        "price"=>$price,
        "sale"=>$sale,
        "time"=>$time,
        "images"=>$images,
        "id_type"=>$id_type,
        "detail"=>$detail
    ];
    return insert('services', $data);
}

//Xóa dịch vụ
function service_delete($id) {
    $row = service_list_one('id',$id);
    
    if ( $row ) {
        //Xóa cả hình khi xóa dữ liệu
        $images = "../images/products/" . $row['images'];
        
        if ( file_exists($images)) {
            unlink($images);
        } 
        delete('services', 'id', $id);
    }
}

//Tìm kiếm theo tên dich vu
function search_service($name){
    $sql = "SELECT services.*, types.name as name_type
    FROM services  INNER JOIN types on services.id_type = types.id 
    Where services.name Like '%$name%'";
    return query_exe($sql);
}

//Thống kê dịch vụ theo danh mục
function statistical_service(){
    $sql = "SELECT t.id, t.name, COUNT(*) so_luong, 
                MIN(s.price) gia_min, 
                MAX(s.price) gia_max, 
                AVG(s.price) gia_avg
     FROM services s inner JOIN types t ON t.id=s.id_type
     GROUP BY t.id, t.name";
return query_exe($sql);
}

function statistical_service_range($start_date, $dest_date){
    $sql = "SELECT
        t.id,
        t.name,
        COALESCE(service_data.total_services, 0) AS so_luong,
        COALESCE(service_data.total_revenue, 0) AS total
    FROM types t
            LEFT JOIN (
        SELECT
            s.id_type,
            COUNT(*) AS total_services,
            SUM(s.price) AS total_revenue
        FROM app_detail ad
                INNER JOIN services s ON ad.id_service = s.id
                INNER JOIN appointments a ON ad.id_appointment = a.id
        WHERE a.day BETWEEN '$start_date' AND '$dest_date'
        GROUP BY s.id_type
    ) AS service_data ON service_data.id_type = t.id
    ORDER BY t.name;
    ";

    return query_exe($sql);
}


// Thống kê dịch vụ được sử dụng trong khoảng thời gian, theo ngày hoặc tháng
function get_service_stats_grouped_by($startDate, $endDate, $groupBy = 'DATE') {
    $dateSelect = $groupBy === 'MONTH' 
        ? "DATE_FORMAT(a.created_at, '%Y-%m') AS label" 
        : "DATE(a.created_at) AS label";

    // Nếu query_exe không hỗ trợ bind ?, thì dùng string nối vào
    $sql = "
        SELECT 
            $dateSelect,
            COUNT(DISTINCT a.id) AS new_order,
            COUNT(ad.id) AS used_service,
            SUM(s.price * (1 - s.sale)) AS revenue
        FROM appointments a
        LEFT JOIN app_detail ad ON a.id = ad.id_appointment
        LEFT JOIN services s ON ad.id_service = s.id
        WHERE DATE(a.created_at) BETWEEN '$startDate' AND '$endDate'
        GROUP BY label
        ORDER BY label ASC
    ";

    return query_exe($sql); // Không truyền mảng nếu không dùng bind
}

// === 1. Thống kê dịch vụ theo ngày trong tuần hiện tại ===
function get_weekly_service_stats() {
    $start = date('Y-m-d', strtotime('monday this week'));
    $end = date('Y-m-d');

    $raw = get_service_stats_grouped_by($start, $end, 'DATE');

    $outputByDate = [];
    $current = new DateTime($start);
    $endDate = new DateTime($end);

    while ($current <= $endDate) {
        $label = $current->format('Y-m-d');
        $outputByDate[$label] = ['revenue' => 0, 'new_order' => 0, 'used_service' => 0];
        $current->modify('+1 day');
    }

    foreach ($raw as $row) {
        $label = $row['label'];
        if (isset($outputByDate[$label])) {
            $outputByDate[$label] = [
                'revenue' => round((float)$row['revenue'] / 1000000, 2),
                'new_order' => (int)$row['new_order'],
                'used_service' => (int)$row['used_service']
            ];
        }
    }

    $result = ['date' => [], 'revenue' => [], 'new_order' => [], 'used_service' => []];

    foreach ($outputByDate as $date => $data) {
        $result['date'][] = $date;  // Only the date for weekly stats
        $result['revenue'][] = $data['revenue'];
        $result['new_order'][] = $data['new_order'];
        $result['used_service'][] = $data['used_service'];
    }

    return $result;
}


// === 2. Thống kê dịch vụ theo ngày trong tháng hiện tại ===
function get_monthly_service_stats() {
    $start = date('Y-m-01');
    $end = date('Y-m-d');

    $raw = get_service_stats_grouped_by($start, $end, 'DATE');

    $outputByDate = [];
    $current = new DateTime($start);
    $endDate = new DateTime($end);

    while ($current <= $endDate) {
        $label = $current->format('Y-m-d');
        $outputByDate[$label] = ['revenue' => 0, 'new_order' => 0, 'used_service' => 0];
        $current->modify('+1 day');
    }

    foreach ($raw as $row) {
        $label = $row['label'];
        if (isset($outputByDate[$label])) {
            $outputByDate[$label] = [
                'revenue' => round((float)$row['revenue'] / 1000000, 2),
                'new_order' => (int)$row['new_order'],
                'used_service' => (int)$row['used_service']
            ];
        }
    }

    $result = ['date' => [], 'revenue' => [], 'new_order' => [], 'used_service' => []];

    foreach ($outputByDate as $date => $data) {
        $result['date'][] = $date;
        $result['revenue'][] = $data['revenue'];
        $result['new_order'][] = $data['new_order'];
        $result['used_service'][] = $data['used_service'];
    }

    return $result;
}


// === 3. Thống kê dịch vụ theo tháng trong năm hiện tại ===
function get_yearly_service_stats() {
    $start = date('Y-01-01');
    $end = date('Y-m-d');

    $raw = get_service_stats_grouped_by($start, $end, 'MONTH');

    $outputByMonth = [];
    for ($m = 1; $m <= 12; $m++) {
        $label = date('Y-') . str_pad($m, 2, '0', STR_PAD_LEFT);
        $outputByMonth[$label] = ['revenue' => 0, 'new_order' => 0, 'used_service' => 0];
    }

    foreach ($raw as $row) {
        $label = $row['label'];
        if (isset($outputByMonth[$label])) {
            $outputByMonth[$label] = [
                'revenue' => round((float)$row['revenue'] / 1000000, 2),
                'new_order' => (int)$row['new_order'],
                'used_service' => (int)$row['used_service']
            ];
        }
    }

    $result = ['month' => [], 'revenue' => [], 'new_order' => [], 'used_service' => []];

    foreach ($outputByMonth as $month => $data) {
        $result['month'][] = $month;  // Only month for yearly stats
        $result['revenue'][] = $data['revenue'];
        $result['new_order'][] = $data['new_order'];
        $result['used_service'][] = $data['used_service'];
    }

    return $result;
}
function get_recent_services($limit = 5) {
    $sql = "SELECT
        a.id AS appointment_id,
        a.created_at AS appointment_date,
        b.name AS barber_name,
        s.name AS service_name
        FROM appointments a
            JOIN app_detail ad ON a.id = ad.id_appointment
            JOIN services s ON ad.id_service = s.id
            JOIN barbers b ON a.id_barber = b.id
        ORDER BY a.created_at DESC
        LIMIT 8
    ";
    
    return query_exe($sql, [$limit]) ?: [];  // Ensure it returns an empty array if no results
}
