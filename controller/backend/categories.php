<?php
require_once APP_PATH . '/model/categories_model.php';
require_once APP_PATH . '/library/functions.php';
switch ($action) {
    case 'add':
        extract(add_categories());
        break;
    case 'edit':
        extract(edit_categories());
        break;
    case 'delete':
        extract(delete_categories());
        break;
    default:
    if(isset($_POST['btn-delete-multi'])){
        extract(delete_multi());
    }
        extract(Index());
        break;
}

function add_categories()
{
    $err=['ten_mh'=>''];
    if (isset($_POST['btnSave'])) {
        extract($_POST); //bung mảng post thành các biến tự do
        if(strlen($ten_mh) < 5){
            $err['ten_mh']="<small class='text-danger'>*Tên Loại không được < 5 ký tự!</small>";
        }
        //nếu k có lỗi thì ghi csdl
        if (!array_filter($err)){
            //tạo mảng tham số để lưu csdl, key của mảng là tên cột trong csdl
            $dataInsert = [
                'ma_mh'=>$ma_mh,
                'ten_mh' => $ten_mh,
            ];
            $last_id = categories_add($dataInsert);
            $msg = "THÊM MỚI THÀNH CÔNG, MÃ MẶT HÀNG :" . $last_id;
        }
        // else {
        //     $err;
        // }
    }
    return [
        'view_name' => 'categories/add.php',
        'new_id' => @$last_id,
        'err'=>$err,
        'msg' => @$msg
    ];
}
function edit_categories()
{
    if (empty($_GET['id'])) {
        header("location:" . BASE_URL . "/?module=backend&controller=index&action=404&error=Không tồn tại mã hàng hóa cần sửa");
    }
    if (empty(categories_get_one(['ma_mh' => $_GET['id']]))) {
        header("location:" . BASE_URL . "/?module=backend&controller=index&action=404&error=Mã mặt hàng không tồn tại!");
    }
    $err=['ten_mh'=>''];
    if (isset($_POST['btnSave'])) {
        extract($_POST); 
        if(strlen($ten_mh) < 5){
            $err['ten_mh']="<small class='text-danger'>*Tên Loại không được < 5 ký tự!</small>";
        }
        //nếu k có lỗi thì ghi csdl
        if (!array_filter($err)) {
            //tạo mảng tham số để lưu csdl, key của mảng là tên cột trong csdl
            $dataUpdate = [
                'ma_mh'=>$ma_mh,
                'ten_mh' => $ten_mh,
            ];
            categories_edit($dataUpdate);
            $msg = "Cập nhật thành công!";
        } 
    }
    return [
        'view_name' => 'categories/edit.php',
        'new_id' => @$last_id,
        'err'=>$err,
        'msg' => @$msg
    ];
}
function delete_categories()
{
    categories_delete(['ma_mh'=>$_GET['id']]);
    $msg = "Xóa thành công";
    $list_categories = categories_list_all();
    return [
        'view_name' => 'categories/list.php',
        'list_categories' => $list_categories,   
        'msg' => @$msg
    ];
}
function delete_multi(){
    $mang_id = $_POST['ma_mh'];
    $kqxoa = categories_delete_multi(  implode(',',$mang_id)   );
    return[
        'kq'=>$kqxoa,
    ];
}

function Index()
{
    $list_categories = categories_select_page();
    return [
        'view_name' => 'categories/list.php',
        'list_categories' => $list_categories    
    ];
}
