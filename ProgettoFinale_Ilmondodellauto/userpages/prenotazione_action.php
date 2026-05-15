<?php
session_start();
require_once('../include/DBHandler.php');

$pdo = DBHandler::getPDO();

$idMacchina = htmlspecialchars($_POST['id_macchina']);
$tipo = htmlspecialchars($_POST['tipo']);
$idUtente = $_SESSION['utente_id'];

// per la data
$data = date('Y-m-d H:i:s');

// inserisco prenotazione
$sql = "INSERT INTO prenotazione (ID_Utente, ID_Macchina, TipoPrenotazione, DataOraPrenotazione) VALUES ('$idUtente', '$idMacchina', '$tipo', '$data')";
$pdo->exec($sql);

header('Location: miePrenotazioni.php');
exit();