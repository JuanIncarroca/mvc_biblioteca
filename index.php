<?php
require './config/conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE nombre = ?");
    $stmt->execute([$nombre]);
    $nombre = $stmt->fetch();

    if ($nombre && password_verify($password, $nombre['password'])) {
        $_SESSION['user_id'] = $nombre['id'];
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
            <label for="nombre">Usuario</label>
            <input type="text" name="nombre" id="nombre" placeholder="Usuario" required>

            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" placeholder="Contraseña" required>

            <a href="./pantallas/olvido_contraseña.php">¿Olvidó su contraseña?</a>
            <button type="submit">Iniciar sesión</button>
        </form>
        <p>No tienes una cuenta? <a href="./pantallas/register.php">Regístrate aquí</a></p>
    </div>
    <script src="./javascript/main.js"></script>
</body>
</html>