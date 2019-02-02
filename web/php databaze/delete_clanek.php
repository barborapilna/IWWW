<?php
$id_clanku = $_GET['id_clanku'];
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
);

$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD, $options);
$stmt = $conn->prepare("DELETE FROM clanek WHERE id_clanku= :id_clanku");
$stmt->bindParam(':id_clanku', $id_clanku);
$stmt->execute();

include "./home.php";
?>