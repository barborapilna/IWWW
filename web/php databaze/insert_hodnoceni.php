<div class="form">
    <?php
    if (isset($_POST['new']) && $_POST['new'] == 1)
    {
        $hodnoceni = $_POST['hodnoceni'];
        $id_clanku = $_POST['id_clanku'];

        $stmt = $conn->prepare("INSERT INTO hodnoceni_clanku (hodnoceni, fk_id_clanku) 
                                          VALUE (:hodnoceni, :id_clanku)");

        $stmt->bindParam(':hodnoceni', $hodnoceni);
        $stmt->bindParam(':id_clanku', $id_clanku);
        $stmt->execute();

        header("refresh: 0;");
    }else { ?>
    <div>
        <form name="form" method="post">
            <input type="hidden" name="new" value="1"/>
            <p></p>

            <p><input name="submit" type="submit" value="Insert"/></p>

        </form>
        <?php } ?>
    </div>
</div>