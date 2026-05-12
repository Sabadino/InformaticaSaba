<?php
$pdo = DBHandler::getPDO();

$sql = "SELECT m.*, mi.URL as Immagine 
        FROM macchina m 
        LEFT JOIN macchina_immagini mi ON m.ID = mi.ID_Macchina AND mi.Ordine = 0 
        WHERE m.Stato = 'Disponibile'";

if(isset($_GET['tipo']) && $_GET['tipo'] != '') {
    $sql .= " AND m.TipoVeicolo = :tipo";
}
if(isset($_GET['marca']) && $_GET['marca'] != '') {
    $sql .= " AND m.Marca = :marca";
}

$sth = $pdo->prepare($sql);

if(isset($_GET['tipo']) && $_GET['tipo'] != '') {
    $sth->bindParam(':tipo', $_GET['tipo'], PDO::PARAM_STR);
}
if(isset($_GET['marca']) && $_GET['marca'] != '') {
    $sth->bindParam(':marca', $_GET['marca'], PDO::PARAM_STR);
}

$sth->execute();
$autoRows = $sth->fetchAll(PDO::FETCH_ASSOC);

$sqlMarche = "SELECT DISTINCT Marca FROM macchina ORDER BY Marca";
$marcheRows = $pdo->query($sqlMarche)->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/catalogo.css">

<div class="container mt-4">

    <h1>Catalogo auto</h1>

        <button type="submit" class="btn-cerca">Cerca</button>
        <br><br>
    </form>

    <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
    if(count($autoRows) == 0) {
        echo "<p>Nessuna auto trovata.</p>";
    } else {
        foreach($autoRows as $auto) {
            $autoOBJ = array(
                'id'         => $auto['ID'],
                'marca'      => $auto['Marca'],
                'modello'    => $auto['Modello'],
                'anno'       => $auto['Anno'],
                'cavalli'    => $auto['Cavalli'],
                'carrozzeria'=> $auto['Carrozzeria'],
                'prezzo'     => $auto['Prezzo'],
                'immagine'   => $auto['Immagine'],
                'tipo'       => $auto['TipoVeicolo']
            );

            echo "<div class='col'>
                <div class='card h-100'>
                    <a href='dettaglio.php?id=" . $autoOBJ['id'] . "'>";
                    if($autoOBJ['immagine']) {
                        echo "<img src='/InformaticaSaba/ProgettoFinale_Ilmondodellauto/" . $autoOBJ['immagine'] . "' class='card-img-top' alt='" . $autoOBJ['marca'] . "'>";
                    } else {
                        echo "<div class='no-foto'>Nessuna foto</div>";
                    }
                    echo "</a>
                    <div class='card-body'>
                        <p class='car-marca'>" . $autoOBJ['marca'] . "</p>
                        <h5 class='card-title'>" . $autoOBJ['modello'] . "</h5>
                        <div class='d-flex gap-2 mb-2'>
                            <span class='badge-spec'>" . $autoOBJ['cavalli'] . " CV</span>
                            <span class='badge-spec'>" . $autoOBJ['anno'] . "</span>
                            <span class='badge-spec'>" . $autoOBJ['carrozzeria'] . "</span>
                        </div>
                        <div class='d-flex justify-content-between align-items-center mt-3'>
                            <strong>€ " . number_format($autoOBJ['prezzo'], 0, ',', '.') . "</strong>
                            <a href='dettaglio.php?id=" . $autoOBJ['id'] . "' class='btn-verde-sm'>Vedi →</a>
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