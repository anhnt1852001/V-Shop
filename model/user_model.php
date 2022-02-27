<?php
require_once APP_PATH . '/library/functions.php';
//hàm thêm user
function user_add($params=[]){
    //cải tiến câu lệnh sql cho phù hợp với truy vấn , nếu cột nào trống
    $sql="INSERT INTO tb_khach_hang(ma_kh,ho_ten,mat_khau,kich_hoat,hinh,email,so_dt,vai_tro) VALUES (:ma_kh,:ho_ten,:mat_khau,:kich_hoat,:hinh,:email,:so_dt,:vai_tro)";
    return pdo_execute($sql,$params); //trả về id khi thêm mới
}
//hàm sửa user
function user_edit($params=[]){
    //cải tiến câu lệnh sql cho phù hợp với truy vấn 
    //ghép nối các tham số vào câu lệnh sql
    $strSet=array_map ( function($field_name){
        return " {$field_name} = :{$field_name}  ";
    }, array_keys($params) );
    $strSet = implode(",", $strSet);
    if(empty($strSet)){
        //không có cột nào chỉnh sửa
        die("Cần truyền dữ liệu cho mảng params trước khi gọi hàm user update");
    }
    $sql="UPDATE tb_khach_hang SET $strSet WHERE ma_kh=:ma_kh";
    return pdo_execute($sql,$params); //params chỉ cho vào dư liệu các cột cần set
}
// hàm xóa user
function user_delete($params=[]){
    // $id=$_GET['id'];
    $sql="DELETE FROM tb_khach_hang WHERE ma_kh=:ma_kh";
    return pdo_execute($sql,$params);
}
function user_delete_multi($str_ma_kh){
    //str_ma_kh 4,6,7,89,
    $sql="DELETE FROM tb_khach_hang WHERE ma_kh IN ($str_ma_kh)";

    return pdo_execute($sql,[]);
}
//  function user_list_all(){
//      $sql="SELECT * FROM tb_khach_hang ORDER BY ma_kh ASC";
//      return pdo_query($sql);
//  }
 // phân trang
 function user_list_all(){
    $row_per_page = 6; // số bản ghi trên 1 trang
    $current_page = exist_param("page_no") ? $_REQUEST['page_no'] : 1;
    $total_row = pdo_query_value("SELECT count(*) FROM tb_khach_hang"); //đếm tổng số bản ghi
    $total_page = ceil($total_row / $row_per_page); //tính ra số lượng trang
    if ($current_page < 1)
        $current_page = 1;
    if ($current_page > $total_page)
        $current_page = $total_page;
    $start = ($current_page - 1) * $row_per_page;
    $sql = "SELECT * FROM tb_khach_hang LIMIT {$start}, {$row_per_page}";
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
function user_get_one($params=[]){
    $sql="SELECT * FROM tb_khach_hang WHERE ma_kh=:ma_kh ";
    //ghép nối các tham số vào câu lệnh sql
    foreach($params as $field_name=>$value)
    $sql.= " AND {$field_name} = :{$field_name} ";
    //vd: $sql.= "AND username=:username " ;
    return pdo_query_one($sql, $params); //trả về ID khi thêm mới
}
/**
 * Tạo cookie
 * @param string $name là tên cookie
 * @param string $value là giá trị cookie
 * @param int $day là số ngày tồn tại cookie
 */
function add_cookie($name, $value, $day){
    setcookie($name, $value, time() + (86400 * $day), "/");
}
/**
 * Xóa cookie
 * @param string $name là tên cookie
 */
function delete_cookie($name){
    add_cookie($name, '', -1);
}
/**
 * Đọc giá trị cookie
 * @param string $name là tên cookie
 * @return string giá trị của cookie
 */
function get_cookie($name){
    return $_COOKIE[$name]??'';
}
function count_user()
{
    $sql = "SELECT COUNT(ma_kh) FROM tb_khach_hang";
    return pdo_query_value($sql);
}
function recent_user()
{
    $sql = "SELECT * FROM tb_khach_hang  ORDER BY ma_kh DESC LIMIT 0, 8";
    return pdo_query($sql);
}
// check sự tồn tại mã khách hàng
function khach_hang_exist($ma_kh){
    $sql = "SELECT count(*) FROM tb_khach_hang WHERE ma_kh='$ma_kh'";
    return pdo_query_value($sql, $ma_kh) > 0;
}
function user_get_one_by_email($params=[]){
    $sql="SELECT * FROM tb_khach_hang WHERE email=:email ";
    //ghép nối các tham số vào câu lệnh sql
    foreach($params as $field_name=>$value)
    $sql.= " AND {$field_name} = :{$field_name} ";
    //vd: $sql.= "AND username=:username " ;
    return pdo_query_one($sql, $params); //trả về ID khi thêm mới
}
?>
