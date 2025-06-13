<?php
$conexion = new mysqli("localhost", "root", "", "seguridad_bd");
$conexion->set_charset("utf8mb4");

$mensaje = "";
$colorMensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST["correo"];
    $nueva = $_POST["nueva_contrasena"];
    $hash = password_hash($nueva, PASSWORD_DEFAULT);

    $stmt = $conexion->prepare("UPDATE usuarios SET password = ? WHERE correo = ?");
    $stmt->bind_param("ss", $hash, $correo);

    if ($stmt->execute()) {
        $mensaje = "✅ Contraseña actualizada correctamente.";
        $colorMensaje = "#00ff99";
    } else {
        $mensaje = "❌ Error al actualizar la contraseña.";
        $colorMensaje = "red";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Actualizar Contraseña</title>
<style>
    body {
        background-color: #121212;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        color: #fff;
    }
    .container {
        background-color: #1f1f1f;
        padding: 35px 30px;
        border-radius: 20px;
        box-shadow: 0 0 20px #ff6600;
        width: 100%;
        max-width: 400px;
        text-align: center;
        border: 2px solid #ff6600;
    }
    h2 {
        color: #ff6600;
        margin-bottom: 25px;
    }
    input[type="password"] {
        width: 100%;
        padding: 14px;
        margin-bottom: 15px;
        border-radius: 12px;
        border: 2px solid #333;
        background-color: #222;
        color: #fff;
        font-size: 16px;
        font-weight: 500;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    input[type="password"]:focus {
        border-color: #ffcc33;
        box-shadow: 0 0 10px #ffcc33;
        outline: none;
        background-color: #121212;
    }
    input[type="submit"] {
        background-color: #ff6600;
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 25px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        box-shadow: 0 0 10px #ff6600;
        transition: background-color 0.3s ease;
    }
    input[type="submit"]:hover {
        background-color: #e65c00;
    }
    p.message {
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 15px;
    }
    a.link {
        color: #ffcc33;
        font-weight: 600;
        text-decoration: none;
    }
    a.link:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>
    <div class="container">
        <h2>Actualizar Contraseña</h2>
        <?php if ($mensaje): ?>
            <p class="message" style="color: <?= $colorMensaje ?>;"><?= htmlspecialchars($mensaje) ?></p>
            <?php if ($colorMensaje === "#00ff99"): ?>
                <a href="login.php" class="link">Ir al inicio de sesión</a>
            <?php endif; ?>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="hidden" name="correo" value="<?= htmlspecialchars($_GET['correo'] ?? '') ?>">
        
            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>

