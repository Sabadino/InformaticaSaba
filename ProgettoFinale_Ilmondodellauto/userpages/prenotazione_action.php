<?php
session_start();
require_once('../include/DBHandler.php');

$pdo = DBHandler::getPDO();
$id_utente = $_SESSION['utente_id'];
$id_macchina = $_POST['id_macchina'];
$tipo = $_POST['tipo'];
$data = $_POST['data'];

try {
    $query = $pdo->prepare("INSERT INTO prenotazione (ID_Utente, ID_Macchina, TipoPrenotazione, DataOraPrenotazione) VALUES (:utente, :macchina, :tipo, :data)");
    $query->execute([
        'utente' => $id_utente,
        'macchina' => $id_macchina,
        'tipo' => $tipo,
        'data' => $data
    ]);
    header('Location: miePrenotazioni.php');
} catch(PDOException $e) {
    header('Location: prenotazione.php?id=' . $id_macchina . '&errore=1');
}