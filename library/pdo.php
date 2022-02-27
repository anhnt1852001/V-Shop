<?php
function pdo_get_connection()
{
    $host = "localhost";
    $db_name = "v-shop";
    $db_user = "root";
    $db_pass = '';
    $dburl = "mysql:host={$host};dbname={$db_name};charset=utf8";
    $pdo = new PDO($dburl, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}
/**
 * Thực thi câu lệnh sql thao tác dư liệu
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp các tham số của $sql
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_execute($sql, $params)
{
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        //nếu là câu lệnh sql insert thì trả về id
        if (strpos(strtoupper($sql), 'INSERT') !== false) {
            $last_id = $conn->lastInsertId();
            return $last_id;
        }
    } catch (PDOException $e) {
        throw $e;
    } finally {
        //echo '<pre>';
        //$stmt-debugDumpParams();
        //echo '<pre>';
        unset($conn);
    }
}
/**
 * thực thi câu lệnh sql truy vấn dữ liệu
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_query($sql, $params = [])
{
    try {
        $conn = pdo_get_connection(); //gọi kết nối csdl
        $stmt = $conn->prepare($sql); // chuẩn bị câu lệnh sql
        $stmt->execute($params); //thực thi câu lệnh với tham số truyền vào
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //thiết lập chế độ fetch dữ liệu
        $rows = $stmt->fetchAll(); //lấy dữ liệu
        return $rows;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}

function pdo_query_one($sql, $params = [])
{
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}

function pdo_query_value($sql)
{
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return array_values($row)[0];
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}
