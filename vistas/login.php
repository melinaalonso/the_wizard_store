<?php
require_once __DIR__ . '/../clases/Usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $usuario = new Usuario();
    if ($usuario->login($email, $password)) {
        header('Location: ./index.php?s=home');
        exit();
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>

<div class="div-form">
<h1>Bienvenido</h1>
<form class="form" method="post">
    <label for="email">Email:</label>
    <input type="email" class="form__email input" name="email" placeholder="Email:">
    <label for="password">Password:</label>
    <input type="password" class="form__email input" name="password">
    <button type="submit" class="form__submit">Ingresar</button>
</form>
<button class="btn-register"><a href="./index.php?s=register">Registrarse</a></button>

</div>

