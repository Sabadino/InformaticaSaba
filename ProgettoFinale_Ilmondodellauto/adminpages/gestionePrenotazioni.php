<?php
// prendo la connessione al database
$db = DBHandler::getPDO();

// se l'admin ha salvato un nuovo stato aggiorno il database
if (isset($_POST['cambio_stato'])) {

    // aggiorno lo stato della prenotazione
    $db->prepare("UPDATE prenotazione SET Stato = ? WHERE ID = ?")
       ->execute([$_POST['stato'], $_POST['id_prenotazione']]);

    // rimando alla stessa pagina con messaggio successo
    header("Location: gestionePrenotazioni.php?successo=1");
    exit;
}

// prendo tutte le prenotazioni con i dati dell'utente e dell'auto
// faccio due join - uno con utente e uno con macchina
$stmt = $db->query("SELECT prenotazione.*, utente.Nome, utente.Cognome, macchina.Marca, macchina.Modello 
    FROM prenotazione 
    JOIN utente ON prenotazione.ID_Utente = utente.ID 
    JOIN macchina ON prenotazione.ID_Macchina = macchina.ID 
    ORDER BY prenotazione.DataOraPrenotazione DESC");

$prenotazioni = $stmt->fetchAll();
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/admin.css">

<div class="container mt-4">

    <h2>Gestione Prenotazioni</h2>

    <br>

    <?php
    // messaggio di successo
    if (isset($_GET['successo'])) echo "<div class='alert-successo'>Stato aggiornato.</div>";
    ?>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Auto</th>
                <th>Tipo</th>
                <th>Data</th>
                <th>Stato</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        // ciclo su ogni prenotazione
        foreach ($prenotazioni as $p) { ?>
            <tr>
                <td><?= $p['Nome'] . " " . $p['Cognome'] ?></td>
                <td><?= $p['Marca'] . " " . $p['Modello'] ?></td>
                <td><?= $p['TipoPrenotazione'] ?></td>
                <td><?= date('d/m/Y H:i', strtotime($p['DataOraPrenotazione'])) ?></td>
                <td><?= $p['Stato'] ?></td>
                <td>
                    <!-- form per cambiare lo stato della prenotazione -->
                    <form method="POST" style="display:flex; gap:6px">

                        <!-- passo l'id della prenotazione nascosto -->
                        <input type="hidden" name="id_prenotazione" value="<?= $p['ID'] ?>">

                        <!-- select con gli stati possibili -->
                        <!-- quello attuale è già selezionato -->
                        <select name="stato">
                            <option value="In attesa" <?= $p['Stato'] == 'In attesa' ? 'selected' : '' ?>>In attesa</option>
                            <option value="Confermata" <?= $p['Stato'] == 'Confermata' ? 'selected' : '' ?>>Confermata</option>
                            <option value="Annullata" <?= $p['Stato'] == 'Annullata' ? 'selected' : '' ?>>Annullata</option>
                            <option value="Completata" <?= $p['Stato'] == 'Completata' ? 'selected' : '' ?>>Completata</option>
                        </select>

                        <button type="submit" name="cambio_stato" class="btn-salva">Salva</button>

                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

</body>
</html>