<?php
$pdo = DBHandler::getPDO();

// prendo le auto
$sql = "SELECT * FROM macchina ORDER BY ID DESC";
$sth = $pdo->prepare($sql);
$sth->execute();
$auto = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/admin.css">

<div class="container-wrap">

    <h2>Gestione Auto</h2>

    <br>

    <?php if (isset($_GET['successo'])) { echo "<p style='color:green'>Operazione completata.</p>"; } ?>
    <?php if (isset($_GET['errore'])) { echo "<p style='color:red'>Qualcosa è andato storto.</p>"; } ?>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modello</th>
                <th>Anno</th>
                <th>Prezzo</th>
                <th>Stato</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($auto as $a) { ?>
            <tr>
                <td><?php echo $a['ID']; ?></td>
                <td><?php echo $a['Marca']; ?></td>
                <td><?php echo $a['Modello']; ?></td>
                <td><?php echo $a['Anno']; ?></td>
                <td>€ <?php echo number_format($a['Prezzo'], 0, ',', '.'); ?></td>
                <td><?php echo $a['Stato']; ?></td>
              <td><a href="gestioneAuto_action.php?azione=elimina&id=<?php echo $a['ID']; ?>" class="btn-elimina">Elimina</a></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>

    <br><br>

    <h3>Aggiungi auto</h3>

    <br>

    <form action="gestioneAuto_action.php" method="POST">
        <input type="hidden" name="azione" value="aggiungi">
        <label>Marca</label><br>
        <input type="text" name="marca" required><br><br>
        <label>Modello</label><br>
        <input type="text" name="modello" required><br><br>
        <label>Anno</label><br>
        <input type="number" name="anno" required><br><br>
        <label>Cilindrata (cc)</label><br>
        <input type="number" name="cilindrata" required><br><br>
        <label>Potenza KW</label><br>
        <input type="number" name="potenzakw" required><br><br>
        <label>Cavalli</label><br>
        <input type="number" name="cavalli" required><br><br>
        <label>Chilometraggio</label><br>
        <input type="number" name="chilometraggio" required><br><br>
        <label>Carrozzeria</label><br>
        <select name="carrozzeria">
            <option value="Berlina">Berlina</option>
            <option value="Due Volumi">Due Volumi</option>
            <option value="Station Wagon">Station Wagon</option>
            <option value="SUV">SUV</option>
            <option value="City Car">City Car</option>
            <option value="Monovolume">Monovolume</option>
            <option value="Cabrio">Cabrio</option>
            <option value="Utilitaria">Utilitaria</option>
        </select><br><br>
        <label>Colore interni</label><br>
        <input type="text" name="coloreinterni"><br><br>
        <label>Targa</label><br>
        <input type="text" name="targa" required><br><br>
        <label>Prezzo (€)</label><br>
        <input type="number" name="prezzo" required><br><br>
        <label>Neopatentati</label><br>
        <select name="neopatentati">
            <option value="0">No</option>
            <option value="1">Sì</option>
        </select><br><br>
        <label>Descrizione</label><br>
        <textarea name="descrizione" rows="3"></textarea><br><br>
        <button type="submit">Aggiungi auto</button>
    </form>

</div>

</body>
</html>