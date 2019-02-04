<?php
$stmt = $conn->prepare("SELECT c.id_clanku AS id, c.nazev_clanku AS nazev, c.datum_vlozeni AS datum, 
                u.jmeno_uzivatele AS jmeno, u.prijmeni_uzivatele AS prijmeni, o.nazev_obrazku AS obrazek
                FROM clanek c
                JOIN kategorie k ON c.fk_id_kategorie = k.id_kategorie
                JOIN ucet_uzivatele u ON c.fk_id_uctu = u.id_uzivatele
                JOIN obrazek o ON o.id_obrazku = c.fk_id_obrazku
                WHERE k.nazev_kategorie =  :kategorie
                ORDER  BY c.datum_vlozeni DESC");

$stmt->bindParam(':kategorie', $_GET["kategorie"]);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '
				<div class="card">
				  <h2>
				    <a href="' . BASE_URL . "?page=clanek&id_clanku=" . $row["id"] . '">' . $row["nazev"] . '</a>
				  </h2>
				  <h4>Autor: ' . $row["jmeno"] . " " . $row["prijmeni"] . '</h4>
				  <img src="uploads/' .  $row["obrazek"] . '"/"" />
				  <h5>' . $row["datum"] . '</h5>
				</div>
			';


}
?>
