<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$rutas = [
'home' => [
'titulo' => 'La página Oficial de Harry Potter.',
],
'productos' => [
'titulo' => 'Todos nuestros productos',
],
'detalle_producto' => [
'titulo' => 'Detalle Producto',
],
'404' => [
'titulo' => 'Página no Encontrada',
],
'contacto' => [
'titulo' => 'Contacto',
    ],
'datos_alumno' => [
    'titulo' => 'Datos Alumno',
    ],
'procesar' => [
    'titulo' => 'Mensaje enviado' ,
],
'login' => [
    'titulo' => 'Iniciar Sesion' ,
],
'register' => [
    'titulo' => 'Registrarse' ,
],
'vista-carrito' => [
    'titulo' => 'Mi carrito' ,
],
'perfil' => [
    'titulo' => 'Mi perfil' ,
]
];


$vista = $_GET['s'] ?? 'home';

if(!isset($rutas[$vista])) {
$vista = '404';
}
$rutaConfig = $rutas[$vista];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Wizard Store : <?= $rutaConfig['titulo'];?></title>
    <link rel="stylesheet"  type="text/css" href="css/style.css">
    <link rel="icon" href="./img/logosmall.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
</head>
<body>
    <header>
    <h2 id="logo">Logo</h2>
    <h1 id="thewizardstore">The Wizard Store</h1>
    </header>

<?php if(!isset($_SESSION['email'])) { ?>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid justify-content-center">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
        <i class="icon-divider2"></i>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link " href="index.php?s=home">Home</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="index.php?s=productos">Merchandising</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="index.php?s=contacto">Contacto</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?s=register">Crear cuenta</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?s=login">Iniciar sesión</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="index.php?s=vista-carrito">Carrito</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="index.php?s=datos_alumno">Alumno</a>
        </li>
      </ul>
      <i class="icon-divider2"></i>
    </div>
  </div>
</nav>
<?php  } else {  ?> 
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
</button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <i class="icon-divider"></i>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link " href="index.php?s=home">Home</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="index.php?s=productos">Merchandising</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="index.php?s=contacto">Contacto</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                        <?php echo $_SESSION['nombre']; ?>
                    </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?s=perfil">Mi perfil</a></li>
            <li><a class="dropdown-item" href="./vistas/logout.php">Log Out</a></li>
          </ul>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="index.php?s=vista-carrito">Carrito</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="index.php?s=datos_alumno">Alumno</a>
        </li>
      </ul>
      <i class="icon-divider"></i>
    </div>
  </div>
</nav>
<?php } ?> 


</body>
</html>

<main id="main-content">
<?php
    $filename = __DIR__ . '/vistas/' . $vista . '.php';
    if(file_exists($filename)) {
        require $filename;
    } else {
        require __DIR__ . '/vistas/404.php';
    }
    ?>
</main>
<footer>
    <div class="conteiner_footer">
        <ul class="redes_sociales">
            <li><a href="https://www.facebook.com/login/device-based/regular/login/?login_attempt=1&amp;lwv=110"><ion-icon name="logo-facebook" role="img" class="md hydrated" aria-label="logo facebook"></ion-icon></a></li>
            <li><a href="https://www.instagram.com/"><ion-icon name="logo-instagram" role="img" class="md hydrated" aria-label="logo instagram"></ion-icon></a></li>
            <li><a href="https://twitter.com/?lang=es"><ion-icon name="logo-twitter" role="img" class="md hydrated" aria-label="logo twitter"></ion-icon></a></li>
        </ul>
        <ul class="menu_footer">
        <li class="nav-item"><a class="nav-link" href="index.php?s=home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?s=productos">Merchandising</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?s=contacto">Contacto</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?s=register">Crear cuenta</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?s=login">Iniciar sesión</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?s=vista-carrito">Carrito</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?s=datos_alumno">Alumno</a></li>
        </ul>
        <p>© copyright 2024 | Melina Sol Alonso </p>
    </div>

</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule="" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>