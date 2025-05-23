<?php
require '../config/conexion.php';

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Crear libro
if (isset($_POST['crear'])) {
    $stmt = $conexion->prepare("INSERT INTO Libro (Codigo, Titulo, ISBN, Editorial, Paginas) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", $_POST['codigo'], $_POST['titulo'], $_POST['isbn'], $_POST['editorial'], $_POST['paginas']);
    $stmt->execute();
    $stmt->close();
}

// Actualizar libro
if (isset($_POST['actualizar'])) {
    $stmt = $conexion->prepare("UPDATE Libro SET Titulo=?, ISBN=?, Editorial=?, Paginas=? WHERE Codigo=?");
    $stmt->bind_param("sssii", $_POST['titulo'], $_POST['isbn'], $_POST['editorial'], $_POST['paginas'], $_POST['codigo']);
    $stmt->execute();
    $stmt->close();
}

// Eliminar libro
if (isset($_POST['eliminar'])) {
    $stmt = $conexion->prepare("DELETE FROM Libro WHERE Codigo=?");
    $stmt->bind_param("i", $_POST['codigo']);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Libros</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body { font-family: Arial, sans-serif; }
        form { margin-bottom: 20px; border: 1px solid #ccc; padding: 10px; }
        input { margin: 4px; }
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 6px; }
    </style>
</head>
<body>
<h2>📚 Gestión de Libros</h2>

<!-- Formulario Crear / Actualizar -->
<form method="post">
    <h3>Crear o Actualizar Libro</h3>
    Código: <input type="number" name="codigo" required>
    Título: <input type="text" name="titulo" required>
    ISBN: <input type="text" name="isbn">
    Editorial: <input type="text" name="editorial">
    Páginas: <input type="number" name="paginas">
    <button type="submit" name="crear">Crear</button>
    <button type="submit" name="actualizar">Actualizar</button>
</form>

<!-- Formulario Eliminar -->
<form method="post">
    <h3>Eliminar Libro</h3>
    Código del libro: <input type="number" name="codigo" required>
    <button type="submit" name="eliminar">Eliminar</button>
</form>

<!-- Lista de libros -->
<h3>📖 Lista de Libros</h3>
<table>
    <tr>
        <th>Código</th>
        <th>Título</th>
        <th>ISBN</th>
        <th>Editorial</th>
        <th>Páginas</th>
    </tr>
    <?php
    $resultado = $conexion->query("SELECT * FROM Libro");
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>{$fila['Codigo']}</td>
                <td>{$fila['Titulo']}</td>
                <td>{$fila['ISBN']}</td>
                <td>{$fila['Editorial']}</td>
                <td>{$fila['Paginas']}</td>
              </tr>";
    }
    $conexion->close();
    ?>
</table>
</body>
</html>