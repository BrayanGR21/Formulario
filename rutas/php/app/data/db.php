<?php

class db{
    private $host, $user, $pass, $database;

    public function __construct() {
        require_once 'config.php';
        $this->host=DB_HOST;
        $this->user=DB_USER;
        $this->pass=DB_PASS;
        $this->database=DB_NAME;
    }

    public function conectar(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database.';charset=utf8';
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            // PDO::ATTR_EMULATE_PREPARES => 0
        );
        // Create a new PDO instanace
        try {
            $cnn = new PDO($dsn, $this->user, $this->pass,$options);
        } // Catch any errors
        catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
        return $cnn;
    }
}