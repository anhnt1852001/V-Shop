<?php
session_start(); //khởi động session
date_default_timezone_set("Asia/Ho_Chi_Minh"); //thiết lập múi giờ
define("APP_PATH", __DIR__); //định nghĩa hằng lưu trữ đường dẫn  tới thư mục gốc của website
define("BASE_URL", '/v-shop'); // định nghĩa  hằng lưu trữ đường dẫn  thư mục website dùng cho url
define("IMAGE_DIR", APP_PATH . '/public/content/images/'); //Định nghĩa đường dẫn chứa ảnh sử dụng trong upload

require_once APP_PATH . '/library/functions.php';
require_once APP_PATH . '/library/pdo.php';
require_once APP_PATH . '/library/testpdo.php';
//lấy tham số
$module = isset($_GET['module']) ? $_GET['module'] : 'frontend';
//nếu là trang chủ thì mặc định là module front end
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'index';
//lấy tham số controller
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
// CheckAll($module, $controller, $action); //check login
if ($module == "backend") {
    CheckACL_V2($module, $controller, $action);
}
//lấy tham số action
//mặc định controller và action nếu khống truyền vào ta đặt là index
//thiết lập đường dân tới file controller để nhúng vào index
$file_controller = APP_PATH . '/controller/' . $module . '/' . $controller . '.php';
// echo $file_controller
// echo $action
//thiết lập đường dẫn file layout
$file_layout = APP_PATH . '/view/' . $module . '/layout.php';
//echo $file_layout
if (file_exists($file_controller)) {
    //nếu tồn tại file_controller trong thư mục thì nhúng vào 
    require_once $file_controller; ///nhúng file controller
    if (file_exists($file_layout)) {
        require_once $file_layout;
        //nhúng file layout
    } else {
        die("Bạn chưa có file layout: $file_layout");
    }
} else {
    die("Bạn chưa có file controller: $file_controller");
}
