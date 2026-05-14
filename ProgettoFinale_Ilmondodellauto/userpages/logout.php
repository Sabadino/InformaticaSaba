<?php
// avvio la sessione per poterla modificare
session_start();

// svuoto tutti i dati della sessione
// cancello utente_id, utente_nome, utente_ruolo ecc.
$_SESSION = array();

// distruggo la sessione sul server
session_destroy();

// rimando al login
header("Location: /InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/login.php");
exit();