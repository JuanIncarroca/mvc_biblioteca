<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>📚 Gestión de Libros</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        h3 {
            margin-top: 0;
            color: #555;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 10px);
            padding: 8px;
            margin: 6px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 15px;
            margin: 8px 5px 0 0;
            border: none;
            border-radius: 4px;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }

        button[name="actualizar"] {
            background-color: #ffc107;
        }

        button[name="eliminar"] {
            background-color: #dc3545;
        }

        button:hover {
            opacity: 0.9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-top: 20px;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
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
        <br>
        <button type="submit" name="crear">Crear</button>
        <button type="submit" name="actualizar">Actualizar</button>
    </form>

    <!-- Formulario Eliminar -->
    <form method="post">
        <h3>Eliminar Libro</h3>
        Código del libro: <input type="number" name="codigo" required>
        <br>
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
        require '../config/conexion.php';
        $resultado = $conexion->query("SELECT * FROM libro");
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