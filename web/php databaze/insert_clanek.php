<div class="form">
    <?php
    if (isset($_POST['new']) && $_POST['new'] == 1)
    {
        move_uploaded_file($_FILES["imageFile"]["tmp_name"], "./uploads/" . $_FILES["imageFile"]["name"]);

        $stmt = $conn->prepare("INSERT INTO obrazek (nazev_obrazku) VALUE(:obrazek)");
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

        $stmt = $conn->prepare("INSERT INTO clanek (nazev_clanku, text_clanku, datum_vlozeni, fk_id_uctu, fk_id_kategorie, fk_id_obrazku)
                                         VALUE(:nazev, :clanek, :datum_vlozeni, :id_uzivatele, :id_kategorie, :id_obrazku)");


        $stmt->bindParam(':nazev', $nazev);
        $stmt->bindParam(':clanek', $clanek);
        $stmt->bindParam(':datum_vlozeni', $datumVlozeni);
        $stmt->bindParam(':id_uzivatele', $_SESSION["id_uzivatele"]);
        $stmt->bindParam(':id_kategorie', $kategorie);
        $stmt->bindParam(':id_obrazku', $id_obrazku);
        $stmt->execute();

        include "./home.php";
    }else { ?>
    <div>
        <form name="form" method="post" enctype="multipart/form-data">
            <input type="hidden" name="new" value="1"/>
            <p>Název článku: <input style="margin-left: 32px" type="text" name="nazev"
                                    placeholder="Zadejte název článku"/></p>
            <textarea name="clanek" cols="150" rows="1000" placeholder="Text článku"></textarea>

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
            <p><input name="submit" type="submit" value="Insert"/></p>
        </form>
        <?php } ?>
    </div>
</div>