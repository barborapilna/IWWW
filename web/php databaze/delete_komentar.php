<?php
$id_komentare=$_GET['id_komentare'];
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
);

$conn = new PDO("mysql:host=localhost;dbname=" . DB_NAME, DB_USER, DB_PASSWORD, $options);
$stmt = $conn->prepare("DELETE FROM komentar WHERE id_komentare= :id_komentare");
$stmt->bindParam(':id_komentare', $id_komentare);
$stmt->execute();

include "./home.php";
?>