<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$host = "localhost";
$user = "root";
$pass = "";
$db = "seguridad_bd";

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset("utf8mb4");

$mensaje = "";

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar si el token es válido
    $sql = "SELECT * FROM usuarios WHERE token_recuperacion = ? AND token_expira > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($usuario = $result->fetch_assoc()) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nueva_contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);

            // Actualizar la contraseña y eliminar el token
            $sql_update = "UPDATE usuarios SET password = ?, token_recuperacion = NULL, token_expira = NULL WHERE id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("si", $nueva_contrasena, $usuario["id"]);
            $stmt_update->execute();

            $mensaje = "✅ Contraseña actualizada con éxito. <a href='login.php'>Inicia sesión</a>";
        }
    } else {
        $mensaje = "❌ Token inválido o expirado.";
    }
} else {
    $mensaje = "❌ Token no proporcionado.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña</title>
    <style>
        body {
            background-color: #121212;
            color: white;
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            background: #1f1f1f;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ff6600;
        }
        input {
            display: block;
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 10px;
        }
        input[type="submit"] {
            background: #ff6600;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>Restablecer Contraseña</h2>
        <?php if ($mensaje) echo "<p>$mensaje</p>"; ?>
        <?php if (isset($usuario) && !$mensaje): ?>
        <form method="POST">
            <input type="password" name="contrasena" placeholder="Nueva contraseña" required>
            <input type="submit" value="Cambiar contraseña">
        </form>
        <?php endif; ?>
    </div>
</body>
</html>
