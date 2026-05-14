<?php
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

        <?php if (isset($_GET['errore'])) { echo "<p style='color:red'>Email o password errati</p>"; } ?>

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