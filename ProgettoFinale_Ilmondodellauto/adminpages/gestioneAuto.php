<?php
$db = DBHandler::getPDO();

$stmt = $db->query("SELECT * FROM macchina ORDER BY ID DESC");
$autoRows = $stmt->fetchAll();
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/admin.css">

<div class="container mt-4">

    <h2>Gestione Auto</h2>

    <?php
    if (isset($_GET['successo'])) echo "<div class='alert-successo'>Operazione completata.</div>";
    if (isset($_GET['errore'])) echo "<div class='alert-errore'>Qualcosa è andato storto.</div>";
    ?>

    <table class="admin-table mt-3">
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
        <?php
        foreach ($autoRows as $auto) {
            echo "<tr>
                <td>" . $auto['ID'] . "</td>
                <td>" . $auto['Marca'] . "</td>
                <td>" . $auto['Modello'] . "</td>
                <td>" . $auto['Anno'] . "</td>
                <td>€ " . number_format($auto['Prezzo'], 0, ',', '.') . "</td>
                <td>" . $auto['Stato'] . "</td>
                <td><a href='gestioneAuto_action.php?azione=elimina&id=" . $auto['ID'] . "' onclick='return confirm(\"Sicuro?\")' class='btn-elimina'>Elimina</a></td>
            </tr>";
        }
        ?>
        </tbody>
    </table>

    <h3 class="mt-5">Aggiungi auto</h3>

    <form action="gestioneAuto_action.php" method="POST" enctype="multipart/form-data" class="mt-3">
        <input type="hidden" name="azione" value="aggiungi">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="fg"><label>Marca</label><input type="text" name="marca" required></div>
            </div>
            <div class="col-md-4">
                <div class="fg"><label>Modello</label><input type="text" name="modello" required></div>
            </div>
            <div class="col-md-4">
                <div class="fg"><label>Anno</label><input type="number" name="anno" required></div>
            </div>
            <div class="col-md-4">
                <div class="fg"><label>Cilindrata</label><input type="number" step="0.1" name="cilindrata" required></div>
            </div>
            <div class="col-md-4">
                <div class="fg"><label>Potenza KW</label><input type="number" name="potenzakw" required></div>
            </div>
            <div class="col-md-4">
                <div class="fg"><label>Cavalli</label><input type="number" name="cavalli" required></div>
            </div>
            <div class="col-md-4">
                <div class="fg"><label>Chilometraggio</label><input type="number" name="chilometraggio" required></div>
            </div>
            <div class="col-md-4">
                <div class="fg">
                    <label>Carrozzeria</label>
                    <select name="carrozzeria">
                        <option value="Berlina">Berlina</option>
                        <option value="Due Volumi">Due Volumi</option>
                        <option value="Station Wagon">Station Wagon</option>
                        <option value="SUV">SUV</option>
                        <option value="City Car">City Car</option>
                        <option value="Monovolume">Monovolume</option>
                        <option value="Cabrio">Cabrio</option>
                        <option value="Utilitaria">Utilitaria</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="fg"><label>Colore interni</label><input type="text" name="coloreinterni"></div>
            </div>
            <div class="col-md-4">
                <div class="fg"><label>Targa</label><input type="text" name="targa" required></div>
            </div>
            <div class="col-md-4">
                <div class="fg"><label>Prezzo</label><input type="number" step="0.01" name="prezzo" required></div>
            </div>
            <div class="col-md-4">
                <div class="fg">
                    <label>Neopatentati</label>
                    <select name="neopatentati">
                        <option value="0">No</option>
                        <option value="1">Sì</option>
                    </select>
                </div>
            </div>
            <div class="col-md-8">
                <div class="fg"><label>Descrizione</label><textarea name="descrizione" rows="3"></textarea></div>
            </div>
            <div class="col-md-4">
                <div class="fg"><label>Foto</label><input type="file" name="foto" accept="image/*"></div>
            </div>
        </div>
        <button type="submit" class="mt-3">Aggiungi auto</button>
    </form>

</div>

</body>
</html>