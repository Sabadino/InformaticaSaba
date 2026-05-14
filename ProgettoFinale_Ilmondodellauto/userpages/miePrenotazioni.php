<?php
$pdo = DBHandler::getPDO();

// prendo prenotazioni dell'utente con i dati dell'auto
$sql = "SELECT prenotazione.*, macchina.Marca, macchina.Modello, macchina.Anno FROM prenotazione JOIN macchina ON prenotazione.ID_Macchina = macchina.ID WHERE prenotazione.ID_Utente = '$_SESSION[utente_id]' ORDER BY prenotazione.ID DESC";
$sth = $pdo->prepare($sql);
$sth->execute();
$prenotazioni = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/prenotazioni.css">

<div class="container-wrap">

    <h2>Le mie prenotazioni</h2>

    <br>

    <?php if (count($prenotazioni) == 0) { ?>
        <p>Non hai ancora nessuna prenotazione. <a href="catalogo.php">Sfoglia il catalogo</a></p>
    <?php } else { ?>
        <?php foreach ($prenotazioni as $p) { ?>
            <div class="prenotazione-card">
                <h4><?php echo $p['Marca'] . ' ' . $p['Modello'] . ' · ' . $p['Anno']; ?></h4>
                <p><?php echo $p['TipoPrenotazione']; ?></p>
                <p><?php echo $p['DataOraPrenotazione']; ?></p>
                <p><?php echo $p['Stato']; ?></p>
            </div>
            <br>
        <?php } ?>
    <?php } ?>

</div>

</body>
</html>