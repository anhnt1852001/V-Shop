<?php
require_once APP_PATH . '/model/slide_model.php';
require_once APP_PATH . '/model/product_model.php';
require_once APP_PATH . '/library/functions.php';
switch ($action) {
    case 'add':
        extract(add_slide());
        break;
    case 'edit':
        extract(edit_slide());
        break;
    case 'delete':
        extract(delete_slide());
        break;
    default:
        if (isset($_POST['btn-delete-multi'])) {
            extract(delete_multi());
        }
        extract(Index());
        break;
}

function add_slide()
{
    $err = ['ten_slide1' => '', 'ten_slide2' => '', 'ten_slide3' => '', 'ten_slide4' => '', 'ten_slide5' => ''];
    if (isset($_POST['btnSave'])) {
        extract($_POST); //bung mảng post thành các biến tự do
        $type_img = ['image/png', 'image/jpeg', 'image/bmp'];
        $name_img1 = $_FILES['ten_slide1']['type'];
        $name_img2 = $_FILES['ten_slide2']['type'];
        $name_img3 = $_FILES['ten_slide3']['type'];
        $name_img4 = $_FILES['ten_slide4']['type'];
        $name_img5 = $_FILES['ten_slide5']['type'];
        // //validate file ảnh tải lên
        if ($_FILES['ten_slide1']['size'] > 0 && $_FILES['ten_slide1']['size'] < 2000000) {
            if (in_array($name_img1, $type_img) === false) {
                $err['ten_slide1'] = "<small class='text-danger'>*Chỉ được up hình có định dạng là JPG PNG và BMP!</small>";
            } else {
                $ten_slide1 = $_FILES['ten_slide1']['size'];
            }
        } else {
            $err['ten_slide1'] = "<small class='text-danger'>*Không để trống và < 2MB</small>";
        }
        //validate file ảnh tải lên
        if ($_FILES['ten_slide2']['size'] > 0 && $_FILES['ten_slide2']['size'] < 2000000) {
            if (in_array($name_img2, $type_img) === false) {
                $err['ten_slide2'] = "<small class='text-danger'>*Chỉ được up hình có định dạng là JPG PNG và BMP!</small>";
            } else {
                $ten_slide2 = $_FILES['ten_slide2']['size'];
            }
        } else {
            $err['ten_slide2'] = "<small class='text-danger'>*Không để trống và < 2MB</small>";
        }
        //validate file ảnh tải lên
        if ($_FILES['ten_slide3']['size'] > 0 && $_FILES['ten_slide3']['size'] < 2000000) {
            if (in_array($name_img3, $type_img) === false) {
                $err['ten_slide3'] = "<small class='text-danger'>*Chỉ được up hình có định dạng là JPG PNG và BMP!</small>";
            } else {
                $ten_slide3 = $_FILES['ten_slide1']['size'];
            }
        } else {
            $err['ten_slide3'] = "<small class='text-danger'>*Không để trống và < 2MB</small>";
        }
        //validate file ảnh tải lên
        if ($_FILES['ten_slide4']['size'] > 0 && $_FILES['ten_slide4']['size'] < 2000000) {
            if (in_array($name_img4, $type_img) === false) {
                $err['ten_slide4'] = "<small class='text-danger'>*Chỉ được up hình có định dạng là JPG PNG và BMP!</small>";
            } else {
                $ten_slide4 = $_FILES['ten_slide4']['size'];
            }
        } else {
            $err['ten_slide4'] = "<small class='text-danger'>*Không để trống và < 2MB</small>";
        }
        //validate file ảnh tải lên
        if ($_FILES['ten_slide5']['size'] > 0 && $_FILES['ten_slide5']['size'] < 2000000) {
            if (in_array($name_img5, $type_img) === false) {
                $err['ten_slide5'] = "<small class='text-danger'>*Chỉ được up hình có định dạng là JPG PNG và BMP!</small>";
            } else {
                $ten_slide5 = $_FILES['ten_slide5']['size'];
            }
        } else {
            $err['ten_slide5'] = "<small class='text-danger'>*Không để trống và < 2MB</small>";
        }
        //nếu k có lỗi thì ghi csdl
        if (!array_filter($err)) {
            $up_ten_slide1 = save_file("ten_slide1", IMAGE_DIR . "/slides/");
            $ten_slide1 = strlen($up_ten_slide1) > 0 ? $up_ten_slide1 : 'slides.png';
            $up_ten_slide2 = save_file("ten_slide2", IMAGE_DIR . "/slides/");
            $ten_slide2 = strlen($up_ten_slide2) > 0 ? $up_ten_slide2 : 'slides.png';
            $up_ten_slide3 = save_file("ten_slide3", IMAGE_DIR . "/slides/");
            $ten_slide3 = strlen($up_ten_slide3) > 0 ? $up_ten_slide3 : 'slides.png';
            $up_ten_slide4 = save_file("ten_slide4", IMAGE_DIR . "/slides/");
            $ten_slide4 = strlen($up_ten_slide4) > 0 ? $up_ten_slide4 : 'slides.png';
            $up_ten_slide5 = save_file("ten_slide5", IMAGE_DIR . "/slides/");
            $ten_slide5 = strlen($up_ten_slide5) > 0 ? $up_ten_slide5 : 'slides.png';
            //tạo mảng tham số để lưu csdl, key của mảng là tên cột trong csdl
            $dataInsert = [
                'ma_slide' => $ma_slide,
                'ten_slide1' => $ten_slide1,
                'ten_slide2' => $ten_slide2,
                'ten_slide3' => $ten_slide3,
                'ten_slide4' => $ten_slide4,
                'ten_slide5' => $ten_slide5,
                'ma_hh' => $ma_hh
            ];
            $last_id = slide_add($dataInsert);
            $msg = "THÊM MỚI THÀNH CÔNG, MÃ SLIDE :" . $last_id;
        }
    }

    return [
        'view_name' => 'slide/add.php',
        'new_id' => @$last_id,
        'err' => $err,
        'msg' => @$msg,
    ];
}
function edit_slide()
{
    if (empty($_GET['id'])) {
        header("location:" . BASE_URL . "/?module=backend&controller=index&action=404&error=Không tồn tại mã hàng hóa cần sửa");
    }
    if (empty(slide_get_one(['ma_slide' => $_GET['id']]))) {
        header("location:" . BASE_URL . "/?module=backend&controller=index&action=404&error=Mã slide này không tồn tại!");
    }
    $err = [];
    if (isset($_POST['btnSave'])) {
        extract($_POST);
        $type_img = ['image/png', 'image/jpeg', 'image/bmp'];
        $name_img1 = $_FILES['up_ten_slide1']['type'];
        $name_img2 = $_FILES['up_ten_slide2']['type'];
        $name_img3 = $_FILES['up_ten_slide3']['type'];
        $name_img4 = $_FILES['up_ten_slide4']['type'];
        $name_img5 = $_FILES['up_ten_slide5']['type'];
        //validate file ảnh slide1
        if (isset($up_ten_slide1)) {
            if ($_FILES['up_ten_slide1']['size'] > 0 && $_FILES['up_ten_slide1']['size'] < 1500000) {
                if (in_array($name_img1, $type_img) === false) {
                    $err['ten_slide1'] = "<small class='text-danger'>*Chỉ được up hình có định dạng là JPG PNG và BMP!</small>";
                } else {
                    $ten_slide1 = $_FILES['up_ten_slide1']['size'];
                }
            } else {
                $err['ten_slide1'] = "<small class='text-danger'>*Không để trống và < 2MB</small>";
            }
        }
        //validate file ảnh slide2
        if (isset($up_ten_slide2)) {
            if ($_FILES['up_ten_slide2']['size'] > 0 && $_FILES['up_ten_slide2']['size'] < 1500000) {
                if (in_array($name_img2, $type_img) === false) {
                    $err['ten_slide2'] = "<small class='text-danger'>*Chỉ được up hình có định dạng là JPG PNG và BMP!</small>";
                } else {
                    $ten_slide2 = $_FILES['up_ten_slide2']['size'];
                }
            } else {
                $err['ten_slide2'] = "<small class='text-danger'>*Không để trống và < 2MB</small>";
            }
        }
        //validate file ảnh slide3
        if (isset($up_ten_slide3)) {
            if ($_FILES['up_ten_slide3']['size'] > 0 && $_FILES['up_ten_slide3']['size'] < 1500000) {
                if (in_array($name_img3, $type_img) === false) {
                    $err['ten_slide3'] = "<small class='text-danger'>*Chỉ được up hình có định dạng là JPG PNG và BMP!</small>";
                } else {
                    $ten_slide3 = $_FILES['up_ten_slide3']['size'];
                }
            } else {
                $err['ten_slide3'] = "<small class='text-danger'>*Không để trống và < 2MB</small>";
            }
        }
        //validate file ảnh slide4
        if (isset($up_ten_slide4)) {
            if ($_FILES['up_ten_slide4']['size'] > 0 && $_FILES['up_ten_slide4']['size'] < 1500000) {
                if (in_array($name_img4, $type_img) === false) {
                    $err['ten_slide4'] = "<small class='text-danger'>*Chỉ được up hình có định dạng là JPG PNG và BMP!</small>";
                } else {
                    $ten_slide4 = $_FILES['up_ten_slide4']['size'];
                }
            } else {
                $err['ten_slide4'] = "<small class='text-danger'>*Không để trống và < 2MB</small>";
            }
        }
        //validate file ảnh slide5
        if (isset($up_ten_slide5)) {
            if ($_FILES['up_ten_slide5']['size'] > 0 && $_FILES['up_ten_slide5']['size'] < 1500000) {
                if (in_array($name_img5, $type_img) === false) {
                    $err['ten_slide5'] = "<small class='text-danger'>*Chỉ được up hình có định dạng là JPG PNG và BMP!</small>";
                } else {
                    $ten_slide5 = $_FILES['up_ten_slide5']['size'];
                }
            } else {
                $err['ten_slide5'] = "<small class='text-danger'>*Không để trống và < 2MB</small>";
            }
        }
        //nếu k có lỗi thì ghi csdl
        if (!array_filter($err)) {
            // slide 1
            $up_ten_slide1 = save_file("up_ten_slide1", IMAGE_DIR . "/slides/");
            $ten_slide1 = strlen($up_ten_slide1) > 0 ? $up_ten_slide1 : $ten_slide1;
            // slide 2
            $up_ten_slide2 = save_file("up_ten_slide2", IMAGE_DIR . "/slides/");
            $ten_slide2 = strlen($up_ten_slide2) > 0 ? $up_ten_slide2 : $ten_slide2;
            // slide 3
            $up_ten_slide3 = save_file("up_ten_slide3", IMAGE_DIR . "/slides/");
            $ten_slide3 = strlen($up_ten_slide3) > 0 ? $up_ten_slide3 : $ten_slide3;
            // slide 4
            $up_ten_slide4 = save_file("up_ten_slide4", IMAGE_DIR . "/slides/");
            $ten_slide4 = strlen($up_ten_slide4) > 0 ? $up_ten_slide4 : $ten_slide4;
            // slide 5
            $up_ten_slide5 = save_file("up_ten_slide5", IMAGE_DIR . "/slides/");
            $ten_slide5 = strlen($up_ten_slide5) > 0 ? $up_ten_slide5 : $ten_slide5;

            //tạo mảng tham số để lưu csdl, key của mảng là tên cột trong csdl
            $dataUpdate = [
                'ma_slide' => $ma_slide,
                'ten_slide1' => $ten_slide1,
                'ten_slide2' => $ten_slide2,
                'ten_slide3' => $ten_slide3,
                'ten_slide4' => $ten_slide4,
                'ten_slide5' => $ten_slide5,
                'ma_hh' => $ma_hh
            ];
            slide_edit($dataUpdate);
            $msg = "Cập nhật thành công!";
        }
    }
    return [
        'view_name' => 'slide/edit.php',
        'new_id' => @$last_id,
        'err' => $err,
        'msg' => @$msg
    ];
}
function delete_slide()
{
    slide_delete(['ma_slide' => $_GET['id']]);
    $msg = "Xóa thành công";
    $list_slide = slide_list_all();
    $list_product=product_list_all();
    return [
        'view_name' => 'slide/list.php',
        'list_slide' => $list_slide,
        'list_product' => $list_product,
        'msg' => @$msg
    ];
}
function delete_multi()
{
    $mang_id = $_POST['ma_slide'];
    $kqxoa = slide_delete_multi(implode(',', $mang_id));
    return [
        'kq' => $kqxoa,
    ];
}

function Index()
{
    $list_product=product_list_all();
    $list_slide = slide_select_page();
    return [
        'view_name' => 'slide/list.php',
        'list_slide' => $list_slide,
        'list_product' => $list_product
    ];
}
