<?php
$pdo = DBHandler::getPDO();

$sql = "SELECT macchina.*, macchina_immagini.URL FROM macchina LEFT JOIN macchina_immagini ON macchina.ID = macchina_immagini.ID_Macchina AND macchina_immagini.Ordine = 0 WHERE macchina.Stato = 'Disponibile'";
$sth = $pdo->prepare($sql);
$sth->execute();
$autoRows = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
.catalogo-wrap {
    max-width: 1100px;
    margin: 40px auto;
    padding: 0 30px;
}

.auto-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-top: 20px;
}

.auto-card {
    background: white;
    border: 1px solid lightgray;
    border-radius: 10px;
    overflow: hidden;
}

.auto-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    display: block;
}

.no-foto {
    width: 100%;
    height: 180px;
    background: lightgray;
    display: flex;
    align-items: center;
    justify-content: center;
    color: gray;
}

.auto-info {
    padding: 16px;
}

.auto-marca {
    font-size: 11px;
    color: gray;
    text-transform: uppercase;
    margin: 0 0 4px 0;
}

.auto-info h3 {
    font-size: 18px;
    margin: 0 0 8px 0;
}

.auto-info span {
    font-size: 12px;
    background: #eee;
    padding: 3px 8px;
    border-radius: 4px;
    color: gray;
}

.btn-vedi {
    display: inline-block;
    margin-top: 12px;
    background-color: #1C3829;
    color: white;
    padding: 7px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
}

@media (max-width: 900px) {
    .auto-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 600px) {
    .auto-grid { grid-template-columns: 1fr; }
    .catalogo-wrap { padding: 0 16px; }
}
</style>

<div class="catalogo-wrap">

    <h1>Catalogo auto</h1>

    <br>

    <div class="auto-grid">
    <?php foreach ($autoRows as $auto) { ?>

        <div class="auto-card">
            <?php if ($auto['URL']) { ?>
                <a href="dettaglio.php?id=<?php echo $auto['ID']; ?>">
                    <img src="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/<?php echo $auto['URL']; ?>" alt="<?php echo $auto['Marca']; ?>">
                </a>
            <?php } else { ?>
                <div class="no-foto">Nessuna foto</div>
            <?php } ?>

            <div class="auto-info">
                <p class="auto-marca"><?php echo $auto['Marca']; ?></p>
                <h3><?php echo $auto['Modello']; ?></h3>
                <span><?php echo $auto['Cavalli']; ?> CV</span> -
                <span><?php echo $auto['Anno']; ?></span> -
                <span><?php echo $auto['Carrozzeria']; ?></span>
                <br><br>
                <strong>€ <?php echo number_format($auto['Prezzo'], 0, ',', '.'); ?></strong>
                <br>
                <a href="dettaglio.php?id=<?php echo $auto['ID']; ?>" class="btn-vedi">Vedi →</a>
            </div>
        </div>

    <?php } ?>
    </div>

</div>

</body>
</html>