<?php
session_start();
require_once('../include/DBHandler.php');

$pdo = DBHandler::getPDO();

// sanificazione dati
$nome = htmlspecialchars($_POST['nome']);
$cognome = htmlspecialchars($_POST['cognome']);
$username = htmlspecialchars($_POST['username']);
$email = htmlspecialchars($_POST['email']);
$telefono = htmlspecialchars($_POST['telefono']);

// cript pass
$passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

// controllo se email o username esistono gia
$sth = $pdo->prepare("SELECT ID FROM utente WHERE Email = '$email' OR Username = '$username'");
$sth->execute();
$esiste = $sth->fetch(PDO::FETCH_ASSOC);

if ($esiste) {
    header('Location: register.php?errore=1');
    exit();
}

// inserisco utente
$sql = "INSERT INTO utente (Nome, Cognome, Username, Email, Telefono, Password) VALUES ('$nome', '$cognome', '$username', '$email', '$telefono', '$passwordHash')";
$pdo->exec($sql);

// login automatico
$nuovoId = $pdo->lastInsertId();
$_SESSION['utente_id'] = $nuovoId;
$_SESSION['utente_nome'] = $nome;
$_SESSION['utente_ruolo'] = 'utente';

header('Location: catalogo.php');
exit();