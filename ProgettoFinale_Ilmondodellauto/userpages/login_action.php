<?php
session_start();
require_once('../include/DBHandler.php');

$email = htmlspecialchars($_POST['email']);
$password = $_POST['password'];

$query = DBHandler::getPDO()->prepare("SELECT * FROM utente WHERE Email = :email");
$query->execute(['email' => $email]);
$utente = $query->fetch();

if($utente && password_verify($password, $utente['Password'])){
    $_SESSION['utente_id'] = $utente['ID'];
    $_SESSION['utente_nome'] = $utente['Nome'];
    $_SESSION['utente_ruolo'] = $utente['Ruolo'];
    header('Location: catalogo.php');
} else {
    header('Location: login.php?errore=1');
}