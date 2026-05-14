<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/navbar.css">
    <title>Il Mondo dell'Auto - Admin</title>
</head>
<body>

<nav class="navbar-sito navbar-admin">

    <div class="navbar-logo">
        <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/index.php">Il Mondo <em>dell'Auto</em></a>
        <span>Admin</span>
    </div>

    <div class="navbar-links">
        <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/adminpages/gestioneAuto.php" class="<?= ($current_page == 'gestioneAuto.php') ? 'attivo' : '' ?>">Gestione Auto</a>
        <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/adminpages/gestionePrenotazioni.php" class="<?= ($current_page == 'gestionePrenotazioni.php') ? 'attivo' : '' ?>">Prenotazioni</a>
    </div>

    <div class="navbar-utente">
        <span class="saluto">Ciao, <?php echo $_SESSION['utente_nome'] ?></span>
        <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/logout.php" class="btn-esci">Esci</a>
    </div>

</nav>