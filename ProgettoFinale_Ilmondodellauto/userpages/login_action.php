<?php
session_start();
require_once('../include/DBHandler.php');

$email = $_POST['email'];
$password = $_POST['password'];

$db = DBHandler::getPDO();

$stmt = $db->prepare("SELECT * FROM utente WHERE Email = ?");
$stmt->execute([$email]);
$utente = $stmt->fetch();

if ($utente && password_verify($password, $utente['Password'])) {
    $_SESSION['utente_id'] = $utente['ID'];
    $_SESSION['utente_nome'] = $utente['Nome'];
    $_SESSION['utente_ruolo'] = $utente['Ruolo'];
    header('Location: catalogo.php');
    exit();
} else {
    header('Location: login.php?errore=1');
    exit();
}