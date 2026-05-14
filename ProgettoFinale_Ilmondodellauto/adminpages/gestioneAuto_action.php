<?php
// avvio la sessione
session_start();

// carico dbhandler
require_once('../include/DBHandler.php');

// prendo la connessione
$db = DBHandler::getPDO();

// aggiungi auto
if (isset($_POST['azione']) && $_POST['azione'] == 'aggiungi') {

    try {
        // inserisco la nuova auto nel database
        // tutte le auto sono usate quindi TipoVeicolo = Usato fisso
        $db->prepare("INSERT INTO macchina (Marca, Modello, Anno, Cilindrata, PotenzaKw, Cavalli, Chilometraggio, Carrozzeria, ColoreInterni, TipoVeicolo, Targa, Prezzo, Neopatentati, Descrizione) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Usato', ?, ?, ?, ?)")
           ->execute([
                $_POST['marca'],
                $_POST['modello'],
                $_POST['anno'],
                $_POST['cilindrata'],
                $_POST['potenzakw'],
                $_POST['cavalli'],
                $_POST['chilometraggio'],
                $_POST['carrozzeria'],
                $_POST['coloreinterni'],
                $_POST['targa'],
                $_POST['prezzo'],
                $_POST['neopatentati'],
                $_POST['descrizione']
           ]);

        // operazione riuscita
        header('Location: gestioneAuto.php?successo=1');
        exit();

    } catch (PDOException $e) {
        // errore - probabilmente targa già esistente
        header('Location: gestioneAuto.php?errore=1');
        exit();
    }
}

// elimina auto
if (isset($_GET['azione']) && $_GET['azione'] == 'elimina') {

    // elimino l'auto con quell'id
    // grazie alla CASCADE nel db si eliminano anche foto e prenotazioni collegate
    $db->prepare("DELETE FROM macchina WHERE ID = ?")
       ->execute([$_GET['id']]);

    header('Location: gestioneAuto.php?successo=1');
    exit();
}