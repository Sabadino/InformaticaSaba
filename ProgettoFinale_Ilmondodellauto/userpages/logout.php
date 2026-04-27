<?php
session_start();
session_destroy();
header('Location: /ProgettoFinale_Ilmondodellauto/userpages/login.php');
exit;
?>