<?php
if(!isset($_GET['id'])) {
    header('Location: catalogo.php');
    exit;
}

$pdo = DBHandler::getPDO();
$id = $_GET['id'];

$sql = "SELECT * FROM macchina WHERE ID = :id";
$sth = $pdo->prepare($sql);
$sth->bindParam(':id', $id, PDO::PARAM_INT);
$sth->execute();
$macchinaRow = $sth->fetch(PDO::FETCH_ASSOC);

if(!$macchinaRow) {
    header('Location: catalogo.php');
    exit;
}

$macchina = array(
    'id'            => $macchinaRow['ID'],
    'marca'         => $macchinaRow['Marca'],
    'modello'       => $macchinaRow['Modello'],
    'anno'          => $macchinaRow['Anno'],
    'tipo'          => $macchinaRow['TipoVeicolo'],
    'prezzo'        => $macchinaRow['Prezzo'],
    'cavalli'       => $macchinaRow['Cavalli'],
    'cilindrata'    => $macchinaRow['Cilindrata'],
    'km'            => $macchinaRow['Chilometraggio'],
    'carrozzeria'   => $macchinaRow['Carrozzeria'],
    'interni'       => $macchinaRow['ColoreInterni'],
    'neopatentati'  => $macchinaRow['Neopatentati'],
    'targa'         => $macchinaRow['Targa'],
    'descrizione'   => $macchinaRow['Descrizione']
);

$sqlFoto = "SELECT URL FROM macchina_immagini WHERE ID_Macchina = :id ORDER BY Ordine";
$sthFoto = $pdo->prepare($sqlFoto);
$sthFoto->bindParam(':id', $id, PDO::PARAM_INT);
$sthFoto->execute();
$fotoRows = $sthFoto->fetchAll(PDO::FETCH_ASSOC);

$sqlAcc = "SELECT a.Nome FROM accessori a JOIN macchina_accessori ma ON a.ID = ma.ID_Accessorio WHERE ma.ID_Macchina = :id";
$sthAcc = $pdo->prepare($sqlAcc);
$sthAcc->bindParam(':id', $id, PDO::PARAM_INT);
$sthAcc->execute();
$accessoriRows = $sthAcc->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/dettaglio.css">

<div class="container mt-4">

    <a href="catalogo.php">← Torna al catalogo</a>

    <div class="row mt-3 g-4">
        <div class="col-md-6">
            <?php
            if(count($fotoRows) > 0) {
                echo "<img src='/InformaticaSaba/ProgettoFinale_Ilmondodellauto/" . $fotoRows[0]['URL'] . "' class='foto-principale' alt='" . $macchina['marca'] . "'>";
                echo "<div class='thumbnails mt-2 d-flex gap-2'>";
                foreach($fotoRows as $foto) {
                    echo "<img src='/InformaticaSaba/ProgettoFinale_Ilmondodellauto/" . $foto['URL'] . "' class='thumbnail' alt=''>";
                }
                echo "</div>";
            } else {
                echo "<div class='no-foto'>Nessuna foto</div>";
            }
            ?>
            <div class="descrizione mt-3 p-3">
                <h5>Descrizione</h5>
                <p><?php echo $macchina['descrizione']; ?></p>
            </div>
        </div>

        <div class="col-md-6">
            <p class="car-marca"><?php echo $macchina['marca']; ?></p>
            <h2><?php echo $macchina['modello']; ?></h2>
            <p><?php echo $macchina['tipo'] . ' · ' . $macchina['anno']; ?></p>
            <h3 class="prezzo">€ <?php echo number_format($macchina['prezzo'], 0, ',', '.'); ?></h3>
            <p class="text-muted">IVA inclusa</p>

            <div class="ctas mt-3">
                <?php
                if(isset($_SESSION['utente_id'])) {
                    echo "<a href='prenotazione.php?id=" . $macchina['id'] . "' class='btn-prenota'>Prenota test drive</a>";
                } else {
                    echo "<a href='login.php' class='btn-prenota'>Prenota test drive</a>";
                }
                ?>
                <a href="https://wa.me/393802074281" target="_blank" class="btn-wa">WhatsApp</a>
                <a href="https://www.subito.it" target="_blank" class="btn-subito">Vedi su Subito.it</a>
                <a href="tel:+393802074281" class="btn-tel">Chiama</a>
                <?php
                if(isset($_SESSION['utente_id'])) {
                    echo "<a href='wishlist_action.php?id=" . $macchina['id'] . "&azione=aggiungi' class='btn-wish'>♡ Salva</a>";
                }
                ?>
            </div>

            <div class="specifiche mt-4">
                <h5>Specifiche</h5>
                <table class="table table-sm">
                    <tr><td class="text-muted">Chilometri</td><td><?php echo number_format($macchina['km'], 0, ',', '.'); ?> km</td></tr>
                    <tr><td class="text-muted">Potenza</td><td><?php echo $macchina['cavalli']; ?> CV</td></tr>
                    <tr><td class="text-muted">Cilindrata</td><td><?php echo $macchina['cilindrata']; ?> cc</td></tr>
                    <tr><td class="text-muted">Carrozzeria</td><td><?php echo $macchina['carrozzeria']; ?></td></tr>
                    <tr><td class="text-muted">Colore interni</td><td><?php echo $macchina['interni']; ?></td></tr>
                    <tr><td class="text-muted">Neopatentati</td><td><?php echo $macchina['neopatentati'] ? 'Sì' : 'No'; ?></td></tr>
                    <tr><td class="text-muted">Targa</td><td><?php echo $macchina['targa']; ?></td></tr>
                </table>
            </div>

            <?php
            if(count($accessoriRows) > 0) {
                echo "<div class='optional mt-3'>";
                echo "<h5>Optional</h5>";
                echo "<div class='d-flex flex-wrap gap-2'>";
                foreach($accessoriRows as $acc) {
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