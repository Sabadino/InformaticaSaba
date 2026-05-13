<?php
$db = DBHandler::getPDO();

$sql = "SELECT m.*, mi.URL as Immagine 
        FROM macchina m 
        LEFT JOIN macchina_immagini mi ON m.ID = mi.ID_Macchina AND mi.Ordine = 0 
        WHERE m.Stato = 'Disponibile'";

$params = [];

if (isset($_GET['marca']) && $_GET['marca'] != '') {
    $sql .= " AND m.Marca = ?";
    $params[] = $_GET['marca'];
}

$stmt = $db->prepare($sql);
$stmt->execute($params);
$autoRows = $stmt->fetchAll();

$marche = $db->query("SELECT DISTINCT Marca FROM macchina ORDER BY Marca")->fetchAll();
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/catalogo.css">

<div class="container mt-4">

    <h1>Catalogo auto</h1>

    <form method="GET" class="mb-4 d-flex gap-2">
        <select name="marca" class="form-select w-auto">
            <option value="">Tutte le marche</option>
            <?php
            foreach ($marche as $m) {
                $sel = (isset($_GET['marca']) && $_GET['marca'] == $m['Marca']) ? 'selected' : '';
                echo "<option value='" . $m['Marca'] . "' " . $sel . ">" . $m['Marca'] . "</option>";
            }
            ?>
        </select>
        <button type="submit" class="btn-cerca">Cerca</button>
    </form>

    <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
    if (count($autoRows) == 0) {
        echo "<p>Nessuna auto trovata.</p>";
    } else {
        foreach ($autoRows as $auto) {
            echo "<div class='col'>
                <div class='card h-100'>
                    <a href='dettaglio.php?id=" . $auto['ID'] . "'>";
                    if ($auto['Immagine']) {
                        echo "<img src='/InformaticaSaba/ProgettoFinale_Ilmondodellauto/" . $auto['Immagine'] . "' class='card-img-top' alt='" . $auto['Marca'] . "'>";
                    } else {
                        echo "<div class='no-foto'>Nessuna foto</div>";
                    }
                    echo "</a>
                    <div class='card-body'>
                        <p class='car-marca'>" . $auto['Marca'] . "</p>
                        <h5 class='card-title'>" . $auto['Modello'] . "</h5>
                        <div class='d-flex gap-2 mb-2'>
                            <span class='badge-spec'>" . $auto['Cavalli'] . " CV</span>
                            <span class='badge-spec'>" . $auto['Anno'] . "</span>
                            <span class='badge-spec'>" . $auto['Carrozzeria'] . "</span>
                        </div>
                        <div class='d-flex justify-content-between align-items-center mt-3'>
                            <strong>€ " . number_format($auto['Prezzo'], 0, ',', '.') . "</strong>
                            <a href='dettaglio.php?id=" . $auto['ID'] . "' class='btn-verde-sm'>Vedi →</a>
                        </div>
                    </div>
                </div>
            </div>";
        }
    }
    ?>
    </div>

</div>

</body>
</html>