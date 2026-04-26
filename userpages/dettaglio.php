<?php
if(!isset($_GET['id'])){
    header('Location: catalogo.php');
    exit;
}

$pdo = DBHandler::getPDO();
$id = $_GET['id'];

$query = $pdo->prepare("SELECT * FROM macchina WHERE ID = :id");
$query->execute(['id' => $id]);
$macchina = $query->fetch();

if(!$macchina){
    header('Location: catalogo.php');
    exit;
}

$queryFoto = $pdo->prepare("SELECT URL FROM macchina_immagini WHERE ID_Macchina = :id ORDER BY Ordine");
$queryFoto->execute(['id' => $id]);
$foto = $queryFoto->fetchAll();

$queryAcc = $pdo->prepare("SELECT a.Nome FROM accessori a JOIN macchina_accessori ma ON a.ID = ma.ID_Accessorio WHERE ma.ID_Macchina = :id");
$queryAcc->execute(['id' => $id]);
$accessori = $queryAcc->fetchAll();

$queryRec = $pdo->prepare("SELECT r.*, u.Nome as NomeUtente FROM recensioni r JOIN utente u ON r.ID_Utente = u.ID WHERE r.ID_Macchina = :id ORDER BY r.DataOraPubblicazione DESC");
$queryRec->execute(['id' => $id]);
$recensioni = $queryRec->fetchAll();
?>

<div class="container mt-4">

<a href="catalogo.php">← Torna al catalogo</a>

<div class="dettaglio-layout">

    <div class="det-sinistra">
        <?php if(count($foto) > 0): ?>
            <img src="/ProgettoFinale_Ilmondodellauto/<?= $foto[0]['URL'] ?>" class="foto-principale" alt="<?= $macchina['Marca'] ?>">
            <div class="thumbnails">
            <?php foreach($foto as $f): ?>
                <img src="/ProgettoFinale_Ilmondodellauto/<?= $f['URL'] ?>" alt="">
            <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-foto">Nessuna foto</div>
        <?php endif; ?>

        <div class="descrizione">
            <h4>Descrizione</h4>
            <p><?= $macchina['Descrizione'] ?></p>
        </div>
    </div>

    <div class="det-destra">
        <p><?= $macchina['Marca'] ?></p>
        <h2><?= $macchina['Modello'] ?></h2>
        <p><?= $macchina['TipoVeicolo'] ?> · <?= $macchina['Anno'] ?></p>
        <h3>€ <?= number_format($macchina['Prezzo'], 0, ',', '.') ?></h3>
        <p>IVA inclusa</p>

        <div class="ctas">
            <?php if(isset($_SESSION['utente_id'])): ?>
                <a href="prenotazione.php?id=<?= $macchina['ID'] ?>" class="btn-prenota">📅 Prenota test drive</a>
            <?php else: ?>
                <a href="login.php" class="btn-prenota">📅 Prenota test drive</a>
            <?php endif; ?>
            <a href="https://wa.me/393802074281" target="_blank" class="btn-wa">💬 WhatsApp</a>
            <a href="https://www.subito.it" target="_blank" class="btn-subito">🔗 Vedi su Subito.it</a>
            <a href="tel:+393802074281" class="btn-tel">📞 Chiama</a>
            <?php if(isset($_SESSION['utente_id'])): ?>
                <a href="wishlist_action.php?id=<?= $macchina['ID'] ?>&azione=aggiungi" class="btn-wish">♡ Salva</a>
            <?php endif; ?>
        </div>

        <div class="specifiche">
            <h4>Specifiche</h4>
            <table>
                <tr><td>Chilometri</td><td><?= number_format($macchina['Chilometraggio'], 0, ',', '.') ?> km</td></tr>
                <tr><td>Potenza</td><td><?= $macchina['Cavalli'] ?> CV</td></tr>
                <tr><td>Cilindrata</td><td><?= $macchina['Cilindrata'] ?> cc</td></tr>
                <tr><td>Carrozzeria</td><td><?= $macchina['Carrozzeria'] ?></td></tr>
                <tr><td>Colore interni</td><td><?= $macchina['ColoreInterni'] ?></td></tr>
                <tr><td>Neopatentati</td><td><?= $macchina['Neopatentati'] ? 'Sì' : 'No' ?></td></tr>
                <tr><td>Targa</td><td><?= $macchina['Targa'] ?></td></tr>
            </table>
        </div>

        <?php if(count($accessori) > 0): ?>
        <div class="optional">
            <h4>Optional</h4>
            <div class="acc-list">
            <?php foreach($accessori as $a): ?>
                <span><?= $a['Nome'] ?></span>
            <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

</div>

<div class="recensioni mt-4">
    <h3>Recensioni</h3>
    <?php if(count($recensioni) == 0): ?>
        <p>Nessuna recensione ancora.</p>
    <?php else: ?>
        <?php foreach($recensioni as $r): ?>
        <div class="rec-item">
            <strong><?= $r['NomeUtente'] ?></strong>
            <span><?= $r['Valutazione'] ?>/5 ★</span>
            <p><?= $r['Testo'] ?></p>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</div>

</body>
</html>