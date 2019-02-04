<?php
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
);

$conn = new PDO("mysql:host=localhost;dbname=" . DB_NAME, DB_USER, DB_PASSWORD, $options);
$stmt = $conn->prepare("SELECT login, heslo, jmeno_uzivatele, prijmeni_uzivatele, email_uzivatele,
                                        FROM ucet_uzivatele WHERE id_uzivatele = :id_uzivatele");
$stmt->bindParam(':id_uzivatele', $_GET["id_uzivatele"]);
$stmt->execute();
$uzivatel = $stmt->fetch();
?>

<div>
    <?php
    if (isset($_POST['new']) && $_POST['new'] == 1)
    {
		$login = $_POST['login'];
        $heslo = $_POST['heslo'];
        $jmeno = $_POST['jmeno'];
        $prijmeni = $_POST['prijmeni'];
		$email = $_POST['email'];
		$role = ($_SESSION["role"] == "admin" ? $_POST["role"] : "Uživatel");

        $stmt = $conn->prepare("UPDATE ucet_uzivatele SET login = :login, heslo = :heslo, jmeno_uzivatele = :jmeno, 
								prijmeni_uzivatele = :prijmeni, email_uzivatele = :email role_uzivatele = :role WHERE id_uzivatele = :id_uzivatele");
		$stmt->bindParam(':login', $login);
        $stmt->bindParam(':heslo', $heslo);
        $stmt->bindParam(':jmeno', $jmeno);
        $stmt->bindParam(':prijmeni', $prijmeni);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':role', $role);
        $stmt->bindParam(':id_uzivatele', $_GET["id_uzivatele"]);
        $stmt->execute();

        include "./home.php";
    }else { ?>
    <div>
        <script>
            function validateForm() {
                if (document.forms["form"]["login"].value == "") {
                    alert("Login musí být vyplněn");
                    return false;
                }

                if (document.forms["form"]["jmeno"].value == "") {
                    alert("Jméno musí být vyplněno");
                    return false;
                }

                if (document.forms["form"]["prijmeni"].value == "") {
                    alert("Příjmení musí být vyplněno");
                    return false;
                }
				
                if (document.forms["form"]["email"].value == "") {
                    alert("Email musí být vyplněn");
                    return false;
                }

            }
        </script>
		
		<form onsubmit="return validateForm()" method="post">
            <input type="hidden" name="new" value="1"/>
            <input name="id" type="hidden" value="<?php echo $row['id']; ?>"/>

            <p>Login: <input style="margin-left: 32px" type="text" name="login"
                             placeholder="Zadejte uživatelské jméno"
                             required value="<?php echo $uzivatel['login']; ?>"/></p>
            <p>Heslo: <input type="heslo" name="heslo" placeholder="Zadejte heslo"
                                required value="<?php echo $uzivatel['heslo']; ?>"/></p>
            <p>Email: <input style="margin-left: 30px" type="email" name="email" placeholder="Zadejte email"
                             required value="<?php echo $uzivatel['email']; ?>"/></p>
            <p>Jméno: <input style="margin-left: 30px" type="text" name="jmeno" placeholder="Zadejte jméno"
                             required value="<?php echo $uzivatel['jmeno']; ?>"/></p>
            <p>Příjmení: <input style="margin-left: 30px" type="text" name="prijmeni" placeholder="Zadejte příjmení"
                             required value="<?php echo $uzivatel['prijmeni']; ?>"/></p>
            <p><input name="submit" type="submit" value="Update"/></p>
        </form>

        <?php } ?>
    </div>
</div>