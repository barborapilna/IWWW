<div class="form">
    <?php
    if (isset($_POST['new']) && $_POST['new'] == 1)
    {
        $komentar = $_POST['komentar'];
        $fk_id_komentare = $_POST['fk_id_komentare'];
        $id_clanku = $_POST['id_clanku'];
        $id_uctu = $_POST['id_uctu'];

        $stmt = $conn->prepare("INSERT INTO komentar (text_komentare, fk_id_komentare, fk_id_clanku,
                                           fk_id_uctu) VALUE (:komentar, :fk_id_komentare, :id_clanku, :id_uctu)");

        $stmt->bindParam(':kategorie', $kategorie);
        $stmt->bindParam(':fk_id_komentare', $fk_id_komentare);
        $stmt->bindParam(':id_clanku', $id_clanku);
        $stmt->bindParam(':id_uctu', $id_uctu);
        $stmt->execute();

        header("refresh: 0;");
    }else { ?>
    <div>
        <form name="form" method="post">
            <input type="hidden" name="new" value="1"/>
            <p>Komentář: <textarea name="komentar" cols="150" rows="200" placeholder="Zadejte komentář"></textarea>
                </p>

            <p><input name="submit" type="submit" value="Insert"/></p>

        </form>
        <?php } ?>
    </div>
</div>