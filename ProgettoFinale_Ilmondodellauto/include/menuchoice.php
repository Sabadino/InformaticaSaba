<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$json = file_get_contents('../include/pages.json');
$obj = json_decode($json);
$pageName = basename($_SERVER['PHP_SELF']);

if (isset($obj->DBPages) && in_array($pageName, $obj->DBPages)) {
    require_once '../include/DBHandler.php';
}

if (in_array($pageName, $obj->loggedInPages)) {
    if (!isset($_SESSION['utente_id'])) {
        header('Location: /InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/login.php');
        exit();
    }
}

if (in_array($pageName, $obj->adminpages)) {
    include '../include/adminNavbar.php';
} elseif (in_array($pageName, $obj->userpages)) {
    include '../include/navbar.php';
}