<?php
$id_uzivatele = $_GET['id_uzivatele'];
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
);

$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD, $options);
$stmt = $conn->prepare("DELETE FROM ucet_uzivatele WHERE id_uzivatele= :id_uzivatele");
$stmt->bindParam(':id_uzivatele', $id_uzivatele);
$stmt->execute();

if ($_SESSION["role"] == "admin") {
    header("Location:" . BASE_URL . "?page=uzivatele"); //presmerovat!!
} else {
    $_SESSION["user_id"] = "";
    $_SESSION["username"] = "";
    $_SESSION["email"] = "";
    header("Location:" . BASE_URL);
}
?>