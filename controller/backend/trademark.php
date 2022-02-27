<?php
require_once APP_PATH . '/model/trademark_model.php';
require_once APP_PATH . '/library/functions.php';
switch ($action) {
    case 'add':
        extract(add_trademark());
        break;
    case 'edit':
        extract(edit_trademark());
        break;
    case 'delete':
        extract(delete_trademark());
        break;
    default:
    if(isset($_POST['btn-delete-multi'])){
        extract(delete_multi());
    }
        extract(Index());
        break;
}

function add_trademark()
{
    $err=['ten_th'=>''];
    if (isset($_POST['btnSave'])) {
        extract($_POST); //bung mảng post thành các biến tự do
        $validate_ten_th = '/^[a-zA-Z0-9_ ]{3,50}$/';
        if (!preg_match($validate_ten_th, $ten_th)) {
            $err['ten_th'] = "<small class='text-danger'>*Tên thương hiệu phải đúng định dạng và tối thiểu 5 ký tự !</small>";
        }
        //nếu k có lỗi thì ghi csdl
        if (!array_filter($err)){
            //tạo mảng tham số để lưu csdl, key của mảng là tên cột trong csdl
            $dataInsert = [
                'ma_th'=>$ma_th,
                'ten_th' => $ten_th,
            ];
            $last_id = trademark_add($dataInsert);
            $msg = "THÊM MỚI THÀNH CÔNG, MÃ THƯƠNG HIỆU :" . $last_id;
        }
        // else {
        //     $err;
        // }
    }
    return [
        'view_name' => 'trademark/add.php',
        'new_id' => @$last_id,
        'err'=>$err,
        'msg' => @$msg
    ];
}
function edit_trademark()
{
    if (empty($_GET['id'])) {
        header("location:" . BASE_URL . "/?module=backend&controller=index&action=404&error=Không tồn tại mã hàng hóa cần sửa");
    }
    if (empty(trademark_get_one(['ma_th' => $_GET['id']]))) {
        header("location:" . BASE_URL . "/?module=backend&controller=index&action=404&error=Mã thương hiệu không tồn tại!");
    }
    $err=['ten_th'=>''];
    if (isset($_POST['btnSave'])) {
        extract($_POST); 
        $validate_ten_th = '/^[a-zA-Z0-9_ ]{3,50}$/';
        if (!preg_match($validate_ten_th, $ten_th)) {
            $err['ten_th'] = "<small class='text-danger'>*Tên thương hiệu phải đúng định dạng và tối thiểu 5 ký tự !</small>";
        }
        //nếu k có lỗi thì ghi csdl
        if (!array_filter($err)) {
            //tạo mảng tham số để lưu csdl, key của mảng là tên cột trong csdl
            $dataUpdate = [
                'ma_th'=>$ma_th,
                'ten_th' => $ten_th,
            ];
            trademark_edit($dataUpdate);
            $msg = "Cập nhật thành công!";
        } 
    }
    return [
        'view_name' => 'trademark/edit.php',
        'new_id' => @$last_id,
        'err'=>$err,
        'msg' => @$msg
    ];
}
function delete_trademark()
{
    categories_delete(['ma_th'=>$_GET['id']]);
    $msg = "Xóa thành công";
    $list_trademark = trademark_list_all();
    return [
        'view_name' => 'trademark/list.php',
        'list_trademark' => $list_trademark,   
        'msg' => @$msg
    ];
}
function delete_multi(){
    $mang_id = $_POST['ma_th'];
    $kqxoa = trademark_delete_multi(  implode(',',$mang_id)   );
    return[
        'kq'=>$kqxoa,
    ];
}

function Index()
{
    $list_trademark = trademark_select_page();
    return [
        'view_name' => 'trademark/list.php',
        'list_user' => $list_trademark   
    ];
}
