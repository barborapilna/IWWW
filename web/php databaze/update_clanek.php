<?php
$stmt = $conn->prepare("SELECT nazev_clanku, text_clanku FROM clanek WHERE id_clanku = :id_clanku");
$stmt->bindParam(':id_clanku', $_GET["id_clanku"]);

$stmt->execute();
$clanek = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<div class="form">
    <?php
    if (isset($_POST['new']) && $_POST['new'] == 1)
    {
        move_uploaded_file($_FILES["imageFile"]["tmp_name"], "./uploads/" . $_FILES["imageFile"]["name"]);

        $stmt = $conn->prepare("UPDATE obrazek SET nazev_obrazku = :obrazek");
        $stmt->bindParam(":obrazek", $_FILES["imageFile"]["name"]);
        $stmt->execute();

        $stmt = $conn->prepare("SELECT id_obrazku FROM obrazek WHERE nazev_obrazku = :nazev");
        $stmt->bindParam(":nazev", $_FILES["imageFile"]["name"]);
        $stmt->execute();
        $id_obrazku = $stmt->fetch(PDO::FETCH_ASSOC)["id_obrazku"];

        $nazev = $_POST['nazev'];
        $clanek = $_POST['clanek'];
        $kategorie = $_POST['kategorie'];
        $datumVlozeni = $now = date_create()->format('Y-m-d');

        $stmt = $conn->prepare("UPDATE clanek SET nazev_clanku = :nazev, text_clanku = :clanek, 
                                          datum_vlozeni = :datum_vlozeni, fk_id_uctu = :id_uzivatele, fk_id_kategorie = :id_kategorie, 
                                          fk_id_obrazku = :id_obrazku WHERE id_clanku = :id_clanku");


        $stmt->bindParam(':nazev', $nazev);
        $stmt->bindParam(':clanek', $clanek);
        $stmt->bindParam(':datum_vlozeni', $datumVlozeni);
        $stmt->bindParam(':id_uzivatele', $_SESSION["id_uzivatele"]);
        $stmt->bindParam(':id_kategorie', $kategorie);
        $stmt->bindParam(':id_obrazku', $id_obrazku);
        $stmt->bindParam(':id_clanku', $_GET["id_clanku"]);
        $stmt->execute();

        include "./home.php";
    }else { ?>
    <div>
        <form name="form" method="post" enctype="multipart/form-data">
            <input type="hidden" name="new" value="1"/>

            <?php echo'<textarea name="nazev" cols="150" rows="2" placeholder="Název článku">' . $clanek["nazev_clanku"] .'</textarea>';?>

            <?php echo'<textarea name="clanek" cols="150" rows="100" placeholder="Text článku">' . $clanek["text_clanku"] .'</textarea>';?>

            <p>Kategorie: <select name="kategorie" style="margin-left: 18px; width: 180px">
                    <?php
                    $sel_query = "SELECT * FROM kategorie ORDER BY nazev_kategorie DESC";
                    $stmt = $conn->query($sel_query);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $row["id_kategorie"] ?>">
                            <?php echo $row["nazev_kategorie"] ?>
                        </option>
                    <?php } ?>
                </select></p>

            <p>Obrázek: <input type="file" name="imageFile"/></p>
            <p><input name="submit" type="submit" value="Update"/></p>
        </form>
        <?php } ?>
    </div>
</div>