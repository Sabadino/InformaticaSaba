<?php
$db = DBHandler::getPDO();
$id = $_GET['id'];

$stmt = $db->prepare("SELECT * FROM macchina WHERE ID = ?");
$stmt->execute([$id]);
$macchina = $stmt->fetch();

if (!$macchina) {
    header('Location: catalogo.php');
    exit;
}
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/auth.css">

<div class="container mt-4" style="max-width: 600px">

    <a href="dettaglio.php?id=<?php echo $id; ?>">← Torna alla scheda</a>

    <h2 class="mt-3">Prenota un appuntamento</h2>
    <p class="text-muted"><?php echo $macchina['Marca'] . ' ' . $macchina['Modello'] . ' · ' . $macchina['Anno']; ?></p>

    <?php
    if (isset($_GET['errore'])) {
        echo "<div class='alert-errore'>Qualcosa è andato storto, riprova.</div>";
    }
    ?>

    <form action="prenotazione_action.php" method="POST" class="mt-4">
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
        <button type="submit" class="mt-2">Conferma prenotazione</button>
    </form>

</div>

</body>
</html>