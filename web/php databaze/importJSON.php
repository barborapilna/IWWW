<?php
//$conn = new PDO("mysql:host=localhost;dbname=" . DB_NAME, DB_USER, DB_PASSWORD, $options);
//$file=fopen("importClanku.csv","r");
//
//while(($getData=fgetcsv($file,1000,","))!=FALSE){
//    $sql= "INSERT INTO clanek(nazev_clanku, fk_id_uctu)
//            VALUES ('$getData[0]', '$getData[1]')";
//    $result=mysqli_query($conn,$sql);
//}
//include "./home.php";
//fclose($file);
//?>
<!---->

<div class="form">

    <?php
    if (isset($_POST['new']) && $_POST['new'] == 1)
    {
//        $jsondata = file_get_contents($_FILES["file"]["tmp_name"]);
//        $obj = json_decode($jsondata, true);
//        print_r($obj);
//        var_dump($obj); //nevim proc to nenacita

        $uploaddir = './uploads/';
        $uploadfile = $uploaddir . basename($_FILES['file']['name']);
        $extension = array("json", "JSON");
        $UploadOk = true;
        $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        if (in_array($ext, $extension) == false) {
            $UploadOk = false;
            echo "Soubor se nepodařilo nahrát.";
        }
        if ($UploadOk == true) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                $jsondata = file_get_contents($uploadfile);
                $obj = json_decode($jsondata, true);
                echo "Soubor se úspěšně nahrál.";
            }
        }

//        $stmt = $conn->prepare("SELECT id_uzivatele FROM ucet_uzivatele
//                                             WHERE jmeno_uzivatele = :jmeno
//                                             AND prijmeni_uzivatele = :prijmeni");
//        $stmt->bindParam(":jmeno", $obj["jmenoAutora"]);
//        $stmt->bindParam(":prijmeni", $obj["prijmeniAutora"]);
//        $stmt->execute();
//        $row = $stmt->fetch(PDO::FETCH_ASSOC);
//        $idUzivatele = $row["id_uzivatele"];
//
//        $stmt = $conn->prepare("INSERT INTO clanek (nazev_clanku, fk_id_uctu)
//                                         VALUE(:nazev,:id_uzivatele)");
//
//        $stmt->bindParam(':nazev', $obj["nazevClanku"]);
//        $stmt->bindParam(':id_uzivatele', $idUzivatele);
//        $stmt->execute();
        include "./home.php";

    }else { ?>
    <div>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="new" value="1"/>
            <label for="file">Vyberte JSON soubor k importu:</label>
            <input type="file" name="file" id="file"/>
            <br/>
            <input type="submit" name="submit" value="Submit"/>
        </form>

        <?php } ?>
    </div>
</div>