<?php if ($_SESSION["role"] == "admin") { ?>
    <nav style="width:  100%; margin-bottom: 12px; text-align: center" class="topnav">
        <a href="<?= BASE_URL . "?page=uzivatele" ?>">Uživatelé</a>
        <a href="<?= BASE_URL . "?page=kategorie" ?>">Kategorie</a>
        <a href="<?= BASE_URL . "?page=hodnoceni" ?>">Hodnocení</a>
        <a href="<?= BASE_URL . "?page=komentare" ?>">Komentáře</a>
        <a href="<?= BASE_URL . "?page=vypis_clanku" ?>">Články</a>
        <a href="<?= BASE_URL . "?page=exportJSON" ?>">Export</a>
        <a href="<?= BASE_URL . "?page=importJSON" ?>">Import</a>
    </nav>
<?php } ?>

<h1>Kategorie</h1>
<table class="myTable">
    <thead>
    <tr>
        <th><strong>Řádek</strong></th>
        <th><strong>Kategorie</strong></th>
    </tr>
    </thead>
    <tbody>
    <?php

    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    );

    $conn = new PDO("mysql:host=localhost;dbname=" . DB_NAME, DB_USER, DB_PASSWORD, $options);

    $count = 1;
    $sel_query = "SELECT id_kategorie, nazev_kategorie FROM kategorie ORDER BY nazev_kategorie DESC";

    $stmt = $conn->query($sel_query);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row["nazev_kategorie"]; ?></td>
            <td>
                <a href="<?php echo BASE_URL . "?page=update_kategorie&id_kategorie=" . $row["id_kategorie"]; ?>">Upravit</a>
            </td>
            <td>
                <a href="<?php echo BASE_URL . "?page=delete_kategorie&id_kategorie=" . $row["id_kategorie"]; ?>">Smazat</a>
            </td>
        </tr>

        <?php $count++;
    }
    $conn = null;
    ?>

    </tbody>
</table>
<br>
<h5>Vytvořit novou kategorii</h5>
<?php include 'php databaze/insert_kategorie.php'; ?>
<br>
<hr>