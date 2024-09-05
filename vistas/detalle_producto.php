<?php
include 'clases/Producto.php';
include 'clases/Carrito.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $articulo = new Articulos();
    $producto = $articulo->read($id);

    if ($producto) {
        ?>
                <div class="product-details">
                    <div class="product-image">
                        <img src="<?= htmlspecialchars($producto['imagen']); ?>" alt="<?= htmlspecialchars($producto['nombre']); ?>">
                    </div>
                    <div class="product-info">
                        <h2 class="product-title"><?= htmlspecialchars($producto['nombre']); ?></h2>
                        <h3 class="text-muted"><?= htmlspecialchars($producto['detalle']); ?></h3>
                        <p class="precio">$<?= htmlspecialchars($producto['precio']); ?></p>
                        <div class="botones-detalle">
                            <form method="POST" action="index.php?s=vista-carrito">
                                <input type="hidden" name="accion" value="agregar">
                                <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                                <button type="submit" class="btn-card">Agregar al carrito</button>
                            </form>
                            <button class="btn-comprar">Comprar</button>
                            <a class="a-volver" href="index.php?s=productos">Volver atrás</a>
                        </div>
                        <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Descripción
                            </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                            <?= htmlspecialchars($producto['descripcion']); ?>
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Envios y Políticas de Devolución
                            </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                            </div>
                            <p>
                                    Todos los pedidos se procesan dentro de un día laboral. <br>
                                    - Una tarifa de envío <br>
                                    - Devoluciones gratuitas dentro de 14 días (excluye piezas personalizadas) <br>
                                    Los derechos de entrega están incluidos en el precio del artículo cuando se envía a países de la unión europea, países de la nueva europa, suiza, japón, corea del sur, rae de hong kong, canadá, china continente, singapur, australia, región de taiwán, tailandia, emiratos árabes unidos y los estados unidos estados. ¿necesitas más información? lea nuestras condiciones de envío y entrega. 
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
        <?php
    } else {
        echo "Producto no encontrado.";
    }
} else {
    echo "ID no especificado.";
}
?>
