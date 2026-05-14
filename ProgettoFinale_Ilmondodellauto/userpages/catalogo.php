<?php
// Prendo la connessione al database
$db = DBHandler::getPDO();

// Prendo tutte le auto disponibili
$stmt = $db->query("SELECT * FROM macchina WHERE Stato = 'Disponibile'");
$auto = $stmt->fetchAll();
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/catalogo.css">

<div class="container mt-4">
    <h1>Catalogo auto</h1>
    <br>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        
        <?php foreach ($auto as $a): 
            // Per ogni auto prendo la prima foto
            $stmtFoto = $db->prepare("SELECT URL FROM macchina_immagini WHERE ID_Macchina = ? AND Ordine = 0");
            $stmtFoto->execute([$a['ID']]);
            $foto = $stmtFoto->fetch();
        ?>

           
            <div class="col">
                <div class="card h-100">

                    <?php if ($foto): ?>
                        <a href="dettaglio.php?id=<?= $a['ID'] ?>">
                            <img src="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/<?= $foto['URL'] ?>" 
                                 class="card-img-top" 
                                 alt="<?= $a['Marca'] ?>">
                        </a>
                    <?php else: ?>
                        <div class="no-foto">Nessuna foto</div>
                    <?php endif; ?>

                    <div class="card-body">
                        <p class="car-marca"><?= $a['Marca'] ?></p>
                        <h5><?= $a['Modello'] ?></h5>
                        
                        <div>
                            <span class="badge-spec"><?= $a['Cavalli'] ?> CV</span>
                            <span class="badge-spec"><?= $a['Anno'] ?></span>
                            <span class="badge-spec"><?= $a['Carrozzeria'] ?></span>
                        </div>
                        
                        <br>
                        <strong>€ <?= number_format($a['Prezzo'], 0, ',', '.') ?></strong>
                        <br>
                        
                        <a href="dettaglio.php?id=<?= $a['ID'] ?>" class="btn-verde-sm">Vedi →</a>
                    </div>

                </div>
            </div>
        

        <?php endforeach; ?>

    </div>
</div>

</body>
</html>