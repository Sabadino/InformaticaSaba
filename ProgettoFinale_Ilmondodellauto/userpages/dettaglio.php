<?php
if (!isset($_GET['id'])) {
    header('Location: catalogo.php');
    exit;
}

$pdo = DBHandler::getPDO();
$id = $_GET['id'];

// prendo auto
$sql = "SELECT * FROM macchina WHERE ID = :id";
$sth = $pdo->prepare($sql);
$sth->bindParam(':id', $id, PDO::PARAM_INT);
$sth->execute();
$auto = $sth->fetch(PDO::FETCH_ASSOC);

if (!$auto) {
    header('Location: catalogo.php');
    exit;
}

// prendo foto
$sql2 = "SELECT URL FROM macchina_immagini WHERE ID_Macchina = :id ORDER BY Ordine";
$sth2 = $pdo->prepare($sql2);
$sth2->bindParam(':id', $id, PDO::PARAM_INT);
$sth2->execute();
$foto = $sth2->fetchAll(PDO::FETCH_ASSOC);

// prendo accessori
$sql3 = "SELECT accessori.Nome FROM accessori JOIN macchina_accessori ON accessori.ID = macchina_accessori.ID_Accessorio WHERE macchina_accessori.ID_Macchina = :id";
$sth3 = $pdo->prepare($sql3);
$sth3->bindParam(':id', $id, PDO::PARAM_INT);
$sth3->execute();
$accessori = $sth3->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/dettaglio.css">

<div class="det-wrap">

    <a href="catalogo.php">← Torna al catalogo</a>

    <br><br>

    <div class="det-grid">
        <div class="det-sinistra">

            <?php if (count($foto) > 0) { ?>
                <img src="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/<?php echo $foto[0]['URL']; ?>" class="foto-principale" alt="<?php echo $auto['Marca']; ?>">
               
            <?php } else { ?>
                <div class="no-foto">Nessuna foto</div>
            <?php } ?>

            <br>

            <div class="descrizione">
                <h5>Descrizione</h5>
                <p><?php echo $auto['Descrizione']; ?></p>
            </div>

        </div>

        <div class="det-destra">

            <p class="auto-marca"><?php echo $auto['Marca']; ?></p>
            <h2><?php echo $auto['Modello']; ?></h2>
            <p><?php echo $auto['TipoVeicolo'] . ' · ' . $auto['Anno']; ?></p>

            <br>

            <h3>€ <?php echo number_format($auto['Prezzo'], 0, ',', '.'); ?></h3>
            <p>IVA inclusa</p>

            <br>

            <div class="ctas">
                <?php if (isset($_SESSION['utente_id'])) { ?>
                    <a href="prenotazione.php?id=<?php echo $auto['ID']; ?>" class="btn-prenota">Prenota test drive</a>
                <?php } else { ?>
                    <a href="login.php" class="btn-prenota">Prenota test drive</a>
                <?php } ?>
                <a href="https://wa.me/393802074281" target="_blank" class="btn-wa">WhatsApp</a>
                <a href="https://www.subito.it" target="_blank" class="btn-subito">Vedi su Subito.it</a>
                <a href="tel:+393802074281" class="btn-tel">Chiama</a>
            </div>

            <br>

            <div class="specifiche">
                <h5>Specifiche</h5>
                <table>
                    <tr><td>Chilometri</td><td><?php echo number_format($auto['Chilometraggio'], 0, ',', '.'); ?> km</td></tr>
                    <tr><td>Potenza</td><td><?php echo $auto['Cavalli']; ?> CV</td></tr>
                    <tr><td>Cilindrata</td><td><?php echo $auto['Cilindrata']; ?> cc</td></tr>
                    <tr><td>Carrozzeria</td><td><?php echo $auto['Carrozzeria']; ?></td></tr>
                    <tr><td>Colore interni</td><td><?php echo $auto['ColoreInterni']; ?></td></tr>
                    <tr><td>Neopatentati</td><td><?php echo $auto['Neopatentati'] ? 'Sì' : 'No'; ?></td></tr>
                    <tr><td>Targa</td><td><?php echo $auto['Targa']; ?></td></tr>
                </table>
            </div>

            <?php if (count($accessori) > 0) { ?>
                <br>
                <h5>Optional</h5>
                <div class="accessori">
                <?php foreach ($accessori as $acc) { ?>
                    <span><?php echo $acc['Nome']; ?></span>
                <?php } ?>
                </div>
            <?php } ?>

        </div>
    </div>

</div>

</body>
</html>
