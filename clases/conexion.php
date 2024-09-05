<?php
class Conexion {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db = 'thewizardstore';

    protected $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->db", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        } 
    }

    public function getConn() {
        return $this->conn;
    }

    public function cerrar() {
        $this->conn = null;
    }
}


$conexion = new Conexion();
?>
