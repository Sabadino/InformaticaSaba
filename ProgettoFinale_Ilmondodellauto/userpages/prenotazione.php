<?php
if (!isset($_GET['id'])) {
    header('Location: catalogo.php');
    exit;
}

$pdo = DBHandler::getPDO();
$id = $_GET['id'];

$sql = "SELECT * FROM macchina WHERE ID = :id";
$sth = $pdo->prepare($sql);
$sth->bindParam(':id', $id, PDO::PARAM_INT);
$sth->execute();
$auto = $sth->fetch(PDO::FETCH_ASSOC);

if (!$auto) {
    header('Location: catalogo.php');
    exit;
}
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/auth.css">

<div class="auth-wrap">
    <div class="card">

        <h2>Prenota test drive</h2>
        <p><?php echo $auto['Marca'] . ' ' . $auto['Modello'] . ' · ' . $auto['Anno']; ?></p>

        <br>

        <?php if (isset($_GET['errore'])) { echo "<p style='color:red'>Qualcosa è andato storto.</p>"; } ?>

        <form action="prenotazione_action.php" method="POST">
            <input type="hidden" name="id_macchina" value="<?php echo $id; ?>">
            <div class="fg">
                <label>Tipo appuntamento</label>
                <select name="tipo">
                    <option value="Test Drive">Test Drive</option>
                    <option value="Acquisto">Acquisto</option>
                    <option value="Visita">Visita</option>
                </select>
            </div>
            <br>
            <button type="submit">Conferma</button>
        </form>

        <br>
        <a href="dettaglio.php?id=<?php echo $id; ?>">← Torna alla scheda</a>

    </div>
</div>

</body>
</html>
