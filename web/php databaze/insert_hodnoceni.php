    <?php
    $stmt = $conn->prepare("SELECT count(*) AS pocet
                                      FROM hodnoceni_clanku
                                      WHERE id_uctu = :id_uctu 
                                      AND fk_id_clanku = :id_clanku");

    $stmt->bindParam(':id_clanku', $_GET["id_clanku"]);
    $stmt->bindParam(':id_uctu', $_SESSION["id_uzivatele"]);
    $stmt->execute();
    $hodnotil = $stmt->fetch(PDO::FETCH_ASSOC);

    if($hodnotil["pocet"] == 0){
        $hodnoceni = $_GET['hodnoceni'];
        $id_clanku = $_GET['id_clanku'];

        $stmt = $conn->prepare("INSERT INTO hodnoceni_clanku (hodnoceni, fk_id_clanku, id_uctu) 
                                          VALUE (:hodnoceni, :id_clanku, :id_uzivatele)");

        $stmt->bindParam(':hodnoceni', $hodnoceni);
        $stmt->bindParam(':id_clanku', $id_clanku);
        $stmt->bindParam(':id_uzivatele', $_SESSION["id_uzivatele"]);
        $stmt->execute();

       include "./home.php";
    }else{
        echo '<h1>Už jste hodnotili</h1>';
    }