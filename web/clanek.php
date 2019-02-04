<?php
$stmt = $conn->prepare("SELECT c.id_clanku, c.nazev_clanku, c.text_clanku, c.datum_vlozeni, c.fk_id_kategorie, 
                                      u.jmeno_uzivatele ,u.prijmeni_uzivatele, k.nazev_kategorie,  o.nazev_obrazku 
                                      FROM clanek c
                                      JOIN ucet_uzivatele u ON c.fk_id_uctu = u.id_uzivatele
                                      JOIN kategorie k ON c.fk_id_kategorie = k.id_kategorie
                                      JOIN obrazek o ON o.id_obrazku = c.fk_id_obrazku
                                      WHERE  id_clanku = :id_clanku");
$stmt->bindParam(':id_clanku', $_GET["id_clanku"]);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<div class="card">
                <h2>' . $row["nazev_clanku"] . '</h2>
                <h4>Autor: ' . $row["jmeno_uzivatele"] . " " . $row["prijmeni_uzivatele"] . '</h4>
                <img src="uploads/' . $row["nazev_obrazku"] . '"/"" />
                <div><p style="white-space: pre-line">' . $row["text_clanku"] . '</p></div>
                <h5>' . $row["datum_vlozeni"] . '</h5>
                <div>Tento článek spadá do kategorie: ' . $row["nazev_kategorie"] . '</div>
            </div>';
}
?>

<div class="card">
    <h3> Ohodnoťte tento článek </h3><br>

    <?php
    $stmt = $conn->prepare("SELECT count(*) AS pocetLike
                                      FROM hodnoceni_clanku
                                      WHERE hodnoceni = 'like' AND 
                                            fk_id_clanku = :id_clanku");
    $stmt->bindParam(':id_clanku', $_GET["id_clanku"]);
    $stmt->execute();
    $pocetLike = $stmt->fetch(PDO::FETCH_ASSOC)["pocetLike"];

    $stmt = $conn->prepare("SELECT count(*) AS pocetDislike
                                      FROM hodnoceni_clanku
                                      WHERE hodnoceni = 'dislike' AND 
                                            fk_id_clanku = :id_clanku");
    $stmt->bindParam(':id_clanku', $_GET["id_clanku"]);
    $stmt->execute();
    $pocetDislikLike = $stmt->fetch(PDO::FETCH_ASSOC)["pocetDislike"];

    ?>

    <a href="<?php echo BASE_URL . "?page=insert_hodnoceni&hodnoceni=" . 'like' .
        "&id_clanku=" . $_GET["id_clanku"]; ?>">&emsp;Super článek!&emsp;</a>
    <?php echo $pocetLike ?>

    <a style="margin-left: 100px" href="<?php echo BASE_URL . "?page=insert_hodnoceni&hodnoceni=" . 'dislike' .
        "&id_clanku=" . $_GET["id_clanku"]; ?>">&emsp;Článek se mi nelíbí.&emsp;</a>
    <?php echo $pocetDislikLike ?>

</div>

<div class="card">
    <h3> Komentáře ke článku </h3><br>
    <a href="<?php echo BASE_URL . "?page=insert_komentar&level=1" .
        "&fk_id_komentare=1" .
        "&id_clanku=" . $_GET["id_clanku"]; ?>">Napsat komentář</a><br><br>
    <?php

    function vypis($level, $id_komentare, $id_clanku)
    {
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        );

        $conn = new PDO("mysql:host=localhost;dbname=" . DB_NAME, DB_USER, DB_PASSWORD, $options);

        $sel_query = "SELECT text_komentare, level, id_komentare 
                  FROM komentar 
                  WHERE level = " . $level .
            " AND fk_id_komentare=" . $id_komentare;


        $stmt = $conn->query($sel_query);
        if ($stmt->rowCount() == 0)
            return "";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $mezery = "";
            for ($i = 1; $i < $level; $i++) {
                $mezery .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            }
            echo $mezery . $row["text_komentare"] . "<br>";
            echo $mezery . '<a href="' .
                BASE_URL . "?page=insert_komentar&level=" . $level .
                "&fk_id_komentare=" . $id_komentare .
                "&id_clanku=" . $id_clanku . '">Komentovat</a><br><br>';

            vypis(($row["level"]) + 1, $row["id_komentare"], $id_clanku);
        }
    }

    $sel_query = "SELECT level, id_komentare, fk_id_clanku FROM komentar";
    $stmt = $conn->query($sel_query);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        vypis($row["level"], $row["id_komentare"], $row["fk_id_clanku"]);
    }
    ?>
</div>

