<?php
session_start();
session_destroy();
header('Location: /InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/login.php');
exit;
?>