<?php

// hàm kết nối đến cơ sở dữ liệu
function connection()
{
    $host = "dpg-d0rjtmali9vc738m47q0-a"; // Thay bằng host thật
    $port = "5432";
    $dbname = "cattoc";
    $username = "cattoc_user"; // Thay bằng username thật
    $password = "M3XSPqEo531FE63QXBppN06n3GHezKc7";   // Thay bằng password thật

    $conn = null;
    if (!$conn) {
    die('Không thể kết nối database.');
}
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Lỗi Kết nối: " . $e->getMessage();
    }
    return $conn;
}

//Hàm lấy toàn bộ dữ liệu của 1 bảng $table
function listAll($table){
    $conn = connection();
    if (!$conn) {
        die('Không thể kết nối database.');
    }
    try{
        $sql = "SELECT * FROM $table ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e){
        echo "Lỗi xử lý dữ liệu".$e->getMessage();
    }finally{
        unset($conn);
    }
    return $result ?? [];
}

//function lấy toàn bộ bản ghi
//$sql lệnh sql select
function query_exe($sql) {
    $conn = connection();
    if (!$conn) {
    die('Không thể kết nối database.');
}
    try {        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi dữ liệu" . $e->getMessage();
    } finally {
        unset($conn);
    }
}

function query_limit($sql) {
    $conn = connection();
    if (!$conn) {
    die('Không thể kết nối database.');
}
    try {        
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi dữ liệu" . $e->getMessage();
    } finally {
        unset($conn);
    }
}

//Hàm lấy ra 1 bản ghi trong bảng dữ liệu
//$id là cột mã
//$value giá trị của id
function listOne($table, $id, $value) {
    $conn = connection();
    if (!$conn) {
    die('Không thể kết nối database.');
}
    try {
        $sql = "Select * from $table WHERE $id=:$id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":$id", $value);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Lỗi không thể lấy dữ liệu" . $e->getMessage();
    } finally {
        unset($conn);
    }
    return $result;
}

//Hàm thêm 1 bản ghi vào trong cơ sở dữ liệu
//$table bảng dữ liệu cần thêm
//$data mảng dữ liệu cần thêm
function insert($table, $data=array()) {
    $conn = connection();
    if (!$conn) {
    die('Không thể kết nối database.');
}
    try {
        $sql = "INSERT INTO $table set ";

        foreach ($data as $key => $value) {
            $sql .= "$key=:$key, ";
        }
        $sql = rtrim($sql, ", ");
       $stmt = $conn->prepare($sql);
       $result = $stmt->execute($data);
    } catch (PDOException $e) {
        echo "Lỗi dữ liệu" . $e->getMessage();
    } finally {
        unset($conn);
    }
    return $result;
}

//function update data
//$table bảng dữ liệu cần update
//$id, $value điều kiện update
//$data dữ liệu cần update
function update($table, $id, $value_id, $data = array()) {    
    $conn = connection();
   
    try {
        $sql = "UPDATE $table SET ";
        foreach ( $data as $key => $value ) {
            $sql .= "$key=:$key, ";
        }
        $sql = rtrim($sql, ", ");
        $sql .= " WHERE $id=:$id";
        $data[$id] = $value_id;
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute($data);
    } catch (PDOException $e) {
        echo "Lỗi dữ liệu" . $e->getMessage();
    } finally {
        unset($conn);
    }
    return $result;
}

//function Xóa dữ liệu
//$table bảng dữ liệu cần xóa
//có điều kiện là $id với giá trị là $value
function delete($table, $id, $value) {
    $conn = connection();
   
    try {
        $sql = "DELETE FROM $table WHERE $id=:$id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":$id", $value);
        $result = $stmt->execute();
    } catch (PDOException $e) {
        echo "Lỗi dữ liệu" . $e->getMessage();
    } finally {
        unset($conn);
    }
    return $result;
}

//function
function list_where_one($table, $codition = array()) {
    $conn = connection();
   
    try {
        $sql = "Select * from $table WHERE ";
        foreach ($codition as $cod) {
            $sql .= $cod . " ";
        }
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}
//ham dem slg ban ghi trong bang
function count_row($table){
    $conn = connection();
  
    $sql = $conn->prepare("SELECT COUNT(*) FROM $table"); 
        $sql->execute(); 
        $num_row = $sql->fetchColumn();
        return $num_row;
}

//thuc thi cau lenh sql co dieu kien
function query_where($table, $arr,$limit,$nRows)
{
    $conn = connection();
    
    try {
        $sql = "SELECT * FROM $table where $arr[0] $arr[1] :$arr[0] order by id desc limit $limit, $nRows";
        $stmt = $conn->prepare($sql);
        $data = [
            $arr[0] => $arr[1]
        ];
        $stmt->execute($data);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi dữ liệu" . $e->getMessage();
    } finally {
        unset($conn);
    }
}