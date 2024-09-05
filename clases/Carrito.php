<?php
require_once 'Conexion.php';

class Carrito {
    private $conn;

    public function __construct() {
        $bd = new Conexion();
        $this->conn = $bd->getConn();
    }

    public function agregarProducto($id_producto) {
        if (isset($_SESSION['user_id'])) {
            $id_producto = intval($id_producto);
            $id_usuario = intval($_SESSION['user_id']);
    
            // Verificar si el carrito existe y está activo
            $sql = "SELECT id FROM carrito WHERE fk_usuario = :id_usuario AND estado_compra = 'Activo'";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($row) {
                $id_carrito = $row['id'];
            } else {
                $estado = "Activo";
                $sql = "INSERT INTO carrito (fk_usuario, estado_compra, fecha_compra) VALUES (:id_usuario, :estado, NOW())";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id_usuario', $id_usuario);
                $stmt->bindParam(':estado', $estado);
                $stmt->execute();
                $id_carrito = $this->conn->lastInsertId();
            }
            $sql = "SELECT cantidad FROM carrito_detalle WHERE fkcarrito_id = :id_carrito AND fkproducto_id = :id_producto";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_carrito', $id_carrito);
            $stmt->bindParam(':id_producto', $id_producto);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($row) {
                $cantidad_actualizada = $row['cantidad'] + 1;
                $sql = "UPDATE carrito_detalle SET cantidad = :cantidad WHERE fkcarrito_id = :id_carrito AND fkproducto_id = :id_producto";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':cantidad', $cantidad_actualizada);
                $stmt->bindParam(':id_carrito', $id_carrito);
                $stmt->bindParam(':id_producto', $id_producto);
            } else {
                $sql = "INSERT INTO carrito_detalle (fkcarrito_id, fkproducto_id, cantidad) VALUES (:id_carrito, :id_producto, 1)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id_carrito', $id_carrito);
                $stmt->bindParam(':id_producto', $id_producto);
            }
    
            if ($stmt->execute()) {
                echo "Producto agregado al carrito correctamente";
            } else {
                echo "Error al agregar el producto al carrito";
            }
        }
    }
    

    public function crearCarrito() {
        $id_usuario = intval($_SESSION['user_id']);
        $sql = "SELECT productos.nombre, productos.id, productos.precio, productos.imagen, carrito_detalle.cantidad 
                FROM carrito_detalle
                JOIN carrito ON carrito_detalle.fkcarrito_id = carrito.id   
                JOIN productos ON carrito_detalle.fkproducto_id = productos.id
                WHERE carrito.fk_usuario = :id_usuario AND carrito.estado_compra = 'Activo'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function vaciarCarrito($estado) {
        $id_usuario = intval($_SESSION['user_id']);
        $sql = "UPDATE carrito SET estado_compra = :estado WHERE fk_usuario = :id_usuario AND estado_compra = 'Activo'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id_usuario', $id_usuario);
        
        if ($stmt->execute()) {
            $sql = "DELETE FROM carrito_detalle WHERE fkcarrito_id IN (SELECT id FROM carrito WHERE fk_usuario = :id_usuario AND estado_compra = :estado)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':estado', $estado);
            $stmt->execute();
    
            if ($estado == 'Finalizado') {
                echo "<p>En breve nos pondremos en contacto con usted para confirmar su compra 😄</p>";
                echo "<p>¡Hasta pronto! 😊</p>";
            } elseif ($estado == 'Anulado') {
                echo "Carrito cancelado correctamente";
            } else {
                echo "Carrito vaciado correctamente";
            }
        } else {
            if ($estado == 'Anulado') {
                echo "Error al cancelar el carrito";
            } else {
                echo "Error al finalizar la compra";
            }
        }
    }
    
    
    
    public function eliminarProducto($id) {
        $id_usuario = intval($_SESSION['user_id']);
        $sql = "SELECT id FROM carrito WHERE fk_usuario = :id_usuario AND estado_compra = 'Activo'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $id_carrito = $row['id'];
            $sql = "SELECT cantidad FROM carrito_detalle WHERE fkcarrito_id = :id_carrito AND fkproducto_id = :id_producto";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_carrito', $id_carrito);
            $stmt->bindParam(':id_producto', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row) {
                if ($row['cantidad'] > 1) {
                    $cantidad_actualizada = $row['cantidad'] - 1;
                    $sql = "UPDATE carrito_detalle SET cantidad = :cantidad WHERE fkcarrito_id = :id_carrito AND fkproducto_id = :id_producto";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':cantidad', $cantidad_actualizada);
                    $stmt->bindParam(':id_carrito', $id_carrito);
                    $stmt->bindParam(':id_producto', $id);
                } else {
                    $sql = "DELETE FROM carrito_detalle WHERE fkcarrito_id = :id_carrito AND fkproducto_id = :id_producto";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':id_carrito', $id_carrito);
                    $stmt->bindParam(':id_producto', $id);
                }
                
                if ($stmt->execute()) {
                    echo "Producto eliminado del carrito correctamente";
                } else {
                    echo "Error al eliminar el producto del carrito";
                }
            } else {
                echo "El producto no se encuentra en el carrito";
            }
        } else {
            echo "Carrito no encontrado";
        }
    }    
}
?>
  