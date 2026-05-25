<?php
session_start();
require 'db.php';

if (isset($_POST['login'])) {
    $jmeno = trim($_POST['jmeno']);
    $heslo = $_POST['heslo'];
    $stmt = mysqli_prepare($DB, "SELECT id, heslo FROM uzivatel WHERE jmeno = ?");
    mysqli_stmt_bind_param($stmt, "s", $jmeno);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($heslo, $user['heslo'])) {
        $_SESSION['uzivatel_id'] = $user['id'];
        header("Location: rezervace.php");
        exit();
    } else {
        die("Neplatné jméno nebo heslo. <a href='prihlaseni.php'>Zpět na přihlášení</a>");
    }
}
?>