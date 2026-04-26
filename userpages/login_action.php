<?php
session_start();
require_once('../include/DBHandler.php');

$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);

$sql = "SELECT ID, Nome, Password, Ruolo FROM utente WHERE Email = :email";
$sth = DBHandler::getPDO()->prepare($sql);
$sth->bindParam('email', $email, PDO::PARAM_STR);
$sth->execute();

if ($sth->rowCount() > 0) {
    $utente = $sth->fetch();
    if (password_verify($password, $utente['Password'])) {
        $_SESSION['utente_id'] = $utente['ID'];
        $_SESSION['utente_nome'] = $utente['Nome'];
        $_SESSION['utente_ruolo'] = $utente['Ruolo'];
        header('Location: catalogo.php');
    } else {
        header('Location: login.php?errore=1');
    }
} else {
    header('Location: login.php?errore=1');
}