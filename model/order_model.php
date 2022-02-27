<?php
require_once APP_PATH . '/library/functions.php';
function order_add($params = [])
{
    $sql = "INSERT INTO tb_hoa_don(ma_hd,nguoi_nhan,sdt,dia_chi,trang_thai,nguoi_lap_don,ngay_lap_don,tong_tien) VALUES (:ma_hd,:nguoi_nhan,:sdt,:dia_chi,:trang_thai,:nguoi_lap_don,:ngay_lap_don,:tong_tien)";
    return pdo_execute($sql, $params);
}


function order_list_all()
{
    $sql = "SELECT * FROM tb_hoa_don ORDER BY ma_hd DESC";
    return pdo_query($sql);
}
function order_select_by_order_detail($params = [])
{
    $sql = "SELECT * FROM tb_hoa_don JOIN tb_hoa_don_chi_tiet ON tb_hoa_don.ma_hd=tb_hoa_don_chi_tiet.ma_hd WHERE tb_hoa_don.ma_hd=:ma_hd";
    return pdo_query($sql, $params);
}
function order_select_page()
{
    $row_per_page = 10; // số bản ghi trên 1 trang
    $current_page = exist_param("page_no") ? $_REQUEST['page_no'] : 1;
    $total_row = pdo_query_value("SELECT count(*) FROM tb_hoa_don"); //đếm tổng số bản ghi
    $total_page = ceil($total_row / $row_per_page); //tính ra số lượng trang
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_page)
        $current_page = $total_page;
    $start = ($current_page - 1) * $row_per_page;
    $sql = "SELECT * FROM tb_hoa_don LIMIT {$start}, {$row_per_page}";
    //cho các thiết lập vào session để view có thể dùng
    $_SESSION['total_page'] = $total_page;
    $_SESSION['prev_page'] = ($current_page > 1) ? ($current_page - 1) : 1;
    $_SESSION['next_page'] = ($current_page < $total_page) ? ($current_page + 1) : $total_page;
    return pdo_query($sql);
}
function order_list_status()
{
    $sql = "SELECT tb_hoa_don.trang_thai FROM tb_hoa_don";
    return pdo_query($sql);
}
function order_get_one($params = [])
{
    $sql = "SELECT * FROM tb_hoa_don WHERE ma_hd=:ma_hd";
    //ghép nối các tham số vào câu lệnh sql
    foreach ($params as $field_name => $value)
        $sql .= " AND {$field_name} = :{$field_name} ";
    //vd: $sql.= "AND username=:username " ;
    return pdo_query_one($sql, $params); //trả về ID khi thêm mới
}
function sum_cart_by_day()
{
    $sql = "SELECT SUM(tb_hoa_don.tong_tien) as tong_tien,tb_hoa_don.ngay_lap_don as ngay_lap FROM tb_hoa_don GROUP BY (tb_hoa_don.ngay_lap_don)";
    return pdo_query($sql);
}
function count_order()
{
    $sql = "SELECT COUNT(tb_hoa_don.ma_hd) as so_hoa_don FROM tb_hoa_don";
    return pdo_query_value($sql);
}
function count_order_complete()
{
    $sql = "SELECT COUNT(tb_hoa_don.ma_hd) FROM tb_hoa_don WHERE tb_hoa_don.trang_thai=2";
    return pdo_query_value($sql);
}
function count_order_not_delivery()
{
    $sql = "SELECT COUNT(tb_hoa_don.ma_hd) FROM tb_hoa_don WHERE tb_hoa_don.trang_thai=0";
    return pdo_query_value($sql);
}
function count_order_delivered()
{
    $sql = "SELECT COUNT(tb_hoa_don.ma_hd) FROM tb_hoa_don WHERE tb_hoa_don.trang_thai=1";
    return pdo_query_value($sql);
}
