<?php
// avvio la sessione per leggere utente_id
session_start();

// carico dbhandler
require_once('../include/DBHandler.php');

// prendo la connessione
$db = DBHandler::getPDO();

// inserisco la prenotazione nel database
// prendo i dati dal form con $_POST e l'utente dalla sessione
try {

    $stmt = $db->prepare("INSERT INTO prenotazione (ID_Utente, ID_Macchina, TipoPrenotazione, DataOraPrenotazione) VALUES (?, ?, ?, ?)");

    $stmt->execute([
        $_SESSION['utente_id'],
        $_POST['id_macchina'],
        $_POST['tipo'],
        $_POST['data']
    ]);

    // prenotazione inserita - mando alle mie prenotazioni
    header('Location: miePrenotazioni.php');
    exit();

} catch (PDOException $e) {
    // qualcosa è andato storto - rimando con errore
    header('Location: prenotazione.php?id=' . $_POST['id_macchina'] . '&errore=1');
    exit();
}