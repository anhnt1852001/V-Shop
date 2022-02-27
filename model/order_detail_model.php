<?php
require_once APP_PATH . '/library/functions.php';
function order_detail_add($params = [])
{
    $sql = "INSERT INTO tb_hoa_don_chi_tiet VALUES (:ma_hd,:ma_hh,:so_luong,:don_gia)";
    return pdo_execute($sql, $params);
}
function order_detail_list_all()
{
    $sql = "SELECT * FROM tb_hoa_don_chi_tiet ORDER BY ma_hd DESC";
    return pdo_query($sql);
}
function sum_sp_order_detail()
{
    $sql = "SELECT SUM(tb_hoa_don_chi_tiet.so_luong) FROM tb_hoa_don_chi_tiet";
    return pdo_query_value($sql);
}
