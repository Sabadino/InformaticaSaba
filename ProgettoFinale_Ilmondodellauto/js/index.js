function loadData() {
    fetch("./api/account.php")
        .then(res => res.json())
        .then(data => {
            if (data.code === 0) {
                window.location.replace("login.html");
            }
        })
        .catch(() => {
            window.location.replace("login.html");
        });
}

function logout() {
    fetch("./api/logout.php")
        .then(() => window.location.replace("login.html"));
}

window.onload = loadData;