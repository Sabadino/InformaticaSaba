<?php
$db = DBHandler::getPDO();

// prendo le prenotazioni dell'utente loggato
$stmt = $db->prepare("SELECT p.*, m.Marca, m.Modello, m.Anno 
    FROM prenotazione p 
    JOIN macchina m ON p.ID_Macchina = m.ID 
    WHERE p.ID_Utente = ? 
    ORDER BY p.DataOraPrenotazione DESC");
$stmt->execute([$_SESSION['utente_id']]);
$prenotazioni = $stmt->fetchAll();
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/prenotazioni.css">

<div class="container mt-4">

    <h2>Le mie prenotazioni</h2>
    <p class="text-muted mb-4">Storico dei tuoi appuntamenti</p>

    <?php
    if (count($prenotazioni) == 0) {
        echo "<p>Non hai ancora nessuna prenotazione. <a href='catalogo.php'>Sfoglia il catalogo</a></p>";
    } else {
        foreach ($prenotazioni as $p) {
            echo "
            <div class='prenotazione-card mb-3'>
                <div class='d-flex justify-content-between align-items-start'>
                    <div>
                        <h5>" . $p['Marca'] . " " . $p['Modello'] . " · " . $p['Anno'] . "</h5>
                        <p class='text-muted mb-1'>" . $p['TipoPrenotazione'] . "</p>
                        <p class='text-muted mb-0'>" . date('d/m/Y H:i', strtotime($p['DataOraPrenotazione'])) . "</p>
                    </div>
                    <span class='stato-badge stato-" . strtolower(str_replace(' ', '-', $p['Stato'])) . "'>" . $p['Stato'] . "</span>
                </div>
            </div>";
        }
    }
    ?>

</div>

</body>
</html>