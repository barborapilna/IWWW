<!-- NEJ NA WEBU -->
<div class="card", style="text-align: center">
    <h2>Nejlépe hodnocené na webu</h2>
    <h3>1 <a href= "#">Nadpis článku</a></h3>
    <h3>2 <a href= "#">Nadpis článku</a></h3>
    <h3>3 <a href= "#">Nadpis článku</a></h3>
</div>

<?php

 $sel_query = "SELECT * FROM clanek ORDER BY datum_vlozeni DESC";
                    $stmt = $conn->query($sel_query);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
						 echo '
								<div class="card">
								  <h2>
								    <a href= "clanek.php">' . $row["nazev_clanku"] . '</a>
								  </h2>
								  <h4>ID autora: ' . $row["fk_id_uctu"] . '</h4>
								  <div class="fakeimg" style="height:200px;">Image</div>
								  <h5>' . $row["datum_vlozeni"] . '</h5>
								</div>
							  ';
					
					}
?>