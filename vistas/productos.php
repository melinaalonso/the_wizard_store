<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'clases/Producto.php';

$articulo = new Articulos();
$nombreProducto = isset($_GET['buscar']) ? $_GET['buscar'] : null;
$categoriaSeleccionada = isset($_GET['fk_categoria']) ? $_GET['fk_categoria'] : null;

$stmt = $articulo->readAll($categoriaSeleccionada, $nombreProducto);
$categorias = $articulo->getCategorias();
?>
<form class="d-flex justify-content-center align-items-center w-50 mx-auto" role="search" method="GET" action="index.php">
    <input type="hidden" name="s" value="productos">
    <div class="col-8">
        <input class="form-control" type="search" placeholder="Busca tu producto" aria-label="Search" id="buscar" name="buscar" value="<?= $nombreProducto ?>">
    </div>
    <div>
        <button class="btn-buscar" type="submit">Buscar</button>
    </div>
</form>

<nav id="navigation-productos">
    <ul>
        <li><a href="index.php?s=productos">Todas</a></li>
        <?php foreach ($categorias as $categoria) : ?>
            <li><a href="index.php?s=productos&fk_categoria=<?= urlencode($categoria['id']) ?>"><?= htmlspecialchars($categoria['nombreCategoria']) ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>
<section class="container-productos">
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <div class="card" style="width: 18rem;">
            <img src="<?= htmlspecialchars($row['imagen']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['nombre']) ?>">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($row['nombre']) ?></h5>
                <p class="card-text" ><?= htmlspecialchars($row['detalle']) ?></p>
                <button class="btn-mostrar"><a href="index.php?s=detalle_producto&id=<?= $row['id'] ?>" >Mostrar más</a></button>
                
        </div>
</div>

    <?php endwhile; ?>
</section>


