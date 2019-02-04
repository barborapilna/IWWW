<h1>Články</h1>
<?php

$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
);

$conn = new PDO("mysql:host=localhost;dbname=" . DB_NAME, DB_USER, DB_PASSWORD, $options);

$sel_query = "SELECT json_object('nazevClanku', nazev_clanku, 'jmenoAutora', jmeno_uzivatele, 'prijmeniAutora', prijmeni_uzivatele) AS jsonOutput 
              FROM clanek 
              JOIN ucet_uzivatele ON fk_id_uctu = id_uzivatele";

$stmt = $conn->query($sel_query);
$json = "";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $json = $json.$row["jsonOutput"];
}

$nazevSouboru = 'clanky.json';
file_put_contents($nazevSouboru,$json );

if (file_exists($nazevSouboru)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($nazevSouboru));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($nazevSouboru));
    ob_clean();
    flush();
    readfile($nazevSouboru);
    unlink($nazevSouboru);
}

?>
<br>