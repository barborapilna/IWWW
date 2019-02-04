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

<h1>Články</h1>
<table class="myTable">
    <thead>
    <tr>
        <th><strong>Řádek</strong></th>
        <th><strong>Název článku</strong></th>
        <th><strong>Datum vložení</strong></th>
        <th><strong>Autor</strong></th>
        <th><strong>Kategorie</strong></th>
        <th><strong>Název obrázku</strong></th>
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
    $sel_query = "SELECT c.id_clanku, c.nazev_clanku, c.datum_vlozeni, c.fk_id_kategorie, c.fk_id_obrazku, 
                                      u.jmeno_uzivatele ,u.prijmeni_uzivatele, k.nazev_kategorie, o.nazev_obrazku 
                                      FROM clanek c
                                      JOIN ucet_uzivatele u ON c.fk_id_uctu = u.id_uzivatele
                                      JOIN kategorie k ON c.fk_id_kategorie = k.id_kategorie
                                      JOIN obrazek o ON c.fk_id_obrazku = o.id_obrazku";

    $stmt = $conn->query($sel_query);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row["nazev_clanku"]; ?></td>
            <td><?php echo $row["datum_vlozeni"]; ?></td>
            <td><?php echo $row["jmeno_uzivatele"] . " " . $row["prijmeni_uzivatele"]; ?>
            <td><?php echo $row["nazev_kategorie"]; ?></td>
            <td><?php echo $row["nazev_obrazku"]; ?></td>
            <td>
                <a href="<?php echo BASE_URL . "?page=update_clanek&id_clanku=" . $row["id_clanku"]; ?>">Upravit</a>
            </td>
            <td>
                <a href="<?php echo BASE_URL . "?page=delete_clanek&id_clanku=" . $row["id_clanku"]; ?>">Smazat</a>
            </td>
        </tr>

        <?php $count++;
    }
    $conn = null;
    ?>

    </tbody>
</table>
