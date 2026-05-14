<?php
// se non c'è l'id nell'url rimando al catalogo
if (!isset($_GET['id'])) {
    header('Location: catalogo.php');
    exit;
}

// prendo la connessione al database
$db = DBHandler::getPDO();

// prendo l'id dall'url es. dettaglio.php?id=10
$id = $_GET['id'];

// prendo i dati dell'auto con quell'id
$stmt = $db->prepare("SELECT * FROM macchina WHERE ID = ?");
$stmt->execute([$id]);
$auto = $stmt->fetch();

// se l'auto non esiste rimando al catalogo
if (!$auto) {
    header('Location: catalogo.php');
    exit;
}

// prendo tutte le foto di questa auto in ordine
$stmtFoto = $db->prepare("SELECT URL FROM macchina_immagini WHERE ID_Macchina = ? ORDER BY Ordine");
$stmtFoto->execute([$id]);
$foto = $stmtFoto->fetchAll();

// prendo gli accessori di questa auto
// faccio un join tra accessori e macchina_accessori
$stmtAcc = $db->prepare("SELECT accessori.Nome FROM accessori JOIN macchina_accessori ON accessori.ID = macchina_accessori.ID_Accessorio WHERE macchina_accessori.ID_Macchina = ?");
$stmtAcc->execute([$id]);
$accessori = $stmtAcc->fetchAll();
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/dettaglio.css">

<div class="container mt-4">

    <a href="catalogo.php">← Torna al catalogo</a>

    <br><br>

    <div class="row g-4">
        <div class="col-md-6">

            <?php
            // mostro le foto se ci sono
            if (count($foto) > 0) {
                // prima foto grande
                echo "<img src='/InformaticaSaba/ProgettoFinale_Ilmondodellauto/" . $foto[0]['URL'] . "' class='foto-principale' alt='" . $auto['Marca'] . "'>";

                // thumbnails sotto
                echo "<div class='thumbnails mt-2 d-flex gap-2'>";
                foreach ($foto as $f) {
                    echo "<img src='/InformaticaSaba/ProgettoFinale_Ilmondodellauto/" . $f['URL'] . "' class='thumbnail' alt=''>";
                }
                echo "</div>";
            } else {
                echo "<div class='no-foto'>Nessuna foto</div>";
            }
            ?>

            <br>

            <div class="descrizione p-3">
                <h5>Descrizione</h5>
                <p><?php echo $auto['Descrizione']; ?></p>
            </div>

        </div>

        <div class="col-md-6">

            <p class="car-marca"><?php echo $auto['Marca']; ?></p>
            <h2><?php echo $auto['Modello']; ?></h2>
            <p><?php echo $auto['TipoVeicolo'] . ' · ' . $auto['Anno']; ?></p>

            <br>

            <h3 class="prezzo">€ <?php echo number_format($auto['Prezzo'], 0, ',', '.'); ?></h3>
            <p>IVA inclusa</p>

            <br>

            <div class="ctas">
                <?php
                // se sei loggato mostro il bottone prenota
                // altrimenti mando al login
                if (isset($_SESSION['utente_id'])) {
                    echo "<a href='prenotazione.php?id=" . $auto['ID'] . "' class='btn-prenota'>Prenota test drive</a>";
                } else {
                    echo "<a href='login.php' class='btn-prenota'>Prenota test drive</a>";
                }
                ?>
                <a href="https://wa.me/393802074281" target="_blank" class="btn-wa">WhatsApp</a>
                <a href="https://www.subito.it" target="_blank" class="btn-subito">Vedi su Subito.it</a>
                <a href="tel:+393802074281" class="btn-tel">Chiama</a>
            </div>

            <br>

            <div class="specifiche">
                <h5>Specifiche</h5>
                <table class="table table-sm">
                    <tr><td>Chilometri</td><td><?php echo number_format($auto['Chilometraggio'], 0, ',', '.'); ?> km</td></tr>
                    <tr><td>Potenza</td><td><?php echo $auto['Cavalli']; ?> CV</td></tr>
                    <tr><td>Cilindrata</td><td><?php echo $auto['Cilindrata']; ?> cc</td></tr>
                    <tr><td>Carrozzeria</td><td><?php echo $auto['Carrozzeria']; ?></td></tr>
                    <tr><td>Colore interni</td><td><?php echo $auto['ColoreInterni']; ?></td></tr>
                    <tr><td>Neopatentati</td><td><?php echo $auto['Neopatentati'] ? 'Sì' : 'No'; ?></td></tr>
                    <tr><td>Targa</td><td><?php echo $auto['Targa']; ?></td></tr>
                </table>
            </div>

            <?php
            // mostro gli accessori solo se ce ne sono
            if (count($accessori) > 0) {
                echo "<br><div class='optional'>";
                echo "<h5>Optional</h5>";
                echo "<div class='d-flex flex-wrap gap-2'>";
                foreach ($accessori as $acc) {
                    echo "<span class='badge-acc'>" . $acc['Nome'] . "</span>";
                }
                echo "</div></div>";
            }
            ?>

        </div>
    </div>

</div>

</body>
</html>