<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de contacto</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('https://images6.alphacoders.com/129/1291421.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .container {
            text-align: center;
        }
        form {
            background-color: rgba(255, 255, 255, 0.9); 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin: auto;
        }
        h2 {
            color: #000000;
        }
        h3 {
            color: #333;
        }
        label {
            margin-top: 10px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            color: #333;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
        }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #e7f3e7;
            border-left: 6px solid #4CAF50;
            border-radius: 4px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Ingresa tus datos para jugar TFT</h2>
 
    <?php
    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";  // Usuario por defecto de XAMPP
    $password = "";      // Contraseña vacía por defecto en XAMPP
    $dbname = "tft_jugadores";  // Nombre de tu base de datos

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verificar si el formulario fue enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rut = htmlspecialchars($_POST['rut']);
        $correo = htmlspecialchars($_POST['correo']);
        $comentarios = htmlspecialchars($_POST['comentarios']);

        // Preparar la consulta SQL
        $sql = "INSERT INTO jugadores (rut, correo, comentarios) VALUES ('$rut', '$correo', '$comentarios')";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            echo "<div class='result'>";
            echo "<h3>Datos recibidos:</h3>";
            echo "<strong>RUT:</strong> " . $rut . "<br>";
            echo "<strong>Correo:</strong> " . $correo . "<br>";
            echo "<strong>Comentarios:</strong> " . $comentarios . "<br>";
            echo "</div>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Cerrar la conexión
    $conn->close();
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="rut">RUT:</label>
        <input type="text" id="rut" name="rut" required>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required>

        <label for="comentarios">Comentarios:</label>
        <textarea id="comentarios" name="comentarios" rows="4" required></textarea>

        <button type="submit">Enviar</button>
    </form>
</div>

</body>
</html>
