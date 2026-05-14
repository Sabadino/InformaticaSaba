<?php
// prendo il nome della pagina attuale
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/navbar.css">
    <title>Il Mondo dell'Auto - Admin</title>
</head>
<body>

<nav class="navbar-sito navbar-admin">

    <div class="navbar-logo">
        <!-- logo che porta alla home -->
        <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/index.php">Il Mondo <em>dell'Auto</em></a>
        <span>Admin</span>
    </div>

    <div class="navbar-links">
        <!-- evidenzio la pagina attiva -->
        <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/adminpages/gestioneAuto.php" class="<?= ($current_page == 'gestioneAuto.php') ? 'attivo' : '' ?>">Gestione Auto</a>
        <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/adminpages/gestionePrenotazioni.php" class="<?= ($current_page == 'gestionePrenotazioni.php') ? 'attivo' : '' ?>">Prenotazioni</a>
    </div>

    <div class="navbar-utente">
        <!-- mostro il nome admin e il bottone esci -->
        <span class="saluto">Ciao, <?php echo $_SESSION['utente_nome'] ?></span>
        <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/logout.php" class="btn-esci">Esci</a>
    </div>

</nav>