<?php
if(isset($_SESSION['utente_id'])){
    header('Location: catalogo.php');
    exit;
}
?>

<div class="auth-wrap">
    <div class="auth-card">

        <div class="auth-logo">Il Mondo <em>dell'Auto</em></div>
        <p>Crea il tuo account gratuito</p>

        <h2>Registrati</h2>

        <?php if(isset($_GET['errore'])): ?>
            <div class="alert-errore">Email o username già in uso</div>
        <?php endif; ?>

        <form action="/ProgettoFinale_Ilmondodellauto/userpages/register_action.php" method="POST">
            <div class="fg">
                <label>Nome</label>
                <input type="text" name="nome" required>
            </div>
            <div class="fg">
                <label>Cognome</label>
                <input type="text" name="cognome" required>
            </div>
            <div class="fg">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="fg">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="fg">
                <label>Telefono</label>
                <input type="text" name="telefono">
            </div>
            <div class="fg">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Crea account</button>
        </form>

        <p>Hai già un account? <a href="login.php">Accedi</a></p>

    </div>
</div>

</body>
</html>