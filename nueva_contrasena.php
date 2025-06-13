<?php
if (!isset($_GET["correo"])) {
    die("Acceso no permitido.");
}
$correo = $_GET["correo"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #1f1f1f;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 15px #ff6600;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border-radius: 10px;
            border: none;
            font-size: 16px;
        }

        input[type="password"] {
            background-color: #333;
            color: white;
        }

        input[type="submit"] {
            background-color: #ff6600;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #e65c00;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Ingresar Nueva Contraseña</h2>
    <form method="POST" action="actualizar_contrasena.php">
        <input type="hidden" name="correo" value="<?php echo htmlspecialchars($correo); ?>">
        <input type="password" name="nueva_contrasena" placeholder="🔒 Nueva contraseña" required>
        <input type="submit" value="Actualizar contraseña">
    </form>
</div>
</body>
</html>
