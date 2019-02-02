<?php if ($_SESSION["role"] == "admin") { ?>
    <nav style="width:  100%; margin-bottom: 12px; text-align: center">
        <a href="<?= BASE_URL . "?page=uzivatele" ?>">Uživatelé</a>
        <a href="<?= BASE_URL . "?page=kategorie" ?>">Kategorie</a>
        <a href="<?= BASE_URL . "?page=hodnoceni" ?>">Hodnocení</a>
        <a href="<?= BASE_URL . "?page=komentare" ?>">Komentáře</a>
        <a href="<?= BASE_URL . "?page=role" ?>">Role</a>
        <a href="<?= BASE_URL . "?page=obrazky" ?>">Obrázky</a>
    </nav>
<?php } ?>

<h1>Uživatelé</h1>
<table class="myTable">
    <thead>
    <tr>
        <th><strong>Řádek</strong></th>
        <th><strong>Login</strong></th>
        <th><strong>Heslo</strong></th>
        <th><strong>Jméno</strong></th>
        <th><strong>Příjmení</strong></th>
        <th><strong>Email</strong></th>
        <th><strong>Role uživatele</strong></th>
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
    $sel_query = "SELECT * FROM ucet_uzivatele ORDER BY jmeno_uzivatele DESC";

    $stmt = $conn->query($sel_query);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row["login"]; ?></td>
            <td><?php echo $row["heslo"]; ?></td>
            <td><?php echo $row["jmeno_uzivatele"]; ?></td>
            <td><?php echo $row["prijmeni_uzivatele"]; ?></td>
            <td><?php echo $row["email_uzivatele"]; ?></td>
            <td><?php echo $row["role_uzivatele"]; ?></td>
            <td>
                <a href="<?php echo BASE_URL . "?page=update_uzivatele&id_uzivatele=" . $row["id_uzivatele"]; ?>">Upravit</a>
            </td>
            <td>
                <a href="<?php echo BASE_URL . "?page=delete_uzivatele&id_uzivatele=" . $row["id_uzivatele"]; ?>">Smazat</a>
            </td>
        </tr>

        <?php $count++;
    }
    $conn = null;
    ?>

    </tbody>
</table>

<br>
<h5>Vytvořit nového uživatele</h5>
<?php include 'php databaze/insert_uzivatele.php'; ?>
<br>
<hr>