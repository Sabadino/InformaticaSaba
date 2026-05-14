<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Mondo dell'Auto - Mestre</title>
    <link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/navbar.css">
    <link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/index.css">
</head>
<body>

<?php include 'include/navbar.php'; ?>

<div class="hero">
    <img src="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/bg.jpg" alt="auto" class="hero-img">
    <div class="hero-overlay">
        <p class="hero-etichetta">Concessionario certificato · Mestre, Venezia</p>
        <h1>Il Mondo <em>dell'Auto</em></h1>
        <p class="hero-sub">Dal 2005 aiutiamo i clienti di Mestre a trovare l'auto usata giusta.</p>
        <a href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/catalogo.php" class="btn-catalogo">Sfoglia il catalogo →</a>
    </div>
</div>

<div class="img-pausa">
    <img src="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/bg3.jpg" alt="">
</div>

<div class="sezione-contatti">
    <div class="contatti-grid">
        <div>
            <p class="etichetta">Dove siamo</p>
            <h2>Vieni a trovarci</h2>
            <p>Via Orlanda 45/G, Campalto Venezia</p>
            <br>
            <a href="tel:+393802074281" class="link-verde">+39 380 207 4281</a>
            <a href="https://wa.me/393802074281" target="_blank" class="link-verde">WhatsApp</a>
            <a href="mailto:hadikhammoud667@gmail.com" class="link-verde">hadikhammoud667@gmail.com</a>
        </div>
        <div>
            <p class="etichetta">Orari</p>
            <h2>Quando siamo aperti</h2>
            <table class="orari-table">
                <tr><td>Lun - Ven</td><td>8:30 - 12:30 / 14:30 - 19:30</td></tr>
                <tr><td>Sabato</td><td>8:30 - 12:30 / 14:30 - 17:30</td></tr>
                <tr><td>Domenica</td><td>Chiuso</td></tr>
            </table>
        </div>
    </div>
</div>

<div class="sezione-loghi">
    <p class="etichetta-loghi">I marchi che trattiamo</p>
    <div class="loghi-grid">
        <img src="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/Loghi/logoaudi.png" alt="Audi">
        <img src="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/Loghi/logobmw.png" alt="BMW">
        <img src="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/Loghi/logomercedes.png" alt="Mercedes">
        <img src="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/Loghi/logovw.png" alt="Volkswagen">
    </div>
</div>

</body>
</html>