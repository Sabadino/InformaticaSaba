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

        <h2>Registrati</h2>

        <br>

        <?php if (isset($_GET['errore'])) { echo "<p style='color:red'>Email o username già in uso</p>"; } ?>

        <form action="/InformaticaSaba/ProgettoFinale_Ilmondodellauto/userpages/register_action.php" method="POST">
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

        <br>

        <p>Hai già un account? <a href="login.php">Accedi</a></p>

    </div>
</div>

</body>
</html>