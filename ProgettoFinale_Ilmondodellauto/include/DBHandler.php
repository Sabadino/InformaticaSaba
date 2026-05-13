<?php
class DBHandler {
    private static $db = null;

    private function __construct() {}

    public static function getPDO() {
        if (self::$db == null) {
            try {
                self::$db = new PDO('mysql:host=localhost;dbname=concessionario;charset=utf8', 'root', '');
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Errore connessione: " . $e->getMessage());
            }
        }
        return self::$db;
    }
}