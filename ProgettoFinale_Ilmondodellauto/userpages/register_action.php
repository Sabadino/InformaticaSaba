<?php
session_start();
require_once('../include/DBHandler.php');

$db = DBHandler::getPDO();

$passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO utente (Nome, Cognome, Username, Email, Telefono, Password) VALUES (?, ?, ?, ?, ?, ?)";

try {
    $stmt = $db->prepare($sql);
    $stmt->execute([
        $_POST['nome'],
        $_POST['cognome'],
        $_POST['username'],
        $_POST['email'],
        $_POST['telefono'],
        $passwordHash
    ]);

    $nuovoId = $db->lastInsertId();
    $_SESSION['utente_id'] = $nuovoId;
    $_SESSION['utente_nome'] = $_POST['nome'];
    $_SESSION['utente_ruolo'] = 'utente';

    header('Location: catalogo.php');
    exit();

} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        header('Location: register.php?errore=1');
        exit();
    }
}