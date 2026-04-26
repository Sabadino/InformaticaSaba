<?php
if(isset($_SESSION['utente_id'])){
    header('Location: /ProgettoFinale_Ilmondodellauto/userpages/catalogo.php');
    exit;
}
?>

<div class="auth-wrap">
    <div class="auth-card">

        <div class="auth-logo">Il Mondo <em>dell'Auto</em></div>
        <p>Accedi per prenotare e salvare le auto</p>

        <h2>Bentornato</h2>

        <?php if(isset($_GET['errore'])): ?>
            <div class="alert-errore">Email o password errati</div>
        <?php endif; ?>

        <form action="/ProgettoFinale_Ilmondodellauto/userpages/login_action.php" method="POST">
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

        <p>Non hai un account? <a href="register.php">Registrati</a></p>

    </div>
</div>

</body>
</html>