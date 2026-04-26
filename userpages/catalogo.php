<?php
$pdo = DBHandler::getPDO();

$sql = "SELECT m.*, mi.URL as Immagine 
        FROM macchina m 
        LEFT JOIN macchina_immagini mi ON m.ID = mi.ID_Macchina AND mi.Ordine = 0
        WHERE m.Stato = 'Disponibile'";

if (isset($_GET['tipo']) && $_GET['tipo'] != '') {
    $sql .= " AND m.TipoVeicolo = :tipo";
}

if (isset($_GET['marca']) && $_GET['marca'] != '') {
    $sql .= " AND m.Marca = :marca";
}

$sth = $pdo->prepare($sql);

if (isset($_GET['tipo']) && $_GET['tipo'] != '') {
    $sth->bindParam('tipo', $_GET['tipo'], PDO::PARAM_STR);
}
if (isset($_GET['marca']) && $_GET['marca'] != '') {
    $sth->bindParam('marca', $_GET['marca'], PDO::PARAM_STR);
}

$sth->execute();
$auto = $sth->fetchAll();

$marche = $pdo->query("SELECT DISTINCT Marca FROM macchina ORDER BY Marca")->fetchAll();
?>

<div class="container mt-4">

    <h1>Catalogo auto</h1>

    <form method="GET" class="mb-4">
        <select name="tipo">
            <option value="">Tutti</option>
            <option value="Nuovo" <?= isset($_GET['tipo']) && $_GET['tipo'] == 'Nuovo' ? 'selected' : '' ?>>Nuovo</option>
            <option value="Usato" <?= isset($_GET['tipo']) && $_GET['tipo'] == 'Usato' ? 'selected' : '' ?>>Usato</option>
            <option value="Km Zero" <?= isset($_GET['tipo']) && $_GET['tipo'] == 'Km Zero' ? 'selected' : '' ?>>Km Zero</option>
        </select>

        <select name="marca">
            <option value="">Tutte le marche</option>
            <?php foreach ($marche as $m): ?>
                <option value="<?= $m['Marca'] ?>" <?= isset($_GET['marca']) && $_GET['marca'] == $m['Marca'] ? 'selected' : '' ?>>
                    <?= $m['Marca'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Cerca</button>
    </form>

    <div class="auto-grid">
        <?php if (count($auto) == 0): ?>
            <p>Nessuna auto trovata.</p>
        <?php else: ?>
            <?php foreach ($auto as $a): ?>
                <div class="car-card">
                    <a href="dettaglio.php?id=<?= $a['ID'] ?>">
                        <?php if ($a['Immagine']): ?>
                            <img src="/ProgettoFinale_Ilmondodellauto/<?= $a['Immagine'] ?>" alt="<?= $a['Marca'] ?> <?= $a['Modello'] ?>">
                        <?php else: ?>
                            <div class="no-foto">Nessuna foto</div>
                        <?php endif; ?>
                    </a>
                    <div class="car-card-body">
                        <span class="badge-tipo"><?= $a['TipoVeicolo'] ?></span>
                        <p class="car-marca"><?= $a['Marca'] ?></p>
                        <h3><?= $a['Modello'] ?></h3>
                        <div class="car-specs">
                            <span><?= $a['Cavalli'] ?> CV</span>
                            <span><?= $a['Anno'] ?></span>
                            <span><?= $a['Carrozzeria'] ?></span>
                        </div>
                        <div class="car-footer">
                            <span class="car-prezzo">€ <?= number_format($a['Prezzo'], 0, ',', '.') ?></span>
                            <a href="dettaglio.php?id=<?= $a['ID'] ?>">Vedi →</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>

</body>
</html>