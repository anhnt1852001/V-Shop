<?php
require_once APP_PATH . '/library/functions.php';
function trademark_add($params=[]){
    //cải tiến câu lệnh sql cho phù hợp với truy vấn , nếu cột nào trống
    $sql="INSERT INTO tb_thuong_hieu(ma_th,ten_th) VALUES (:ma_th,:ten_th)";
    return pdo_execute($sql,$params); //trả về id khi thêm mới
}
function trademark_edit($params=[]){
    //cải tiến câu lệnh sql cho phù hợp với truy vấn , nếu cột nào trống
    $sql="UPDATE tb_thuong_hieu SET ten_th=:ten_th WHERE ma_th=:ma_th";
    return pdo_execute($sql,$params); //trả về id khi thêm mới
}
function trademark_delete($params=[]){
    $sql="DELETE FROM tb_thuong_hieu WHERE ma_th=:ma_th";
    return pdo_execute($sql,$params);
}
function trademark_delete_multi($str_ma_th){
    //str_ma_kh 4,6,7,89,
    $sql="DELETE FROM tb_thuong_hieu WHERE ma_th IN ($str_ma_th)";

    return pdo_execute($sql,[]);
}
function trademark_list_all(){
    $sql="SELECT * FROM tb_thuong_hieu ORDER BY ma_th ASC";
    return pdo_query($sql);
}
function trademark_select_page(){
    $row_per_page = 10; // số bản ghi trên 1 trang
    $current_page = exist_param("page_no") ? $_REQUEST['page_no'] : 1;
    $total_row = pdo_query_value("SELECT count(*) FROM tb_thuong_hieu"); //đếm tổng số bản ghi
    $total_page = ceil($total_row / $row_per_page); //tính ra số lượng trang
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_page)
        $current_page = $total_page;
    $start = ($current_page - 1) * $row_per_page;
    $sql = "SELECT * FROM tb_thuong_hieu LIMIT {$start}, {$row_per_page}";
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
function trademark_get_one($params=[]){
    $sql="SELECT * FROM tb_thuong_hieu WHERE ma_th=:ma_th";
    //ghép nối các tham số vào câu lệnh sql
    foreach($params as $field_name=>$value)
    $sql.= " AND {$field_name} = :{$field_name} ";
    //vd: $sql.= "AND username=:username " ;
    return pdo_query_one($sql, $params); //trả về ID khi thêm mới
}

// hung
function get_all_thuong_hieu()
{
    $sql = "SELECT DISTINCT tb_thuong_hieu.ten_th
    FROM tb_hang_hoa
    JOIN tb_thuong_hieu ON tb_hang_hoa.ma_th = tb_thuong_hieu.ma_th
    WHERE tb_hang_hoa.status=1 ORDER BY tb_thuong_hieu.ten_th DESC
    ";
    return pdo_query($sql);
}
function get_id_thuongHieu($ma_hang)
{
    $sql = "SELECT *
    FROM tb_hang_hoa
    JOIN tb_mat_hang ON tb_hang_hoa.ma_mh = tb_mat_hang.ma_mh
    WHERE tb_mat_hang.ten_mh = 'laptop'
    ";
    return pdo_query($sql);
}

function get_brand_product_by_categories($mat_hang)
{
    $sql = "SELECT DISTINCT tb_thuong_hieu.ten_th
    FROM tb_hang_hoa
    JOIN tb_thuong_hieu ON tb_hang_hoa.ma_th = tb_thuong_hieu.ma_th
    JOIN tb_mat_hang ON tb_hang_hoa.ma_mh = tb_mat_hang.ma_mh
    WHERE tb_hang_hoa.status= 1 AND tb_mat_hang.ten_mh = '$mat_hang'";
    return pdo_query($sql);
}

?>