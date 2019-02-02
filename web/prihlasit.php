<?php
if (!empty($_POST) && !empty($_POST["login"]) && !empty($_POST["heslo"])) {

    $stmt = $conn->prepare("SELECT * FROM ucet_uzivatele WHERE login = :login AND heslo = :heslo");
    $stmt->bindParam(':login', $_POST["login"]);
    $stmt->bindParam(':heslo', $_POST["heslo"]);
    $stmt->execute();
    $user = $stmt->fetch();
    if (!$user) {
        echo "Uživatel nenalezen";
    } else {
        $_SESSION["id_uzivatele"] = $user["id_uzivatele"];
        $_SESSION["login"] = $user["login"];
        $_SESSION["email"] = $user["email_uzivatele"];
        $_SESSION["jmeno"] = $user["jmeno_uzivatele"];
        $_SESSION["prijmeni"] = $user["prijmeni_uzivatele"];
        $_SESSION["role"] = $user["role_uzivatele"];

        header("Location:" . BASE_URL);
    }

} else if (!empty($_POST)) {
    echo "Neplatný email nebo heslo";
}

?>

<form method="post">
    <input type="text" name="login" placeholder="Zadejte svůj login">
    <input type="password" name="heslo" placeholder="Zadejte heslo">
    <input type="submit" value="Přihlásit">
</form>