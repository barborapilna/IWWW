<?php

include "config.php";
ob_start();
session_start();

$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
);

$conn = new PDO("mysql:host=localhost;dbname=" . DB_NAME, DB_USER, DB_PASSWORD, $options);

?>

<!DOCTYPE html>
<!--KOMENTARE-->

<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styly.css"/>
    <title>Blog Dva světy</title>
</head>
<body>

<header class="header">
    <h2>Blog Dva světy</h2>
</header>
<nav style="width:  100%; margin-bottom: 12px; text-align: center">
    <div class="card">
    <a href="<?= BASE_URL ?>">Domů </a>
    <?php if (!empty($_SESSION["id_uzivatele"])) { ?>
        <a href="<?= BASE_URL . "?page=odhlasit" ?>"> Odhlásit </a>

        <a href="<?= BASE_URL . "?page=insert_clanek" ?>"> Vložit článek </a>
        <?php if ($_SESSION["role"] == "admin") { ?>
            <a href="<?= BASE_URL . "?page=sprava_blogu" ?>"> Spravovat blog </a>
        <?php } ?>
    <?php } else { ?>
        <a href="<?= BASE_URL . "?page=prihlasit" ?>"> Přihlásit </a>
        <a href="<?= BASE_URL . "?page=insert_uzivatele&registrace=ano" ?>"> Registrovat </a>
    <?php } ?>
    </div>
</nav>

<nav style="text-align: center">
    <div class="card">
        <?php
        $sel_query = "SELECT * FROM kategorie";
        $stmt = $conn->query($sel_query);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<a style="margin-right: 10px" href="' . BASE_URL . "?page=urcita_kategorie&kategorie=" . $row["nazev_kategorie"] . '">' . $row["nazev_kategorie"] . '</a>';
        } ?>
    </div>
</nav>

<main>

    <div>
        <?php
        if (isset($_GET['page'])) {
            $file = $_GET['page'] . ".php";
            if (file_exists($file)) {
                include $file;
            } else {
                $file = "./php databaze/" . $_GET["page"] . ".php";
                if (file_exists($file)) {
                    include $file;
                }
            }
        } else {
            include "home.php";
        }
        ?>
    </div>
</main>
<br>

<footer>
    <div>
        <address>
            <p>O blogu:</p>
            Vytvořila: <a href="mailto:barca.pilna@fake.cz">Barbora Pilná</a>.<br>
            Telefon: <a href="tel:+420111222333">111 222 333</a><br>
            Pardubice, Dlouhá 15<br>
        </address>
    </div>
    <div>Copyright © 2019 Barbora Pilná</div>
</footer>

</body>
</html>



