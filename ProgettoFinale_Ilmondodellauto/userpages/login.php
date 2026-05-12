<?php
if(isset($_SESSION['utente_id'])) {
    header('Location: catalogo.php');
    exit;
}
?>

<link rel="stylesheet" href="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/style/auth.css">

<div class="auth-wrap">
    <div class="auth-card">

        <h4 class="text-center mb-1">Il Mondo <em>dell'Auto</em></h4>
        <p class="text-center text-muted mb-4">Accedi per prenotare e salvare le auto</p>

        <h2 class="mb-3">Bentornato</h2>

        <?php
        if(isset($_GET['errore'])) {
            echo "<div class='alert-errore'>Email o password errati</div>";
        }
        ?>

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

        <p class="text-center mt-3">Non hai un account? <a href="register.php">Registrati</a></p>

    </div>
</div>

</body>
</html>