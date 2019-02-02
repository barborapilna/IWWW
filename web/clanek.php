<?php
$sel_query = $conn->prepare("SELECT * FROM clanek WHERE id_clanku = :id_clanku");
$stmt->bindParam(':id_clanku', $_GET["id_clanku"]);
$stmt->execute();

echo'<div class="card">
        <h2>' . $row["nazev_clanku"] . '</h2>
        <h4>ID autora: ' . $row["fk_id_uctu"] . '</h4>
        <div class="fakeimg" style="height:200px;">Image</div>
        <div>' . $row["text_clanku"] . '</div>
        <h5>' . $row["datum_vlozeni"] . '</h5>
        <div>Tento článek spadá do kategorie: ' . $row["fk_id_kategorie"] . '</div>
    </div>';

?>