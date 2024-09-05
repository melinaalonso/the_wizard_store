<?php
require_once 'Conexion.php';

class Articulos {
    private $id;
    private $imagen;
    private $nombre;
    private $detalle;
    private $descripcion;
    private $precio;
    private $fk_categoria;
    private $conn;
    private $table = "productos";

    public function __construct() {
        $this->conn = new Conexion();
        $this->conn = $this->conn->getConn();
    }

    public function create($nombre, $detalle, $descripcion, $precio, $imagen, $fk_categoria) {
        $this->nombre = $nombre;
        $this->imagen = $imagen;
        $this->detalle = $detalle;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->fk_categoria = $fk_categoria;
        $consulta = "INSERT INTO productos (nombre, imagen, detalle, descripcion, precio, fk_categoria) VALUES (:nombre, :imagen, :detalle, :descripcion, :precio, :fk_categoria)";
        $stmt = $this->conn->prepare($consulta);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":imagen", $this->imagen, PDO::PARAM_LOB);
        $stmt->bindParam(":detalle", $this->detalle);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":fk_categoria", $this->fk_categoria);
        $stmt->execute();
    }

public function readAll($fk_categoria = null, $nombre = null) {
    if ($fk_categoria && $nombre) {
        $consulta = "SELECT * FROM $this->table WHERE fk_categoria = :fk_categoria AND nombre LIKE :nombre";
        $stmt = $this->conn->prepare($consulta);
        $stmt->bindParam(":fk_categoria", $fk_categoria);
        $stmt->bindParam(":nombre", $nombre);
    } elseif ($fk_categoria) {
        $consulta = "SELECT * FROM $this->table WHERE fk_categoria = :fk_categoria";
        $stmt = $this->conn->prepare($consulta);
        $stmt->bindParam(":fk_categoria", $fk_categoria);
    } elseif ($nombre) {
        $consulta = "SELECT * FROM $this->table WHERE nombre LIKE :nombre";
        $stmt = $this->conn->prepare($consulta);
        $stmt->bindParam(":nombre", $nombre);
    } else {
        $consulta = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($consulta);
    }
    if ($nombre) {
        $nombre = "%$nombre%";
    }
    $stmt->execute();
    return $stmt;
}


    public function getCategorias() {
        $consulta = "SELECT id, nombreCategoria FROM categorias";
        $stmt = $this->conn->prepare($consulta);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function read($id) {
        $consulta = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($consulta);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }


    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getDetalle() {
        return $this->detalle;
    }
    public function setDetalle($detalle) {
        $this->detalle = $detalle;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getPrecio() {
        return $this->precio;
    }
    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function getFkCategoria() {
        return $this->fk_categoria;
    }
    public function setFkCategoria($fk_categoria) {
        $this->fk_categoria = $fk_categoria;
    }
}
?>
