<?php
session_start();
require_once('../include/DBHandler.php');

$db = DBHandler::getPDO();

$sql = "INSERT INTO prenotazione (ID_Utente, ID_Macchina, TipoPrenotazione, DataOraPrenotazione) VALUES (?, ?, ?, ?)";

try {
    $stmt = $db->prepare($sql);
    $stmt->execute([
        $_SESSION['utente_id'],
        $_POST['id_macchina'],
        $_POST['tipo'],
        $_POST['data']
    ]);
    header('Location: miePrenotazioni.php');
    exit();
} catch (PDOException $e) {
    header('Location: prenotazione.php?id=' . $_POST['id_macchina'] . '&errore=1');
    exit();
}