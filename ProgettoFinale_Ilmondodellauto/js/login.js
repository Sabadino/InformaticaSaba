document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("loginForm");

    form.addEventListener("submit", function(e) {
        e.preventDefault(); // 🔥 blocca il refresh automatico
        loadData();
    });
});

function loadData() {
    const vemail = document.querySelector("#email").value;
    const vpassword = document.querySelector("#password").value;

    const data = {
        email: vemail,
        password: vpassword
    };

    fetch("./api/login.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(y => {
        console.log("RISPOSTA LOGIN:", y); // debug: controlla il JSON ricevuto

        if (y.code == 1) {
            console.log("LOGIN OK, redirecting...");
            // redirect alla pagina principale
            window.location.href = "index.html";
        } else {
            // alert per credenziali errate o altri errori
            alert(y.message);
            document.querySelector("#password").value = ""; // reset password
        }
    })
    .catch(err => {
        console.error("Errore fetch:", err);
        alert("Errore di connessione al server");
    });
}