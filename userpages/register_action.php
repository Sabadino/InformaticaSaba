<?php
session_start();
require_once('../include/DBHandler.php');

$nome = htmlspecialchars($_POST['nome']);
$cognome = htmlspecialchars($_POST['cognome']);
$username = htmlspecialchars($_POST['username']);
$email = htmlspecialchars($_POST['email']);
$telefono = htmlspecialchars($_POST['telefono']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

try {
    $sql = "INSERT INTO utente (Nome, Cognome, Username, Email, Telefono, Password) 
            VALUES (:nome, :cognome, :username, :email, :telefono, :password)";
    $sth = DBHandler::getPDO()->prepare($sql);
    $sth->execute([
        'nome' => $nome,
        'cognome' => $cognome,
        'username' => $username,
        'email' => $email,
        'telefono' => $telefono,
        'password' => $password
    ]);

    // login automatico dopo registrazione
    $id = DBHandler::getPDO()->lastInsertId();
    $_SESSION['utente_id'] = $id;
    $_SESSION['utente_nome'] = $nome;
    $_SESSION['utente_ruolo'] = 'utente';

    header('Location: catalogo.php');

} catch (PDOException $e) {
    // email o username già in uso
    header('Location: register.php?errore=1');
}