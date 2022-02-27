<?php
require_once APP_PATH . '/library/functions.php';
function product_add($params=[]){
    //cải tiến câu lệnh sql cho phù hợp với truy vấn , nếu cột nào trống
    $sql="INSERT INTO tb_hang_hoa(ten_hh,ma_th,ma_mh,don_gia,giam_gia,hinh,ngay_nhap,mo_ta,dac_biet,so_luot_xem,banner,status,storage,so_luong,ram) VALUES (:ten_hh,:ma_th,:ma_mh,:don_gia,:giam_gia,:hinh,:ngay_nhap,:mo_ta,:dac_biet,:so_luot_xem,:banner,:status,:storage,:so_luong,:ram)";
    return pdo_execute($sql,$params); //trả về id khi thêm mới
}
function product_edit($params=[]){
    //cải tiến câu lệnh sql cho phù hợp với truy vấn , nếu cột nào trống
    $sql="UPDATE tb_hang_hoa SET ten_hh=:ten_hh,ma_th=:ma_th,ma_mh=:ma_mh,don_gia=:don_gia,giam_gia=:giam_gia,hinh=:hinh,ngay_nhap=:ngay_nhap,mo_ta=:mo_ta,dac_biet=:dac_biet,so_luot_xem=:so_luot_xem,banner=:banner,status=:status,so_luong=:so_luong,ram=:ram,storage=:storage WHERE ma_hh=:ma_hh";
    return pdo_execute($sql,$params); //trả về id khi thêm mới
}
function product_delete($params=[]){

    $sql="DELETE FROM tb_hang_hoa WHERE ma_hh=:ma_hh";

    return pdo_execute($sql,$params);
}
function product_delete_multi($str_ma_hh){
    //str_ma_kh 4,6,7,89,
    $sql="DELETE FROM tb_hang_hoa WHERE ma_hh IN ($str_ma_hh)";

    return pdo_execute($sql,[]);
}
function product_list_all(){
    $sql="SELECT * FROM tb_hang_hoa ORDER BY ma_hh ASC";
    return pdo_query($sql);
}
function product_select_page(){
    $row_per_page = 10; // số bản ghi trên 1 trang
    $current_page = exist_param("page_no") ? $_REQUEST['page_no'] : 1;
    $total_row = pdo_query_value("SELECT count(*) FROM tb_hang_hoa"); //đếm tổng số bản ghi
    $total_page = ceil($total_row / $row_per_page); //tính ra số lượng trang
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_page)
        $current_page = $total_page;
    $start = ($current_page - 1) * $row_per_page;
    $sql = "SELECT * FROM tb_hang_hoa ORDER BY ma_hh DESC LIMIT {$start}, {$row_per_page} ";
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
function product_get_one($params=[]){
    $sql="SELECT * FROM tb_hang_hoa WHERE ma_hh=:ma_hh";
    //ghép nối các tham số vào câu lệnh sql
    foreach($params as $field_name=>$value)
    $sql.= " AND {$field_name} = :{$field_name} ";
    //vd: $sql.= "AND username=:username " ;
    return pdo_query_one($sql, $params); //trả về ID khi thêm mới
}

function count_product(){
    $sql="SELECT COUNT(ma_hh)  FROM tb_hang_hoa";
    return pdo_query_value($sql);
}
function product_check_so_luot_xem()
{
    $sql = "SELECT SUM(so_luot_xem) FROM tb_hang_hoa WHERE so_luot_xem > 0";
    return pdo_query_value($sql);
}

function count_product_day_arr(){

    $sql="SELECT COUNT(*) AS total_product,ngay_nhap FROM tb_hang_hoa WHERE (ngay_nhap BETWEEN'2020-11-01' AND '2020-11-30') GROUP BY ngay_nhap";
    return pdo_query($sql);
}

function so_luot_xem()
{
    $sql = "SELECT SUM(so_luot_xem) FROM tb_hang_hoa WHERE so_luot_xem > 0";
    return pdo_query_value($sql);
}
function count_giam_gia()
{
    $sql = "SELECT COUNT(giam_gia) FROM tb_hang_hoa WHERE giam_gia > 0";
    return pdo_query_value($sql);
}
function recent_product()
{
    $sql = "SELECT * FROM tb_hang_hoa  ORDER BY ma_hh DESC LIMIT 0, 4";
    return pdo_query($sql);
}
function product_add_cart($ma_hh){
    $sql = "SELECT * FROM tb_hang_hoa WHERE ma_hh IN ($ma_hh)";
    return pdo_query($sql,[]);
}


// hung

// hung code
function product_list_by_option_($params = [])
{
    $row_per_page = 8; // số bản ghi trên 1 trang
    $current_page = exist_param("page_no") ? $_REQUEST['page_no'] : 1;
    $sqll = "SELECT count(*) FROM tb_hang_hoa JOIN tb_mat_hang ON tb_hang_hoa.ma_mh = tb_mat_hang.ma_mh JOIN tb_thuong_hieu ON tb_hang_hoa.ma_th = tb_thuong_hieu.ma_th WHERE ten_mh='{$_GET['ten_mh']}'";
    $total_row = pdo_query_value($sqll);

    //đếm tổng số bản ghi
    $total_page = ceil($total_row / $row_per_page); //tính ra số lượng trang
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_page)
        $current_page = $total_page;
    $start = ($current_page - 1) * $row_per_page;
    $sql = "SELECT * FROM tb_hang_hoa
    JOIN tb_mat_hang ON tb_hang_hoa.ma_mh = tb_mat_hang.ma_mh
    JOIN tb_thuong_hieu ON tb_hang_hoa.ma_th = tb_thuong_hieu.ma_th
    WHERE ten_mh=:ten_mh ";

    //cho các thiết lập vào session để view có thể dùng
    $_SESSION['total_page'] = $total_page;
    $_SESSION['prev_page'] = ($current_page > 1) ? ($current_page - 1) : 1;
    $_SESSION['next_page'] = ($current_page < $total_page) ? ($current_page + 1) : $total_page;

    foreach ($params as $field_name => $value) {
        $sql .= " AND {$field_name} = :{$field_name} LIMIT {$start}, {$row_per_page}";
    }
    return pdo_query($sql, $params);
}

function sp_tang_so_luot_xem($params)
{
    $sql = "UPDATE tb_hang_hoa SET so_luot_xem=so_luot_xem + 1 WHERE ma_hh=:ma_hh";
    pdo_execute($sql, $params);
}

function product_list_by_option($params = [])
{
    $sql = "SELECT *
    FROM tb_hang_hoa
    JOIN tb_mat_hang ON tb_hang_hoa.ma_mh = tb_mat_hang.ma_mh
    JOIN tb_thuong_hieu ON tb_hang_hoa.ma_th = tb_thuong_hieu.ma_th
    WHERE ten_mh=:ten_mh";
    foreach ($params as $field_name => $value) {
        $sql .= " AND {$field_name} = :{$field_name} ";
    }
    return pdo_query($sql, $params);
}

function product_list_top10($mat_hang)
{
    $sql = "SELECT *
    FROM tb_hang_hoa
    JOIN tb_mat_hang ON tb_hang_hoa.ma_mh = tb_mat_hang.ma_mh
    WHERE tb_mat_hang.ten_mh = '$mat_hang' LIMIT 10
    ";
    return pdo_query($sql);
}

/**
 * lấy ra 1 bản ghi có join đến 2 bảng mặt hàng và thương hiệu 
 */
function product_join_get_one($params = [])
{
    $sql = "SELECT *
    FROM tb_hang_hoa
    JOIN tb_mat_hang ON tb_hang_hoa.ma_mh = tb_mat_hang.ma_mh
    JOIN tb_thuong_hieu ON tb_hang_hoa.ma_mh = tb_mat_hang.ma_mh
    WHERE ma_hh=:ma_hh";
    //ghép nối các tham số vào câu lệnh sql
    foreach ($params as $field_name => $value)
        $sql .= " AND {$field_name} = :{$field_name} ";

    return pdo_query_one($sql, $params); //trả về ID khi thêm mới
}

function get_ramAndStorage_product_by_categories($mat_hang, $option)
{
    $sql = "SELECT DISTINCT tb_hang_hoa.$option
    FROM tb_hang_hoa
    JOIN tb_mat_hang ON tb_hang_hoa.ma_mh = tb_mat_hang.ma_mh
    WHERE tb_hang_hoa.status= 1 AND tb_mat_hang.ten_mh = '$mat_hang' ORDER BY tb_hang_hoa.$option DESC";
    // print_r($sql);
    // die();
    return pdo_query($sql);
}
function get_ramAndStorage_product($option)
{
    $sql = "SELECT DISTINCT tb_hang_hoa.$option
    FROM tb_hang_hoa
    WHERE tb_hang_hoa.status= 1 ORDER BY tb_hang_hoa.$option DESC";
    // print_r($sql);
    // die();
    return pdo_query($sql);
}

function get_top4_by_brand_and_cate($thuong_hieu,$mat_hang){
    $sql = "SELECT *
    FROM tb_hang_hoa
    JOIN tb_mat_hang ON tb_hang_hoa.ma_mh = tb_mat_hang.ma_mh
    JOIN tb_thuong_hieu ON tb_hang_hoa.ma_th = tb_thuong_hieu.ma_th
    WHERE tb_hang_hoa.status=1 AND tb_thuong_hieu.ten_th = '$thuong_hieu' AND tb_mat_hang.ten_mh = '$mat_hang' 
    ORDER BY tb_hang_hoa.so_luot_xem DESC LIMIT 4
    ";
    return pdo_query($sql);
}


function infoSP($ma_hh){

    $sql="SELECT * FROM tb_hang_hoa WHERE ma_hh='$ma_hh'";
    $kq=$GLOBALS['conn']->query($sql)->fetch();
    return $kq;
}
?>
