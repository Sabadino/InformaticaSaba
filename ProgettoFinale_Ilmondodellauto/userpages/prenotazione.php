<?php
// se non c'è l'id nell'url rimando al catalogo
if (!isset($_GET['id'])) {
    header('Location: catalogo.php');
    exit;
}

// prendo la connessione al database
$db = DBHandler::getPDO();

// prendo l'id dall'url
$id = $_GET['id'];

// prendo i dati dell'auto
$stmt = $db->prepare("SELECT * FROM macchina WHERE ID = ?");
$stmt->execute([$id]);
$auto = $stmt->fetch();

// se l'auto non esiste rimando al catalogo
if (!$auto) {
    header('Location: catalogo.php');
    exit;
}
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/auth.css">

<div class="container mt-4">

    <a href="dettaglio.php?id=<?php echo $id; ?>">← Torna alla scheda</a>

    <br><br>

    <h2>Prenota un appuntamento</h2>
    <p><?php echo $auto['Marca'] . ' ' . $auto['Modello'] . ' · ' . $auto['Anno']; ?></p>

    <br>

    <?php
    // se c'è errore nell'url mostro il messaggio
    if (isset($_GET['errore'])) {
        echo "<div class='alert-errore'>Qualcosa è andato storto, riprova.</div>";
    }
    ?>

    <!-- form che manda i dati a prenotazione_action.php -->
    <form action="prenotazione_action.php" method="POST" style="max-width:500px">

        <!-- passo l'id dell'auto nascosto nel form -->
        <input type="hidden" name="id_macchina" value="<?php echo $id; ?>">

        <div class="fg">
            <label>Tipo di appuntamento</label>
            <select name="tipo">
                <option value="Test Drive">Test Drive</option>
                <option value="Acquisto">Acquisto</option>
                <option value="Visita">Visita</option>
            </select>
        </div>

        <div class="fg">
            <label>Data e ora</label>
            <input type="datetime-local" name="data" required>
        </div>

        <br>

        <button type="submit">Conferma prenotazione</button>

    </form>

</div>

</body>
</html>