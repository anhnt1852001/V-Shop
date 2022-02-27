<?php
 function StopWebsite(){
     die("STOP");
 }
function CheckAll($module,$controller,$action){
    $arr_public = [
        'frontend' => [//module
            'index'=>['index','lien-he1'], //controller => action
            'user'=>['login','logout','register','forgot']
        ]
        ];
    //kiểm tra module
    if(!in_array($module,array_keys($arr_public))){
        //module này không có danh sách tên module public ==> yeu cầu đăng nhập
        if(empty(isset($_SESSION['ma_kh']))){
            //chưa đăng nhập
            header("Location:" .BASE_URL .'/?controller=user&action=login');
            exit(); 
        }else{
            //kiểm tra controller
            //ở đây đã đăng nhập rồi thì thôi không cần kiểm tra controller nữa

        }
    }else{
        //module truy cập đang là public
        //kiểm tra controller ở trong module hiện tại
        if(!in_array($controller, array_keys($arr_public[$module]))){
            //trong module public , nhưng controller không được liệt kê là public => yêu cầu đăng nhập
            if(empty(isset($_SESSION['ma_kh']))){
            //chưa đăng nhập
            header("Location: ". BASE_URL .'/?controller=user&action=login');
            exit();
            }
        }else{
            // controller là public , kiểm tra action
            if(!in_array($action,$arr_public[$module][$controller])){
                //action là private thì yêu cầu đăng nhập
                if(empty(isset($_SESSION['ma_kh']))){
                    //chưa đăng nhập
                    header("Location: " .BASE_URL .'/?controller=user&action=login');
                    exit();
                }
            }
        }
    }
}
     /**
      *  kiểm tra phân quyền mức 2, chặn quyền theo module
      */
      function CheckACL_V2($module, $controller, $action)
      {
          //định nghĩa mảng các chức năng cho phép public không yêu cầu đăng nhập
          $arr_public = [
              'frontend.index.index',
              'frontend.index.lien-he',
              'frontend.user.login'
              //cấu trúc:  module.controller.action cách  nhau bằng dấu chấm
          ];
          //lấy thông tin đường dân hiện tại đàn truy cập
          $current_path = "$module.$controller.$action";
          if (in_array($current_path, $arr_public)) {
              return true;
              // nếu là public thì không kiểm tra return true luôn
          }
          //kiểm tra đăng nhập hay chưa
          if (empty(isset($_SESSION['ma_kh']))) {
              //chưa đăng nhập
              header("Location:" . BASE_URL . '/?controller=user&action=login');
              exit();
          }
          //chặn quyền theo module
          $user_info = $_SESSION['ma_kh'];
          // chú ý: trong bảng user bạn thêm cột vai trò giá trị 0 hoặc 1, 1 là quản trị
          if ($module == 'backend') {
              if (!isset($user_info['vai_tro']) || $user_info['vai_tro'] != 1) {
                  die("Bạn không có quyền truy cập chức năng này");
              }
              //else : không làm gì cả thì sễ truy cập như thường
          } else {
              //không làm gì cả thì cho truy cập vào thôi
          }
      }
/**
 * Lưu file upload vào thư mục
 * @param string $fieldname là tên trường file
 * @param string $target_dir thư mục lưu file
 * @return tên file upload
 */
function save_file($fieldname, $target_dir){
    $file_uploaded = $_FILES[$fieldname];
    $file_name = basename($file_uploaded["name"]);
    $target_path = $target_dir . $file_name;
    move_uploaded_file($file_uploaded["tmp_name"], $target_path);
    return $file_name;
}
/**
 * Kiểm tra sự tồn tại của một tham số trong request
 * @param string $fieldname là tên tham số cần kiểm tra
 * @return boolean true tồn tại
 */
function exist_param($fieldname){
    return array_key_exists($fieldname, $_REQUEST);
}
?>