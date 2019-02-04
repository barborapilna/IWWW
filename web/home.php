<?php

 $sel_query = "SELECT * FROM clanek c
                JOIN ucet_uzivatele u ON c.fk_id_uctu = u.id_uzivatele
                JOIN obrazek o ON o.id_obrazku = c.fk_id_obrazku
                ORDER BY c.datum_vlozeni DESC";
                    $stmt = $conn->query($sel_query);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
						 echo '
								<div class="card">
								  <h2>
								   <a href="' . BASE_URL . "?page=clanek&id_clanku=" . $row["id_clanku"] . '">' . $row["nazev_clanku"] . '</a>
								  </h2>
								  <h4>Autor: ' . $row["jmeno_uzivatele"] . " " . $row["prijmeni_uzivatele"] . '</h4>
								  <img src="uploads/' .  $row["nazev_obrazku"] . '"/"" />
								  <h5>' . $row["datum_vlozeni"] . '</h5>
								</div>
							  ';
					
					}
?>