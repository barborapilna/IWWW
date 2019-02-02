<h1>Odhlásit</h1>

<?php
$_SESSION["id_uzivatele"] = "";
$_SESSION["login"] = "";
$_SESSION["email"] = "";
$_SESSION["jmeno"] = "";
$_SESSION["prijmeni"] = "";
$_SESSION["role"] = "";

header("Location:" . BASE_URL);
?>