<?php
// prendo la connessione al database
$db = DBHandler::getPDO();

// prendo tutte le auto ordinate per id decrescente
// cosi le ultime aggiunte sono in cima
$stmt = $db->query("SELECT * FROM macchina ORDER BY ID DESC");
$auto = $stmt->fetchAll();
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/admin.css">

<div class="container mt-4">

    <h2>Gestione Auto</h2>

    <br>

    <?php
    // mostro messaggio di successo o errore
    if (isset($_GET['successo'])) echo "<div class='alert-successo'>Operazione completata.</div>";
    if (isset($_GET['errore'])) echo "<div class='alert-errore'>Qualcosa è andato storto.</div>";
    ?>

    <!-- tabella con tutte le auto -->
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
        <?php
        // ciclo su ogni auto e creo una riga della tabella
        foreach ($auto as $a) {
            echo "<tr>
                <td>" . $a['ID'] . "</td>
                <td>" . $a['Marca'] . "</td>
                <td>" . $a['Modello'] . "</td>
                <td>" . $a['Anno'] . "</td>
                <td>€ " . number_format($a['Prezzo'], 0, ',', '.') . "</td>
                <td>" . $a['Stato'] . "</td>
                <td><a href='gestioneAuto_action.php?azione=elimina&id=" . $a['ID'] . "' onclick='return confirm(\"Sicuro?\")' class='btn-elimina'>Elimina</a></td>
            </tr>";
        }
        ?>
        </tbody>
    </table>

    <br><br>

    <h3>Aggiungi auto</h3>

    <br>

    <!-- form per aggiungere una nuova auto -->
    <form action="gestioneAuto_action.php" method="POST">

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
                <div class="fg"><label>Cilindrata (cc)</label><input type="number" name="cilindrata" required></div>
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
                <div class="fg"><label>Prezzo (€)</label><input type="number" name="prezzo" required></div>
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
        </div>

        <br>

        <button type="submit">Aggiungi auto</button>

    </form>

</div>

</body>
</html>