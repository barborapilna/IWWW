<div class="form">
    <?php
    if (isset($_POST['new']) && $_POST['new'] == 1)
    {
        $kategorie = $_POST['kategorie'];
        $stmt = $conn->prepare("INSERT INTO kategorie (nazev_kategorie)
                                         value (:kategorie)");
        $stmt->bindParam(':kategorie', $kategorie);
        $stmt->execute();

        header("refresh: 0;");
    }else { ?>
    <div>
        <form name="form" method="post">
            <input type="hidden" name="new" value="1"/>
            <p>Kategorie: <input style="margin-left: 10px" type="text" name="kategorie"
                             placeholder="Zadejte kategorii: "/></p>

            <p><input name="submit" type="submit" value="Insert"/></p>

        </form>
        <?php } ?>
    </div>
</div>