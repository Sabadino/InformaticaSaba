<?php
if (isset($_SESSION['utente_id'])) {
    header('Location: /ProgettoFinale_Ilmondodellauto/userpages/catalogo.php');
    exit;
}
?>

<div class="auth-wrap">
    <div class="auth-card">
        
        <div class="auth-logo">Il Mondo <em>dell'Auto</em></div>
        <p class="auth-tagline">Accedi per prenotare e salvare le auto</p>

        <h2>Bentornato</h2>

        <?php if (isset($_GET['errore'])): ?>
            <div class="alert-errore">Email o password errati</div>
        <?php endif; ?>

        <form action="/ProgettoFinale_Ilmondodellauto/userpages/login_process.php" method="POST">
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

        <p class="auth-link">Non hai un account? <a href="/ProgettoFinale_Ilmondodellauto/userpages/register.php">Registrati</a></p>

    </div>
</div>

</body>
</html>