<?php
// avvio la sessione per poter salvare i dati utente
session_start();

// carico il file che gestisce la connessione al database
require_once('../include/DBHandler.php');

// prendo la connessione al database
$db = DBHandler::getPDO();

// prendo email e password dal form
$email = $_POST['email'];
$password = $_POST['password'];

// cerco l'utente nel database con quella email
$stmt = $db->prepare("SELECT * FROM utente WHERE Email = ?");

// eseguo la query passando l'email
$stmt->execute([$email]);

// prendo il risultato
$utente = $stmt->fetch();

// controllo se l'utente esiste e se la password è giusta
if ($utente && password_verify($password, $utente['Password'])) {

    // login ok - salvo i dati in sessione
    $_SESSION['utente_id'] = $utente['ID'];
    $_SESSION['utente_nome'] = $utente['Nome'];
    $_SESSION['utente_ruolo'] = $utente['Ruolo'];

    // se è admin lo mando alla gestione auto
    // altrimenti lo mando al catalogo
    if ($utente['Ruolo'] == 'admin') {
        header('Location: /InformaticaSaba/ProgettoFinale_Ilmondodellauto/adminpages/gestioneAuto.php');
    } else {
        header('Location: catalogo.php');
    }
    exit();

} else {
    // credenziali sbagliate - rimando al login con errore
    header('Location: login.php?errore=1');
    exit();
}