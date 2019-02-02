<div class="form">
    <?php
    if (isset($_POST['new']) && $_POST['new'] == 1)
    {
        $login = $_POST['login'];
        $heslo = $_POST['heslo'];
		$jmeno = $_POST["jmeno"];
        $prijmeni = $_POST["prijmeni"];
        $email = $_POST["email"];
        $role = $_POST["role"];

        $stmt = $conn->prepare("SELECT distinct count(id_uzivatele) as pocet FROM ucet_uzivatele 
                                         WHERE email_uzivatele = :email
                                         GROUP BY id_uzivatele");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row["pocet"] != 1) {
            $stmt = $conn->prepare("INSERT INTO ucet_uzivatele (login, heslo, jmeno_uzivatele, prijmeni_uzivatele, 
																email_uzivatele, role_uzivatele)
                                                                value (:login, :heslo, :jmeno, :prijmeni, :email, 'Uživatel')");
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':heslo', $heslo);
			$stmt->bindParam(':jmeno', $jmeno);
            $stmt->bindParam(':prijmeni', $prijmeni);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
        } else {
            $stmt = $conn->prepare("SELECT distinct id_uzivatele FROM ucet_uzivatele 
                                         WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $idUzivatele = $row["id_uzivatele"];

            $stmt = $conn->prepare("UPDATE ucet_uzivatele 
              SET login = :login, heslo = :heslo, jmeno_uzivatele = :jmeno, prijmeni_uzivatele = :prijmeni,
              email_uzivatele = :email, role_uzivatele = 'Uživatel'  WHERE id_uzivatele = :id_uzivatele");
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':heslo', $heslo);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':jmeno', $jmeno);
            $stmt->bindParam(':prijmeni', $prijmeni);
            $stmt->execute();
        }


        if ($_GET["registrace"] == "ano") {
            header("Location:" . BASE_URL);
        } else {
            header("refresh: 0;");
        }

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


        <form onsubmit="return validateForm()" name="form" method="post">
            <input type="hidden" name="new" value="1"/>

            <p>Login: <input style="margin-left: 32px" type="text" name="login"
                             placeholder="Zadejte uživatelské jméno"/></p>
            <p>Heslo: <input style="margin-left: 1px" type="password" name="heslo" placeholder="Zadejte heslo"/>
            </p>
            <p>Jméno: <input style="margin-left: 23px" type="text" name="jmeno" placeholder="Zadejte jméno"/></p>
            <p>Příjmení: <input style="margin-left: 12px" type="text" name="prijmeni" placeholder="Zadejte příjmení"/>
            </p>
			<p>Email: <input style="margin-left: 31px" type="email" name="email" placeholder="Zadejte email"/></p>

            <p><input name="submit" type="submit" value="Insert"/></p>

        </form>
        <?php } ?>
    </div>
</div>