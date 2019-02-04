<?php
$id_hodnoceni=$_GET['id_hodnoceni'];
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
);

$conn = new PDO("mysql:host=localhost;dbname=" . DB_NAME, DB_USER, DB_PASSWORD, $options);
$stmt = $conn->prepare("DELETE FROM hodnoceni_clanku WHERE id_hodnoceni= :id_hodnoceni");
$stmt->bindParam(':id_hodnoceni', $id_hodnoceni);
$stmt->execute();

include "./home.php";
?>