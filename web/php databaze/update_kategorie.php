<?php
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
);

$conn = new PDO("mysql:host=localhost;dbname=" . DB_NAME, DB_USER, DB_PASSWORD, $options);
$stmt = $conn->prepare("SELECT id_kategorie, nazev_kategorie FROM kategorie WHERE id_kategorie = :id_kategorie");
$stmt->bindParam(':id_kategorie', $_GET["id_kategorie"]);
$stmt->execute();
$kategorie =$stmt->fetch();
?>

<div class="form">
    <?php
    if (isset($_POST['new']) && $_POST['new'] == 1)
    {
        $kategorie = $_POST['kategorie'];
        $stmt = $conn->prepare("UPDATE kategorie SET nazev_kategorie = :kategorie WHERE id_kategorie = :id_kategorie");
        $stmt->bindParam(':kategorie', $kategorie);
        $stmt->bindParam(':id_kategorie', $_GET["id_kategorie"]);
        $stmt->execute();

        include "./home.php";
    }else { ?>
    <div>
        <form name="form" method="post">
            <input type="hidden" name="new" value="1"/>
            <p>Kategorie: <input style="margin-left: 32px" type="text" name="kategorie"
                                 placeholder="Zadejte kategorii: "
                                 value="<?php echo $kategorie["kategorie"] ?>"/></p>

            <p><input name="submit" type="submit" value="Update"/></p>

        </form>
        <?php } ?>
    </div>
</div>