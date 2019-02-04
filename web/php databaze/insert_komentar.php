<div class="form">
    <?php
    if (isset($_POST['new']) && $_POST['new'] == 1)
    {
        $level = $_GET["level"];
        $fk_id_komentare = $_GET['fk_id_komentare'];
        $id_clanku = $_GET['id_clanku'];
        $komentar = $_POST['komentar'];
        $id_uctu = $_SESSION["id_uzivatele"];


        $stmt = $conn->prepare("INSERT INTO komentar (text_komentare, fk_id_komentare, fk_id_clanku, level,
                                           fk_id_uctu) VALUE (:komentar, :fk_id_komentare, :id_clanku, :level, :id_uctu)");

        $stmt->bindParam(':komentar', $komentar);
        $stmt->bindParam(':fk_id_komentare', $fk_id_komentare);
        $stmt->bindParam(':id_clanku', $id_clanku);
        $stmt->bindParam(':id_uctu', $id_uctu);
        $stmt->bindParam(':level', $level);
        $stmt->execute();

        header("refresh: 0;");
    }else { ?>
    <div>
        <form name="form" method="post">
            <input type="hidden" name="new" value="1"/>

            <textarea name="komentar" cols="150" rows="50" placeholder="Zadejte komentář"></textarea>

            <p><input name="submit" type="submit" value="Insert"/></p>

        </form>
        <?php } ?>
    </div>
</div>