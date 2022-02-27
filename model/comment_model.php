<?php
require_once APP_PATH . '/library/functions.php';
function comment_add($params = [])
{
    $sql = "INSERT INTO tb_binh_luan(noi_dung,ngay_bl,ma_hh,ma_kh) VALUES (:noi_dung,:ngay_bl,:ma_hh,:ma_kh)";
    return pdo_execute($sql, $params);
}
// function comment_edit($params=[]){
//     $sql = "UPDATE tb_binh_luan SET ma_bl=:ma_bl,noi_dung=:noi_dung,ngay_bl=:ngay_bl,ma_hh=:ma_hh,ma_kh=:ma_kh WHERE ma_bl=:ma_bl";
//      return pdo_execute($sql,$params);
// }
function comment_delete($params = [])
{
    $sql = "DELETE FROM tb_binh_luan WHERE ma_bl=:ma_bl";

    return pdo_execute($sql, $params);
}
function comment_delete_multi($str_ma_bl)
{
    //str_ma_kh 4,6,7,89,
    $sql = "DELETE FROM tb_binh_luan WHERE ma_bl IN ($str_ma_bl)";

    return pdo_execute($sql, []);
}

function comment_list_all()
{
    $sql = "SELECT * FROM tb_binh_luan ORDER BY ngay_bl DESC";
    return pdo_query($sql);
}

function comment_get_one($params = [])
{
    $sql = "SELECT * FROM tb_binh_luan WHERE ma_bl=:ma_bl";
    //ghép nối các tham số vào câu lệnh sql
    foreach ($params as $field_name => $value)
        $sql .= " AND {$field_name} = :{$field_name} ";
    //vd: $sql.= "AND username=:username " ;
    return pdo_query_one($sql, $params); //trả về ID khi thêm mới
}

function comment_select_by_product($params = [])
{
    $sql = "SELECT b.*, h.ten_hh FROM tb_binh_luan b JOIN tb_hang_hoa h ON h.ma_hh=b.ma_hh WHERE b.ma_hh=:ma_hh ORDER BY ngay_bl DESC";
    return pdo_query($sql, $params);
}

// hung

function get_bl_by_id_hang_hoa($ma_hh)
{
    $sql  = "SELECT * FROM `tb_binh_luan` 
    JOIN tb_khach_hang ON tb_binh_luan.ma_kh = tb_khach_hang.ma_kh
    WHERE ma_hh=$ma_hh ORDER BY ma_bl DESC";
    return pdo_query($sql);
}
// function comment_select_page_by_product(){
//     $row_per_page = 10; // số bản ghi trên 1 trang
//     $current_page = exist_param("page_no") ? $_REQUEST['page_no'] : 1;
//     $total_row = pdo_query_value("SELECT COUNT(*)  FROM tb_binh_luan JOIN tb_hang_hoa ON tb_hang_hoa.ma_hh=tb_binh_luan.ma_hh"); //đếm tổng số bản ghi
//     $total_page = ceil($total_row / $row_per_page); //tính ra số lượng trang
//     if ($current_page < 1)
//         $current_page = 1;
//     if ($current_page > $total_page)
//         $current_page = $total_page;
//     $start = ($current_page - 1) * $row_per_page;
//     $sql = "SELECT tb_hang_hoa.ma_hh , tb_hang_hoa.ten_hh , COUNT(*) so_luong , MIN(tb_binh_luan.ngay_bl) moi_nhat , MAX(tb_binh_luan.ngay_bl) cu_nhat FROM tb_binh_luan JOIN tb_hang_hoa ON tb_hang_hoa.ma_hh=tb_binh_luan.ma_hh GROUP BY tb_hang_hoa.ma_hh , tb_hang_hoa.ten_hh HAVING COUNT(*)>0 LIMIT {$start}, {$row_per_page} ";
//     //cho các thiết lập vào session để view có thể dùng
//     $_SESSION['total_page'] = $total_page;
//     $_SESSION['prev_page'] = ($current_page > 1) ? ($current_page - 1) : 1;
//     $_SESSION['next_page'] = ($current_page < $total_page) ? ($current_page + 1) : $total_page;
//     return pdo_query($sql);
   
// }
