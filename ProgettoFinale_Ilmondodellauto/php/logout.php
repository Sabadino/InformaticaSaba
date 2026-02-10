<?php
session_start();
header("Content-Type: application/json");

// Distruggi la sessione
session_unset();
session_destroy();

// Rispondi con un messaggio di successo
echo json_encode(["success" => true]);
?>