<?php

// avvio la sessione solo se non è già partita
if (session_status() === PHP_SESSION_NONE) session_start();

// leggo il file pages.json che contiene la lista delle pagine
$json = file_get_contents('../include/pages.json');

// converto il json in oggetto php
$obj = json_decode($json);

// prendo il nome della pagina attuale es. catalogo.php
$pageName = basename($_SERVER['PHP_SELF']);

// se la pagina usa il database carico DBHandler
if (in_array($pageName, $obj->DBPages)) {
    require_once '../include/DBHandler.php';
}

// se la pagina richiede login controllo la sessione
if (in_array($pageName, $obj->loggedInPages)) {

    // se non sei loggato ti mando al login
    if (!isset($_SESSION['utente_id'])) {
        header('Location: /InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/login.php');
        exit();
    }
}

// carico la navbar giusta in base al tipo di pagina
if (in_array($pageName, $obj->adminpages)) {
    // pagina admin - carico navbar admin
    include '../include/adminNavbar.php';
} elseif (in_array($pageName, $obj->userpages)) {
    // pagina utente - carico navbar normale
    include '../include/navbar.php';
}