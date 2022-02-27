<?php
require_once APP_PATH . '/library/functions.php';
function posts_add($params=[]){
    //cải tiến câu lệnh sql cho phù hợp với truy vấn , nếu cột nào trống
    $sql="INSERT INTO tb_bai_viet(ten_bv,ma_bv,hinh,ngay_db,mo_ta,noi_dung,luot_xem,ma_hh) VALUES (:ten_bv,:ma_bv,:hinh,:ngay_db,:mo_ta,:noi_dung,:luot_xem,:ma_hh) ";
    return pdo_execute($sql,$params); //trả về id khi thêm mới
}
function posts_edit($params=[]){
    //cải tiến câu lệnh sql cho phù hợp với truy vấn , nếu cột nào trống
    $sql="UPDATE tb_bai_viet SET ten_bv=:ten_bv,ma_bv=:ma_bv,hinh=:hinh,ngay_db=:ngay_db,mo_ta=:mo_ta,noi_dung=:noi_dung,luot_xem=:luot_xem,ma_hh=:ma_hh WHERE ma_bv=:ma_bv";
    return pdo_execute($sql,$params); //trả về id khi thêm mới
}
function posts_delete($params=[]){

    $sql="DELETE FROM tb_bai_viet WHERE ma_bv=:ma_bv";

    return pdo_execute($sql,$params);
}
function posts_delete_multi($str_ma_bv){
    //str_ma_kh 4,6,7,89,
    $sql="DELETE FROM tb_bai_viet WHERE ma_bv IN ($str_ma_bv)";

    return pdo_execute($sql,[]);
}
function posts_list_all(){
    $sql="SELECT * FROM tb_bai_viet ORDER BY ma_bv ASC";
    return pdo_query($sql);
}
function posts_select_page(){
    $row_per_page = 10; // số bản ghi trên 1 trang
    $current_page = exist_param("page_no") ? $_REQUEST['page_no'] : 1;
    $total_row = pdo_query_value("SELECT count(*) FROM tb_bai_viet"); //đếm tổng số bản ghi
    $total_page = ceil($total_row / $row_per_page); //tính ra số lượng trang
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_page)
        $current_page = $total_page;
    $start = ($current_page - 1) * $row_per_page;
    $sql = "SELECT * FROM tb_bai_viet ORDER BY ma_bv DESC LIMIT {$start}, {$row_per_page} ";
    //cho các thiết lập vào session để view có thể dùng
    $_SESSION['total_page'] = $total_page;
    $_SESSION['prev_page'] = ($current_page > 1) ? ($current_page - 1) : 1;
    $_SESSION['next_page'] = ($current_page < $total_page) ? ($current_page + 1) : $total_page;
    return pdo_query($sql);
   
}
/**
 * hàm dùng để lấy thông tin của 1 bản ghi có thể dùng để đăng nhập, dùng cho chức năng sửa
 * 
 */
function posts_get_one($params=[]){
    $sql="SELECT * FROM tb_bai_viet WHERE ma_bv=:ma_bv";
    //ghép nối các tham số vào câu lệnh sql
    foreach($params as $field_name=>$value)
    $sql.= " AND {$field_name} = :{$field_name} ";
    //vd: $sql.= "AND username=:username " ;
    return pdo_query_one($sql, $params); //trả về ID khi thêm mới
}

// function count_product(){
//     $sql="SELECT COUNT(ma_hh)  FROM tb_hang_hoa";
//     return pdo_query_value($sql);
// }
// function product_check_so_luot_xem()
// {
//     $sql = "SELECT SUM(so_luot_xem) FROM tb_hang_hoa WHERE so_luot_xem > 0";
//     return pdo_query_value($sql);
// }

// function count_product_day_arr(){

//     $sql="SELECT COUNT(*) AS total_product,ngay_nhap FROM tb_hang_hoa WHERE (ngay_nhap BETWEEN'2020-11-01' AND '2020-11-30') GROUP BY ngay_nhap";
//     return pdo_query($sql);
// }

// function so_luot_xem()
// {
//     $sql = "SELECT SUM(so_luot_xem) FROM tb_hang_hoa WHERE so_luot_xem > 0";
//     return pdo_query_value($sql);
// }

?>
