<?php
$stmt = $conn->prepare("SELECT c.nazev_clanku AS nazev, c.datum_vlozeni AS datum, u.jmeno_uzivatele AS jmeno, u.prijmeni_uzivatele AS prijmeni FROM clanek c
                JOIN kategorie k ON c.fk_id_kategorie = k.id_kategorie
                JOIN ucet_uzivatele u ON c.fk_id_uctu = u.id_uzivatele
                WHERE k.nazev_kategorie =  :kategorie
                ORDER  BY c.datum_vlozeni DESC");

$stmt->bindParam(':kategorie', $_GET["kategorie"]);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '
				<div class="card">
				  <h2>
				    <a href= "clanek.php">' . $row["nazev"] . '</a>
				  </h2>
				  <h4>ID autora: ' . $row["jmeno"] . " " . $row["prijmeni"] . '</h4>
				  <div class="fakeimg" style="height:200px;">Image</div>
				  <h5>' . $row["datum"] . '</h5>
				</div>
			';


}
?>
