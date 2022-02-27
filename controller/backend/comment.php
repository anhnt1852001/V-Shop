<?php
require_once APP_PATH . '/model/comment_model.php';
require_once APP_PATH . '/model/thong_ke_model.php';
require_once APP_PATH . '/library/functions.php';
switch ($action) {
    case 'detail':
        if(isset($_POST['btn-delete-multi'])){
            extract(delete_multi());
        }
        extract(detail_comment());
    break;
    case 'delete':
        extract(delete_comment());
        break;
    default:

        extract(Index());
        break;
}


function detail_comment(){
    $detail_comment=comment_select_by_product(['ma_hh'=>$_GET['id']]);
    // $detail_all=comment_list_all();
    return[
        'view_name'=>'comment/detail.php',
        'detail_comment'=>$detail_comment,
        // 'detail_all'=>$detail_all
    ];
}
function delete_comment()
{
    comment_delete(['ma_bl'=>$_GET['id']]);
    $msg = "Xóa thành công";
    $list_comment = thong_ke_binh_luan();
    return [
        'view_name' => 'comment/list.php',
        'list_comment' => $list_comment,   
        'msg' => @$msg
    ];
}
function delete_multi(){
    $mang_id = $_POST['ma_bl'];
    $kqxoa = comment_delete_multi(implode(',', $mang_id));
    return[
        'kq'=>$kqxoa,
    ];
}

function Index()
{
    $list_comment = comment_select_page();
    return [
        'view_name' => 'comment/list.php',
        'list_comment' => $list_comment    
    ];
}
