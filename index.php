<?php
require './config/conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Nombre = $_POST['Nombre'];
    $Password = $_POST['Password'];

    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE Nombre = ?");
    $stmt->execute([$Nombre]);
    $Nombre = $stmt->fetch();

    if ($Nombre && Password_verify($Password, $Nombre['Password'])) {
        $_SESSION['user_id'] = $Nombre['codigo'];
        header("Location: ./pantallas/home_screen.php");
        exit();
    } else {
        echo "<p class='error'>Invalid credentials</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Biblioteca</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <div>
            <img class="logo" src="./assets/img/logo.png" alt="">
        </div>
        <h1>Iniciar sesión - Biblioteca</h1>
        <a href="#" class="oauth-btn"><img src="./assets/img/google.png" alt="Google">Iniciar sesión con Google</a>
        <form method="POST">
            <label for="Nombre">Usuario</label>
            <input type="text" name="Nombre" id="Nombre" placeholder="Usuario" required>

            <label for="Password">Contraseña</label>
            <input type="Password" name="Password" id="Password" placeholder="Contraseña" required>

            <a href="./pantallas/olvido_contraseña.php">¿Olvidó su contraseña?</a>
            <button type="submit">Iniciar sesión</button>
        </form>
        <p>No tienes una cuenta? <a href="./pantallas/register.php">Regístrate aquí</a></p>
    </div>
</body>
</html>