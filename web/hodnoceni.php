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

<h1>Hodnocení</h1>
<table class="myTable">
    <thead>
    <tr>
        <th><strong>Řádek</strong></th>
        <th><strong>Hodnoceno</strong></th>
        <th><strong>ID článku</strong></th>
        <th><strong>Hodnotil</strong></th>
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
    $sel_query = "SELECT h.id_hodnoceni, h.hodnoceni, h.fk_id_clanku, u.jmeno_uzivatele, u.prijmeni_uzivatele
                  FROM hodnoceni_clanku h
                  JOIN ucet_uzivatele u ON u.id_uzivatele = h.id_uctu";

    $stmt = $conn->query($sel_query);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row["hodnoceni"]; ?></td>
            <td><?php echo $row["fk_id_clanku"]; ?></td>
            <td><?php echo $row["jmeno_uzivatele"] . " " . $row["prijmeni_uzivatele"]; ?>
            <td>
                <a href="<?php echo BASE_URL . "?page=delete_hodnoceni&id_hodnoceni=" . $row["id_hodnoceni"]; ?>">Smazat</a>
            </td>
        </tr>

        <?php $count++;
    }
    $conn = null;
    ?>

    </tbody>
</table>