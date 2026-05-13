<?php
session_start();

$_SESSION = array();

session_destroy();

header('Location: /InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/login.php');
exit();