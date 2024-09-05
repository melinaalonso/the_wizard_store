<?php
require_once __DIR__ . '/../clases/Usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $usuario = new Usuario();
    if ($usuario->register($nombre, $email, $password)) {
        echo "Registro exitoso.";
        header("Location: index.php?s=login");
    } else {
        echo "Error en el registro.";
    }
}
?>

<div class="div-form">
<h1>Registrarse</h1>
<form class="form" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" class="form__nombre input" name="nombre" placeholder="Nombre">
    <label for="email">Email:</label>
    <input type="email" class="form__email input" name="email" placeholder="Email">
    <label for="password">Password:</label>
    <input type="password" class="form__password input" name="password">
    <button type="submit" class="form__submit">Registrarse</button>
</form>
<button class="btn-login">
<a href="./index.php?s=login">Iniciar Sesion</a>
</button>
</div>
