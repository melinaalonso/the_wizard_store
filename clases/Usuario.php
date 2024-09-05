<?php
require_once 'Conexion.php';

class Usuario {
    private $conn;

    public function __construct() {
        $bd = new Conexion();
        $this->conn = $bd->getConn();
    }

    public function register($nombre, $email, $password) {
        $consulta = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
        $stmt = $this->conn->prepare($consulta);
        $password_hashed = password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password_hashed);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password) {
        $consulta = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->conn->prepare($consulta);
        $stmt->bindParam(':email', $email);
        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row && password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['nombre'] = $row['nombre'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
?>
