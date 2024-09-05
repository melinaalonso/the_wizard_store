<?php
require_once 'clases/Carrito.php';
require_once 'clases/Producto.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?s=login');
    exit;
}
$carrito = new Carrito();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];
        if ($accion == 'vaciar') {
            $carrito->vaciarCarrito('Activo');
        } elseif ($accion == 'finalizar') {
            $carrito->vaciarCarrito('Finalizado');
        } elseif ($accion == 'cancelar') {
            $carrito->vaciarCarrito('Anulado');
        } elseif ($accion == 'agregar' && isset($_POST['id'])) {
            $id_producto = intval($_POST['id']);
            $carrito->agregarProducto($id_producto);
        } elseif ($accion == 'eliminar' && isset($_POST['id'])) {
            $id_producto = intval($_POST['id']);
            $carrito->eliminarProducto($id_producto);
        }
    }
}


$productos = $carrito->crearCarrito();
?>

<h1>Mi Carrito</h1>
<?php if (!empty($productos)) : ?>
    <div class="product-list">
        <?php
        $total = 0;
        foreach ($productos as $producto) {
            $subtotal = $producto['precio'] * $producto['cantidad'];
            $total += $subtotal;
            ?>
            <div class="product-card">
                <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                <div class="product-info">
                    <h3><?php echo $producto['nombre']; ?></h3>
                    <p>Precio: <?php echo number_format($producto['precio'], 2); ?> $</p>
                    <p>Cantidad: <?php echo $producto['cantidad']; ?></p>
                    <p>Subtotal: <?php echo number_format($subtotal, 2); ?> $</p>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="accion" value="eliminar">
                        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                        <button type="submit">Eliminar producto</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="total">
        <p><strong>Total:</strong> <?php echo number_format($total, 2); ?> $</p>
    </div>
    <div class="botones">
    <form method="post">
        <input type="hidden" name="accion" value="finalizar">
        <button type="submit">Finalizar Compra</button>
    </form>
    <form method="post">
        <input type="hidden" name="accion" value="vaciar">
        <button  class="vaciar" type="submit">Vaciar Carrito</button>
    </form>
    <form method="post">
        <input type="hidden" name="accion" value="cancelar">
        <button type="submit" class="cancelar">Cancelar Compra</button>
    </form>
    </div>
<?php else : ?>
    <div class="empty-cart">
    <p>El carrito está vacío.</p>
    </div>
<?php endif; ?>

