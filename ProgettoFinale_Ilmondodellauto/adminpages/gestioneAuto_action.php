<?php
session_start();
require_once('../include/DBHandler.php');

$pdo = DBHandler::getPDO();

if (isset($_POST['azione']) && $_POST['azione'] == 'aggiungi') {

    // sanificazione dati
    $marca = htmlspecialchars($_POST['marca']);
    $modello = htmlspecialchars($_POST['modello']);
    $anno = htmlspecialchars($_POST['anno']);
    $cilindrata = htmlspecialchars($_POST['cilindrata']);
    $potenzakw = htmlspecialchars($_POST['potenzakw']);
    $cavalli = htmlspecialchars($_POST['cavalli']);
    $km = htmlspecialchars($_POST['chilometraggio']);
    $carrozzeria = htmlspecialchars($_POST['carrozzeria']);
    $interni = htmlspecialchars($_POST['coloreinterni']);
    $targa = htmlspecialchars($_POST['targa']);
    $prezzo = htmlspecialchars($_POST['prezzo']);
    $neo = htmlspecialchars($_POST['neopatentati']);
    $descrizione = htmlspecialchars($_POST['descrizione']);

    // inserisco la nuova auto
    $sql = "INSERT INTO macchina (Marca, Modello, Anno, Cilindrata, PotenzaKw, Cavalli, Chilometraggio, Carrozzeria, ColoreInterni, TipoVeicolo, Targa, Prezzo, Neopatentati, Descrizione) VALUES ('$marca', '$modello', '$anno', '$cilindrata', '$potenzakw', '$cavalli', '$km', '$carrozzeria', '$interni', 'Usato', '$targa', '$prezzo', '$neo', '$descrizione')";
    $pdo->exec($sql);

    header('Location: gestioneAuto.php?successo=1');
    exit();
}

if (isset($_GET['azione']) && $_GET['azione'] == 'elimina') {
    $id = $_GET['id'];

    // elimino auto - la cascade elimina anche foto e prenotazioni
    $sql = "DELETE FROM macchina WHERE ID = '$id'";
    $pdo->exec($sql);

    header('Location: gestioneAuto.php?successo=1');
    exit();
}