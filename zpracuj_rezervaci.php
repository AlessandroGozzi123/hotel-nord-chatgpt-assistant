<?php
session_start();
require 'db.php';

if (!isset($_SESSION['uzivatel_id'])) {
    die("Musíte se nejdříve přihlásit. <a href='prihlaseni.php'>Přihlásit se</a>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uzivatel_id = $_SESSION['uzivatel_id'];
    $typ_pokoje = $_POST['typ_pokoje'];
    $datum_prijezdu = $_POST['datum_prijezdu'];
    $datum_odjezdu = $_POST['datum_odjezdu'];
    $pocet_osob = $_POST['pocet_osob'];

    $vecere = isset($_POST['vecere']) ? 1 : 0;
    $parkovani = isset($_POST['parkovani']) ? 1 : 0;
    $mazlicek = isset($_POST['mazlicek']) ? 1 : 0;
    $wellness = isset($_POST['wellness']) ? 1 : 0;

    $stmt = mysqli_prepare($DB, "INSERT INTO rezervace 
        (uzivatel_id, typ_pokoje, datum_prijezdu, datum_odjezdu, pocet_osob, vecere, parkovani, mazlicek, wellness) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
    mysqli_stmt_bind_param($stmt, "isssiiiii", $uzivatel_id, $typ_pokoje, $datum_prijezdu, $datum_odjezdu, $pocet_osob, $vecere, $parkovani, $mazlicek, $wellness);
        
    if (mysqli_stmt_execute($stmt)) {
        header("Location: rezervace.php");
        exit();
    } else {
        echo "Chyba při odesílání rezervace.";
    }
}
?>