<?php
// prendo il nome della pagina attuale es. catalogo.php
// serve per evidenziare il link attivo nella navbar
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/navbar.css">
    <title>Il Mondo dell'Auto</title>
</head>
<body>

<nav class="navbar-sito">

    <div class="navbar-logo">
        <!-- logo cliccabile che porta alla home -->
        <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/index.php">Il Mondo <em>dell'Auto</em></a>
    </div>

    <div class="navbar-links">
        <!-- se sono su catalogo aggiungo classe attivo per evidenziarlo -->
        <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/catalogo.php" class="<?= ($current_page == 'catalogo.php') ? 'attivo' : '' ?>">Catalogo</a>
        <a href="#">Chi siamo</a>
        <a href="#">Contatti</a>
    </div>

    <div class="navbar-utente">

        <?php if (isset($_SESSION['utente_id'])) { ?>
            <!-- sei loggato - mostro prenotazioni, nome e esci -->
            <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/miePrenotazioni.php">Prenotazioni</a>
            <span class="saluto">Ciao, <?php echo $_SESSION['utente_nome'] ?></span>
            <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/logout.php" class="btn-esci">Esci</a>

        <?php } else { ?>
            <!-- non sei loggato - mostro bottone accedi -->
            <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/login.php" style="background-color:#1C3829; color:white; padding:7px 16px; border-radius:6px; text-decoration:none; font-size:13px;">Accedi</a>

        <?php } ?>

    </div>

</nav>