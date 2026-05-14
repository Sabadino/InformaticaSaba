<?php
// se sei già loggato non hai motivo di stare qui
if (isset($_SESSION['utente_id'])) {
    header('Location: catalogo.php');
    exit;
}
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/auth.css">

<div class="auth-wrap">
    <div class="auth-card">

        <h4>Il Mondo <em>dell'Auto</em></h4>

        <br><br>

        <h2>Bentornato</h2>

        <br>

        <?php
        // se nell'url c'è ?errore=1 mostro il messaggio di errore
        if (isset($_GET['errore'])) {
            echo "<div class='alert-errore'>Email o password errati</div>";
        }
        ?>

        <!-- il form manda i dati a login_action.php con metodo POST -->
        <form action="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/login_action.php" method="POST">

            <div class="fg">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="fg">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit">Accedi</button>

        </form>

        <br>

        <p>Non hai un account? <a href="register.php">Registrati</a></p>

    </div>
</div>

</body>
</html>