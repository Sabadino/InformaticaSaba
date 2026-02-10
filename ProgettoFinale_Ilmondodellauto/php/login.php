<?php
session_start();
header("Content-Type: application/json; charset=utf-8");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["code" => 0, "message" => "Metodo non consentito"]);
    exit;
}

// Legge il JSON inviato dal fetch
$input = file_get_contents('php://input');
$data  = json_decode($input);

// Controllo dati obbligatori
if (empty($data->email) || empty($data->password)) {
    http_response_code(400);
    echo json_encode(["code" => 0, "message" => "Email o password mancanti"]);
    exit;
}

$hostname = "localhost";
$dbname   = "agenda_appuntamenti";
$user     = "root";
$pass     = "";

try {
    $conn = new PDO(
        "mysql:host=$hostname;dbname=$dbname;charset=utf8",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Recupera l'utente per email
    $stmt = $conn->prepare("SELECT Username, Password FROM persona WHERE Email = :email");
    $stmt->execute([":email" => $data->email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Controlla se esiste e se la password corrisponde
    if (!$user || !password_verify($data->password, $user['Password'])) {
        echo json_encode(["code" => 0, "message" => "Credenziali errate"]);
        exit;
    }

    // Login ok: salva sessione
    $_SESSION["user_id"]  = $user['Username'];
    $_SESSION["username"] = $user['Username'];

    session_write_close();

    echo json_encode(["code" => 1, "username" => $user['Username']]);
    exit;

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["code" => 0, "message" => "Errore server"]);
    exit;
}
?>