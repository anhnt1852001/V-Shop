<?php
try {
	$conn = new PDO("mysql:host=localhost;dbname=v-shop;charset=utf8", "root", "");
} catch (PDOException $e) {
	echo "LỖI";
}
