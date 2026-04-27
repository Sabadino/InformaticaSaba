<?php
// navbar per le pagine admin
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/ProgettoFinale_Ilmondodellauto/style/style.css">
    <title>Il Mondo dell'Auto — Admin</title>
</head>
<body>

<nav class="navbar navbar-expand-lg admin-nav">
    <div class="container-fluid px-4">

        <a class="navbar-brand" href="/ProgettoFinale_Ilmondodellauto/index.php">
            Il Mondo <em>dell'Auto</em> <span class="admin-badge">ADMIN</span>
        </a>

        <div class="navbar-nav mx-auto">
            <a class="nav-link" href="/ProgettoFinale_Ilmondodellauto/adminpages/gestioneAuto.php">Gestione Auto</a>
            <a class="nav-link" href="/ProgettoFinale_Ilmondodellauto/adminpages/gestionePrenotazioni.php">Prenotazioni</a>
        </div>

        <div class="d-flex gap-2 align-items-center">
            <span class="nav-username"><?= $_SESSION['utente_nome'] ?></span>
            <a href="/ProgettoFinale_Ilmondodellauto/userpages/logout.php" class="btn-login">Esci</a>
        </div>

    </div>
</nav>