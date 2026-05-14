<?php

// questa classe gestisce la connessione al database
// la usiamo in tutte le pagine che hanno bisogno del db
class DBHandler {

    // variabile statica che tiene la connessione
    // static significa che è condivisa, non si ricrea ogni volta
    private static $db = null;

    // costruttore privato - impedisce di fare new DBHandler()
    private function __construct() {}

    // metodo statico per ottenere la connessione
    // si chiama con DBHandler::getPDO()
    public static function getPDO() {

        // se la connessione non esiste ancora la creo
        if (self::$db == null) {
            try {
                // mi connetto al database
                // host = localhost, nome db = concessionario
                // utente = root, password = vuota (xampp default)
                self::$db = new PDO('mysql:host=localhost;dbname=concessionario;charset=utf8', 'root', '');

                // dico a PDO di mostrare gli errori come eccezioni
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                // se la connessione fallisce blocco tutto e mostro l'errore
                die("Errore connessione: " . $e->getMessage());
            }
        }

        // restituisco la connessione
        return self::$db;
    }
}