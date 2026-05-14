<?php
// prendo la connessione al database
$db = DBHandler::getPDO();

// prendo tutte le prenotazioni dell'utente loggato
// faccio un join con macchina per avere marca e modello
$stmt = $db->prepare("SELECT prenotazione.*, macchina.Marca, macchina.Modello, macchina.Anno 
    FROM prenotazione 
    JOIN macchina ON prenotazione.ID_Macchina = macchina.ID 
    WHERE prenotazione.ID_Utente = ? 
    ORDER BY prenotazione.DataOraPrenotazione DESC");

$stmt->execute([$_SESSION['utente_id']]);
$prenotazioni = $stmt->fetchAll();
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/prenotazioni.css">

<div class="container mt-4">

    <h2>Le mie prenotazioni</h2>

    <br>

    <?php
    // se non ha prenotazioni mostro un messaggio
    if (count($prenotazioni) == 0) {
        echo "<p>Non hai ancora nessuna prenotazione. <a href='catalogo.php'>Sfoglia il catalogo</a></p>";
    } else {

        // ciclo su ogni prenotazione
        foreach ($prenotazioni as $p) {
            echo "
            <div class='prenotazione-card'>
                <h5>" . $p['Marca'] . " " . $p['Modello'] . " · " . $p['Anno'] . "</h5>
                <p>" . $p['TipoPrenotazione'] . "</p>
                <p>" . date('d/m/Y H:i', strtotime($p['DataOraPrenotazione'])) . "</p>
                <p>" . $p['Stato'] . "</p>
            </div>
            <br>";
        }
    }
    ?>

</div>

</body>
</html>