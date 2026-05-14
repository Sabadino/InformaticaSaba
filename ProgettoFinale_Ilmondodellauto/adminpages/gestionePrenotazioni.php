<?php
$pdo = DBHandler::getPDO();

// prendo tutte le prenotazioni con dati utente e auto
$sql = "SELECT prenotazione.*, utente.Nome, utente.Cognome, macchina.Marca, macchina.Modello FROM prenotazione JOIN utente ON prenotazione.ID_Utente = utente.ID JOIN macchina ON prenotazione.ID_Macchina = macchina.ID ORDER BY prenotazione.ID DESC";
$sth = $pdo->prepare($sql);
$sth->execute();
$prenotazioni = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/admin.css">

<div class="container-wrap">

    <h2>Prenotazioni</h2>

    <br>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Auto</th>
                <th>Tipo</th>
                <th>Data</th>
                <th>Stato</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($prenotazioni as $p) { ?>
            <tr>
                <td><?php echo $p['Nome'] . ' ' . $p['Cognome']; ?></td>
                <td><?php echo $p['Marca'] . ' ' . $p['Modello']; ?></td>
                <td><?php echo $p['TipoPrenotazione']; ?></td>
                <td><?php echo $p['DataOraPrenotazione']; ?></td>
                <td><?php echo $p['Stato']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

</body>
</html>