<?php
define("BASE_URL", '/v-shop'); 
function pdo_get_connection()
{
    $host = "localhost";
    $db_name = "v-shop";
    $db_user = "root";
    $db_pass = '';
    $dburl = "mysql:host={$host};dbname={$db_name};charset=utf8";
    $pdo = new PDO($dburl, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}
if (isset($_POST['action'])) {
    if (!empty($_GET['ten_mh'])) {
        $ten_mat_hang = $_GET['ten_mh'];
        $sql = "SELECT * 
        FROM tb_hang_hoa 
        JOIN tb_thuong_hieu ON tb_hang_hoa.ma_th = tb_thuong_hieu.ma_th 
        JOIN tb_mat_hang ON tb_hang_hoa.ma_mh = tb_mat_hang.ma_mh 
        WHERE tb_hang_hoa.status = 1 AND tb_mat_hang.ten_mh='$ten_mat_hang'";
    } else {
        $search = isset($_GET['search']) ? $_GET['search'] : "h";
        $sql = "SELECT * 
        FROM tb_hang_hoa 
        JOIN tb_thuong_hieu ON tb_hang_hoa.ma_th = tb_thuong_hieu.ma_th 
        JOIN tb_mat_hang ON tb_hang_hoa.ma_mh = tb_mat_hang.ma_mh 
        WHERE tb_hang_hoa.status = 1 AND tb_hang_hoa.ten_hh LIKE '%$search%'";
    }

    if (isset($_POST['minimum_price'])) {
        $sql .= " AND tb_hang_hoa.don_gia BETWEEN " . $_POST['minimum_price'] . " AND " . $_POST['maximum_price'];
    }

    if (isset($_POST['brand'])) {
        $brand_filter = implode("','", $_POST['brand']);
        $sql .= " AND tb_thuong_hieu.ten_th IN('" . $brand_filter . "')";
    }
    if (isset($_POST['ram'])) {
        $ram_filter = implode("','", $_POST['ram']);
        $sql .= " AND tb_hang_hoa.ram IN('" . $ram_filter . "')";
    }
    if (isset($_POST['storage'])) {
        $storage_filter = implode("','", $_POST['storage']);
        $sql .= " AND tb_hang_hoa.storage IN('" . $storage_filter . "')";
    }
    // print_r($sql);
    $conn = pdo_get_connection(); //gọi kết nối csdl
    $stmt = $conn->prepare($sql); // chuẩn bị câu lệnh sql
    $stmt->execute(); //thực thi câu lệnh với tham số truyền vào
    $result = $stmt->fetchAll();
    $count = $stmt->rowCount();
    $output = '';
    if ($count > 0) {
        foreach ($result as $key => $value) {
            if ($value['giam_gia'] == 0) {
                $class_name = 'd-none';
            } else {
                $class_name = '';
            }
            $output .= '
                    <div class="col-4 px-1 home__card mt-2">
                            <div class="card">
                                <a href="'.BASE_URL.'/?controller=product&action=detail&id=' . $value['ma_hh'] . '">
                                    <img src="'.BASE_URL.'/public/content/images/product/' . $value['hinh'] . '" class="card-img-top" alt="products">
                                </a>
                                <div class="card-body home__card--body">
                                    <h2 class="card-title home__card--title">
                                        <span>
                                            <a href="'.BASE_URL.'/?controller=product&action=detail&id=' . $value['ma_hh'] . '">
                                                ' . $value['ten_hh'] . '
                                            </a>
                                        </span>
                                    </h2>
                                    <div class="home__card--price">
                                        <div class="home__card--percent ' . $class_name . '">
                                            <span>
                                                ' . $value['giam_gia'] . '
                                            </span>
                                        </div>
                                        <p class="card-text">
                                            <span class="home__price--static">
                                                ' . number_format($value['don_gia']) . '
                                            </span>
                                            <span class="home__price--sub ' . $class_name . '">
                                                ' . number_format($value['don_gia'] - ($value['don_gia'] * $value['giam_gia'] / 100)) . '
                                            </span>
                                        </p>
                                        
                                    </div>
                                    <div class="home__specifications">      
                                        <span class="home__specifications--ram">
                                            RAM : ' . $value['ram'] . 'GB
                                        </span>
                                        <span class="home__specifications--storage">
                                            Bộ nhớ trong : ' . $value['ram'] . 'GB
                                        </span>
                                    </div>
                                    <div class="home__card--star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                    </div>
                  ';
        }
    } else {
        $output = '
        <div class="products__filter--orror">
            <p>Không tìm thấy sản phẩm</p>
        </div>';
    }
    echo $output;
}
