<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}
?>
    <section class="container-perfil">
    <h1>Perfil de Usuario</h1>
    <p>Bienvenido, <?php echo $_SESSION['nombre']; ?></p>
    <p>Email: <?php echo $_SESSION['email']; ?></p>
    <button class="btn-logout2">
    <a href="./vistas/logout.php">Cerrar sesión</a>
    </button>
    </section>

