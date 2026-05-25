<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require 'db.php';

if (isset($_POST['register'])) {
    $jmeno = trim($_POST['jmeno']);
    $heslo = $_POST['heslo'];
    $hashed_password = password_hash($heslo, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($DB, "SELECT id FROM uzivatel WHERE jmeno = ?");

    mysqli_stmt_bind_param($stmt, "s", $jmeno);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) > 0) {
        die("Uživatel s tímto jménem již existuje. <a href='prihlaseni.php'>Zpět</a>");
    }
    mysqli_stmt_close($stmt);

    $stmt = mysqli_prepare($DB, "INSERT INTO uzivatel (jmeno, heslo) VALUES (?, ?)");
    if (!$stmt) {
        die("Chyba v SQL dotazu (INSERT): " . mysqli_error($DB));
    }

    mysqli_stmt_bind_param($stmt, "ss", $jmeno, $hashed_password);
    if (mysqli_stmt_execute($stmt)) {
        $user_id = mysqli_insert_id($DB);
        $_SESSION['uzivatel_id'] = $user_id;
        
        header("Location: rezervace.php");
        exit();
    } else {
        echo "Došlo k chybě při registraci.";
    }
}
?>