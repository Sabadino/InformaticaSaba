<?php
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

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid px-4">

        <a class="navbar-brand" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/index.php">
            Il Mondo <em>dell'Auto</em>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <div class="navbar-nav mx-auto">
                <a class="nav-link" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/catalogo.php">Catalogo</a>
                <a class="nav-link" href="#">Chi siamo</a>
                <a class="nav-link" href="#">Contatti</a>
            </div>

            <div class="d-flex gap-2 align-items-center">
                <?php if(isset($_SESSION['utente_id'])): ?>
                    <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/miePrenotazioni.php" class="btn-wish">Prenotazioni</a>
                    <span class="nav-username"><?= $_SESSION['utente_nome'] ?></span>
                    <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/logout.php" class="btn-login">Esci</a>
                <?php else: ?>
                    <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/login.php" class="btn-login">Accedi</a>
                <?php endif; ?>
            </div>
        </div>

    </div>
</nav>