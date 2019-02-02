<?php
$id_kategorie=$_GET['id_kategorie'];
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
);

$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD, $options);
$stmt = $conn->prepare("DELETE FROM kategorie WHERE id_kategorie= :id_kategorie");
$stmt->bindParam(':id_kategorie', $id_kategorie);
$stmt->execute();

include "./home.php";
?>