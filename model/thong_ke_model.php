<?php
require_once APP_PATH.'/library/pdo.php';
function thong_ke_hang_hoa()
{
    $sql = "SELECT lo.ma_mh, lo.ten_mh,"
        . " COUNT(*) so_luong,"
        . " MIN(hh.don_gia) gia_min,"
        . " MAX(hh.don_gia) gia_max,"
        . " AVG(hh.don_gia) gia_avg"
        . " FROM tb_hang_hoa hh "
        . " JOIN tb_mat_hang lo ON lo.ma_mh=hh.ma_mh "
        . " GROUP BY lo.ma_mh, lo.ten_mh";
    return pdo_query($sql);
}
function thong_ke_binh_luan(){
    $sql = "SELECT hh.ma_hh, hh.ten_hh,"
    . " COUNT(*) so_luong,"
    . " MIN(bl.ngay_bl) cu_nhat,"
    . " MAX(bl.ngay_bl) moi_nhat"
    . " FROM tb_binh_luan bl "
    . " JOIN tb_hang_hoa hh ON hh.ma_hh=bl.ma_hh "
    . " GROUP BY hh.ma_hh, hh.ten_hh"
    . " HAVING so_luong > 0";
return pdo_query($sql);
}
function comment_select_page(){
    $row_per_page = 10; // số bản ghi trên 1 trang
    $current_page = exist_param("page_no") ? $_REQUEST['page_no'] : 1;
    $total_row = pdo_query_value("SELECT COUNT(*)  FROM tb_binh_luan JOIN tb_hang_hoa ON tb_hang_hoa.ma_hh=tb_binh_luan.ma_hh"); //đếm tổng số bản ghi
    $total_page = ceil($total_row / $row_per_page); //tính ra số lượng trang
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_page)
        $current_page = $total_page;
    $start = ($current_page - 1) * $row_per_page;
    $sql = "SELECT tb_hang_hoa.ma_hh , tb_hang_hoa.ten_hh , COUNT(*) so_luong , MIN(tb_binh_luan.ngay_bl) moi_nhat , MAX(tb_binh_luan.ngay_bl) cu_nhat FROM tb_binh_luan JOIN tb_hang_hoa ON tb_hang_hoa.ma_hh=tb_binh_luan.ma_hh GROUP BY tb_hang_hoa.ma_hh , tb_hang_hoa.ten_hh HAVING COUNT(*)>0 LIMIT {$start}, {$row_per_page} ";
    //cho các thiết lập vào session để view có thể dùng
    $_SESSION['total_page'] = $total_page;
    $_SESSION['prev_page'] = ($current_page > 1) ? ($current_page - 1) : 1;
    $_SESSION['next_page'] = ($current_page < $total_page) ? ($current_page + 1) : $total_page;
    return pdo_query($sql);
   
}

?>