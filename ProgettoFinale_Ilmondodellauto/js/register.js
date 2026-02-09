async function registerUser() {
    const nome = document.getElementById("nome").value;
    const cognome = document.getElementById("cognome").value;
    const email = document.getElementById("email").value;
    const username = document.getElementById("username").value;
    const telefono = document.getElementById("telefono").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    // Verifica che le password coincidano
    if (password !== confirmPassword) {
        alert("Le password non coincidono!");
        return;
    }

    // [Opzionale] Verifica la forma della password con una regex
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; // Almeno 8 caratteri, una lettera e un numero
    if (!passwordRegex.test(password)) {
        alert("La password deve contenere almeno 8 caratteri, una lettera e un numero.");
        return;
    }

    try {
        // Effettua la richiesta PUT all'API
        const response = await fetch("./api/account.php", {
            method: "PUT",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ nome, cognome, email, username, telefono, password })
        });

        const data = await response.json();

        if (data.success) {
            document.getElementById("successMessage").style.display = "block";
            document.getElementById("errorMessage").style.display = "none";
            alert("Registrazione completata con successo! Ora puoi accedere.");
            window.location.href = "login.html"; // Reindirizza alla pagina di login
        } else {
            document.getElementById("errorMessage").style.display = "block";
            document.getElementById("successMessage").style.display = "none";
            alert(data.message || "Errore durante la registrazione.");
        }
    } catch (error) {
        console.error("Errore:", error);
        document.getElementById("errorMessage").style.display = "block";
        document.getElementById("successMessage").style.display = "none";
    }
}