<?php
require_once APP_PATH . '/library/functions.php';
function slide_add($params=[]){
    //cải tiến câu lệnh sql cho phù hợp với truy vấn , nếu cột nào trống
    $sql="INSERT INTO tb_slide(ma_slide,ten_slide1,ten_slide2,ten_slide3,ten_slide4,ten_slide5,ma_hh) VALUES (:ma_slide,:ten_slide1,:ten_slide2,:ten_slide3,:ten_slide4,:ten_slide5,:ma_hh) ";
    return pdo_execute($sql,$params); //trả về id khi thêm mới
}

function slide_edit($params=[]){
    //cải tiến câu lệnh sql cho phù hợp với truy vấn , nếu cột nào trống
    $sql="UPDATE tb_slide SET ma_hh=:ma_hh,ma_slide=:ma_slide,ten_slide1=:ten_slide1,ten_slide2=:ten_slide2,ten_slide3=:ten_slide3,ten_slide4=:ten_slide4,ten_slide5=:ten_slide5 WHERE ma_slide=:ma_slide";
    return pdo_execute($sql,$params); //trả về id khi thêm mới
}
function slide_delete($params=[]){
    $sql="DELETE FROM tb_slide WHERE ma_slide=:ma_slide";
    return pdo_execute($sql,$params);
}
function slide_delete_multi($str_ma_slide){
    //str_ma_kh 4,6,7,89,
    $sql="DELETE FROM tb_slide WHERE ma_slide IN ($str_ma_slide)";
    return pdo_execute($sql,[]);
}
 function slide_list_all(){
     $sql="SELECT * FROM tb_slide ORDER BY ma_slide ASC";
     return pdo_query($sql);
 }
 function slide_select_page(){
    $row_per_page = 3; // số bản ghi trên 1 trang
    $current_page = exist_param("page_no") ? $_REQUEST['page_no'] : 1;
    $total_row = pdo_query_value("SELECT count(*) FROM tb_slide"); //đếm tổng số bản ghi
    $total_page = ceil($total_row / $row_per_page); //tính ra số lượng trang
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_page)
        $current_page = $total_page;
    $start = ($current_page - 1) * $row_per_page;
    $sql = "SELECT * FROM tb_slide LIMIT {$start}, {$row_per_page}";
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
function slide_get_one($params=[]){
    $sql="SELECT * FROM tb_slide WHERE ma_slide=:ma_slide";
    //ghép nối các tham số vào câu lệnh sql
    foreach($params as $field_name=>$value)
    $sql.= " AND {$field_name} = :{$field_name} ";
    //vd: $sql.= "AND username=:username " ;
    return pdo_query_one($sql, $params); //trả về ID khi thêm mới
}
function slide_get_one1($params=[]){
    $sql="SELECT * FROM tb_slide WHERE ma_hh=:ma_hh";
    //ghép nối các tham số vào câu lệnh sql
    foreach($params as $field_name=>$value)
    $sql.= " AND {$field_name} = :{$field_name} ";
    //vd: $sql.= "AND username=:username " ;
    return pdo_query_one($sql, $params); //trả về ID khi thêm mới
}


//hung 

function slide_list_all_hung()
{
    $row_per_page = 10; // số bản ghi trên 1 trang
    $current_page = exist_param("page_no") ? $_REQUEST['page_no'] : 1;
    $total_row = pdo_query_value("SELECT count(*) FROM tb_slide"); //đếm tổng số bản ghi
    $total_page = ceil($total_row / $row_per_page); //tính ra số lượng trang
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_page)
        $current_page = $total_page;
    $start = ($current_page - 1) * $row_per_page;
    $sql = "SELECT * FROM tb_slide LIMIT {$start}, {$row_per_page}";
    //cho các thiết lập vào session để view có thể dùng
    $_SESSION['total_page'] = $total_page;
    $_SESSION['prev_page'] = ($current_page > 1) ? ($current_page - 1) : 1;
    $_SESSION['next_page'] = ($current_page < $total_page) ? ($current_page + 1) : $total_page;
    return pdo_query($sql);
}
// hung code
function slide_get_one_by_ma_hh($params = [])
{
    $sql = "SELECT * FROM tb_slide WHERE ma_hh=:ma_hh";
    //ghép nối các tham số vào câu lệnh sql
    foreach ($params as $field_name => $value)
    $sql .= " AND {$field_name} = :{$field_name} ";
    //vd: $sql.= "AND username=:username " ;
    return pdo_query_one($sql, $params); //trả về ID khi thêm mới
}
function slide_get_one_hung($params = [])
{
    $sql = "SELECT * FROM tb_slide WHERE ma_hh=:ma_hh";
    //ghép nối các tham số vào câu lệnh sql
    foreach ($params as $field_name => $value)
        $sql .= " AND {$field_name} = :{$field_name} ";
    //vd: $sql.= "AND username=:username " ;
    return pdo_query_one($sql, $params); //trả về ID khi thêm mới
}
?>