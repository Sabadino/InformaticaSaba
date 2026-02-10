<?php
session_start();
header("Content-Type: application/json; charset=utf-8");

$hostname = "localhost";
$dbname   = "agenda_appuntamenti";
$dbuser   = "root";
$dbpass   = "";

$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {

    if (isset($_SESSION["username"])) {
        echo json_encode([
            "code" => 1,
            "username" => $_SESSION["username"]
        ]);
    } else {
        echo json_encode([
            "code" => 0
        ]);
    }

    exit;
}

if ($method === "PUT") {

    $input = file_get_contents("php://input");
    $data  = json_decode($input);

    // Controllo dati obbligatori
    if (
        empty($data->username) ||
        empty($data->nome) ||
        empty($data->cognome) ||
        empty($data->email) ||
        empty($data->telefono) ||
        empty($data->password)
    ) {
        http_response_code(400);
        echo json_encode([
            "success" => false,
            "message" => "Dati mancanti"
        ]);
        exit;
    }

    try {
        $conn = new PDO(
            "mysql:host=$hostname;dbname=$dbname;charset=utf8",
            $dbuser,
            $dbpass,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        // Controllo email
        $checkEmail = $conn->prepare(
            "SELECT 1 FROM persona WHERE Email = :email"
        );
        $checkEmail->execute([
            ":email" => $data->email
        ]);

        if ($checkEmail->rowCount() > 0) {
            echo json_encode([
                "success" => false,
                "message" => "Email già registrata"
            ]);
            exit;
        }

        // Controllo username
        $checkUsername = $conn->prepare(
            "SELECT 1 FROM persona WHERE Username = :username"
        );
        $checkUsername->execute([
            ":username" => $data->username
        ]);

        if ($checkUsername->rowCount() > 0) {
            echo json_encode([
                "success" => false,
                "message" => "Username già esistente"
            ]);
            exit;
        }

        // Hash password
        $hashedPassword = password_hash(
            $data->password,
            PASSWORD_DEFAULT
        );

        // Inserimento
        $stmt = $conn->prepare(
            "INSERT INTO persona
             (Username, Nome, Cognome, Email, Telefono, Password)
             VALUES
             (:username, :nome, :cognome, :email, :telefono, :password)"
        );

        $stmt->execute([
            ":username" => $data->username,
            ":nome"     => $data->nome,
            ":cognome"  => $data->cognome,
            ":email"    => $data->email,
            ":telefono" => $data->telefono,
            ":password" => $hashedPassword
        ]);

        echo json_encode([
            "success" => true
        ]);
        exit;

    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode([
            "success" => false,
            "message" => $e->getMessage() // oppure "Errore server"
        ]);
        exit;
    }
}

http_response_code(405);
echo json_encode([
    "success" => false,
    "message" => "Metodo non consentito"
]);
?>