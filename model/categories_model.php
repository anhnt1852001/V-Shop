<?php
require_once APP_PATH . '/library/functions.php';
function categories_add($params=[]){
    //cải tiến câu lệnh sql cho phù hợp với truy vấn , nếu cột nào trống
    $sql="INSERT INTO tb_mat_hang(ma_mh,ten_mh) VALUES (:ma_mh,:ten_mh)";
    return pdo_execute($sql,$params); //trả về id khi thêm mới
}
function categories_edit($params=[]){
    //cải tiến câu lệnh sql cho phù hợp với truy vấn , nếu cột nào trống
    $sql="UPDATE tb_mat_hang SET ten_mh=:ten_mh WHERE ma_mh=:ma_mh";
    return pdo_execute($sql,$params); //trả về id khi thêm mới
}
function categories_delete($params=[]){
    $sql="DELETE FROM tb_mat_hang WHERE ma_mh=:ma_mh";
    return pdo_execute($sql,$params);
}
function categories_delete_multi($str_ma_mh){
    //str_ma_kh 4,6,7,89,
    $sql="DELETE FROM tb_mat_hang WHERE ma_mh IN ($str_ma_mh)";

    return pdo_execute($sql,[]);
}

function categories_list_all(){
    $sql="SELECT * FROM tb_mat_hang ORDER BY ma_mh ASC";
    return pdo_query($sql);
}
function categories_select_page(){
    $row_per_page = 8; // số bản ghi trên 1 trang
    $current_page = exist_param("page_no") ? $_REQUEST['page_no'] : 1;
    $total_row = pdo_query_value("SELECT count(*) FROM tb_mat_hang"); //đếm tổng số bản ghi
    $total_page = ceil($total_row / $row_per_page); //tính ra số lượng trang
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_page)
        $current_page = $total_page;
    $start = ($current_page - 1) * $row_per_page;
    $sql = "SELECT * FROM tb_mat_hang LIMIT {$start}, {$row_per_page}";
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
function categories_get_one($params=[]){
    $sql="SELECT * FROM tb_mat_hang WHERE ma_mh=:ma_mh";
    //ghép nối các tham số vào câu lệnh sql
    foreach($params as $field_name=>$value)
    $sql.= " AND {$field_name} = :{$field_name} ";
    //vd: $sql.= "AND username=:username " ;
    return pdo_query_one($sql, $params); //trả về ID khi thêm mới
}
?>