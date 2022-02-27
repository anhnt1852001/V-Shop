<?php
define("BASE_URL", '/v-shop');
$conn = new mysqli("localhost", "root", "", "v-shop");

if (isset($_POST['query'])) {
    $inputText = $_POST['query'];
    $query = "SELECT * FROM tb_hang_hoa WHERE ten_hh LIKE '%$inputText%' ORDER BY so_luot_xem LIMIT 5";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
            <li class="list-group-item">
                <a href="' . BASE_URL . '?controller=product&action=detail&id=' . $row['ma_hh'] . '">
                    <div class="d-flex justify-content-start align-items-center">
                        <div>
                            <img width="50" height="50" src="' . BASE_URL . '/public/content/images/product/' . $row['hinh'] . '" alt="">
                        </div>
                        <div>
                            <p>' . $row['ten_hh'] . '</p>
                            <p class="text-danger mt-2">' . number_format($row['don_gia']) . ' VND </p>
                        </div>
                    </div>
                </a>
            </li>';
        }
    } else {
        echo '<li class="list-group-item">no suggest</li>';
    }
}
