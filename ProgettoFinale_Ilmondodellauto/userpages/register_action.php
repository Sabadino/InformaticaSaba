<?php
// avvio la sessione
session_start();

// carico dbhandler
require_once('../include/DBHandler.php');

// prendo la connessione
$db = DBHandler::getPDO();

// cripto la password prima di salvarla nel database
// PASSWORD_DEFAULT usa bcrypt che è sicuro
$passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

// provo a inserire il nuovo utente nel database
try {

    // inserisco tutti i dati nel database
    // uso ? come segnaposto per ogni valore
    $stmt = $db->prepare("INSERT INTO utente (Nome, Cognome, Username, Email, Telefono, Password) VALUES (?, ?, ?, ?, ?, ?)");

    // eseguo passando i valori in ordine
    $stmt->execute([
        $_POST['nome'],
        $_POST['cognome'],
        $_POST['username'],
        $_POST['email'],
        $_POST['telefono'],
        $passwordHash
    ]);

    // prendo l'id del nuovo utente appena inserito
    $nuovoId = $db->lastInsertId();

    // faccio il login automatico salvando i dati in sessione
    $_SESSION['utente_id'] = $nuovoId;
    $_SESSION['utente_nome'] = $_POST['nome'];
    $_SESSION['utente_ruolo'] = 'utente';

    // mando al catalogo
    header('Location: catalogo.php');
    exit();

} catch (PDOException $e) {
    // se c'è un errore tipo email già esistente rimando con errore
    header('Location: register.php?errore=1');
    exit();
}