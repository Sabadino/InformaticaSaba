<?php
session_start();
require_once('../include/DBHandler.php');

$db = DBHandler::getPDO();

// aggiungi auto
if (isset($_POST['azione']) && $_POST['azione'] == 'aggiungi') {

    $sql = "INSERT INTO macchina (Marca, Modello, Anno, Cilindrata, PotenzaKw, Cavalli, Chilometraggio, Carrozzeria, ColoreInterni, TipoVeicolo, Targa, Prezzo, Neopatentati, Descrizione)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Usato', ?, ?, ?, ?)";

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute([
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

        $idAuto = $db->lastInsertId();

        // carico la foto se c'è
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $nomeFile = $_FILES['foto']['name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], '../uploads/' . $nomeFile);
            $db->prepare("INSERT INTO macchina_immagini (ID_Macchina, URL, Ordine) VALUES (?, ?, 0)")
               ->execute([$idAuto, 'uploads/' . $nomeFile]);
        }

        header('Location: gestioneAuto.php?successo=1');
        exit();

    } catch (PDOException $e) {
        header('Location: gestioneAuto.php?errore=1');
        exit();
    }
}

// elimina auto
if (isset($_GET['azione']) && $_GET['azione'] == 'elimina') {
    $db->prepare("DELETE FROM macchina WHERE ID = ?")->execute([$_GET['id']]);
    header('Location: gestioneAuto.php?successo=1');
    exit();
}