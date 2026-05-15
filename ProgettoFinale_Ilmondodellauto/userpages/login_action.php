<?php
session_start();
require_once('../include/DBHandler.php');

$pdo = DBHandler::getPDO();

$email = htmlspecialchars($_POST['email']);
$password = $_POST['password'];

$sql = "SELECT * FROM utente WHERE Email = :email";
$sth = $pdo->prepare($sql);
$sth->bindParam(':email', $email, PDO::PARAM_STR);
$sth->execute();
$utente = $sth->fetch(PDO::FETCH_ASSOC);

if ($utente) {
    // confronto password inserita con quella criptata nel db
    if (password_verify($password, $utente['Password'])) {
        $_SESSION['utente_id'] = $utente['ID'];
        $_SESSION['utente_nome'] = $utente['Nome'];
        $_SESSION['utente_ruolo'] = $utente['Ruolo'];

        if ($utente['Ruolo'] == 'admin') {
            header('Location: /InformaticaSaba/ProgettoFinale_Ilmondodellauto/adminpages/gestioneAuto.php');
        } else {
            header('Location: catalogo.php');
        }
        exit();
    }
}

header('Location: login.php?errore=1');
exit();
