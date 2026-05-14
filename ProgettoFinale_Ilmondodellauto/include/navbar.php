<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/navbar.css">
    <title>Il Mondo dell'Auto</title>
</head>
<body>

<nav class="navbar-sito">

    <div class="navbar-logo">
        <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/index.php">Il Mondo <em>dell'Auto</em></a>
    </div>

    <div class="navbar-links">
        <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/catalogo.php" class="<?= ($current_page == 'catalogo.php') ? 'attivo' : '' ?>">Catalogo</a>
        <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/chiSiamo.php" class="<?= ($current_page == 'chiSiamo.php') ? 'attivo' : '' ?>">Chi siamo</a>
        <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/contatti.php" class="<?= ($current_page == 'contatti.php') ? 'attivo' : '' ?>">Contatti</a>
    </div>

    <div class="navbar-utente">
        <?php if (isset($_SESSION['utente_id'])) { ?>
            <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/miePrenotazioni.php">Prenotazioni</a>
            <span class="saluto">Ciao, <?php echo $_SESSION['utente_nome'] ?></span>
            <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/logout.php" class="btn-esci">Esci</a>
        <?php } else { ?>
            <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/login.php" style="background-color:#1C3829; color:white; padding:7px 16px; border-radius:6px; text-decoration:none; font-size:13px;">Accedi</a>
        <?php } ?>
    </div>

</nav>