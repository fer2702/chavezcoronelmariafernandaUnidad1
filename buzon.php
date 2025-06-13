<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_SESSION["usuario"];
    $correo = $_POST["correo"];
    $asunto = $_POST["asunto"];
    $contenido = $_POST["mensaje"];

    // Aquí iría la conexión a DB para guardar el mensaje
    // Ejemplo simplificado sin DB: solo confirmación

    if (!empty($correo) && !empty($asunto) && !empty($contenido)) {
        // Aquí guardar en la base de datos o enviar email a soporte
        $mensaje = "¡Mensaje enviado correctamente! Gracias por contactarnos, $usuario.";
    } else {
        $mensaje = "Por favor, completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Buzón - Soldaduras y Gases Express</title>
<style>
    body { background: #121212; color: #fff; font-family: 'Segoe UI', sans-serif; padding: 20px; }
    form { background: #1f1f1f; padding: 20px; border-radius: 12px; max-width: 500px; margin: auto; }
    label { display: block; margin-top: 15px; font-weight: 600; }
    input, select, textarea {
        width: 100%; padding: 10px; margin-top: 6px; border-radius: 8px; border: none; background: #222; color: #fff;
        font-size: 1rem;
    }
    textarea { resize: vertical; height: 120px; }
    button {
        margin-top: 20px; background: #ff6600; border: none; padding: 14px; border-radius: 25px; cursor: pointer;
        color: #121212; font-weight: 700; font-size: 1rem; transition: background 0.3s;
    }
    button:hover { background: #e65c00; }
    .mensaje { text-align: center; margin-top: 15px; color: #ffcc33; font-weight: 600; }
</style>
</head>
<body>
    <h1>Buzón de Mensajes</h1>
    <form method="POST">
        <label>Usuario</label>
        <input type="text" value="<?php echo htmlspecialchars($_SESSION["usuario"]); ?>" readonly>

        <label>Correo electrónico</label>
        <input type="email" name="correo" placeholder="Tu correo para respuesta" required>

        <label>Asunto</label>
        <select name="asunto" required>
            <option value="">-- Selecciona un asunto --</option>
            <option value="Sugerencia">Sugerencia</option>
            <option value="Queja">Queja</option>
            <option value="Consulta">Consulta</option>
            <option value="Otro">Otro</option>
        </select>

        <label>Mensaje</label>
        <textarea name="mensaje" placeholder="Escribe tu mensaje aquí..." required></textarea>

        <button type="submit">Enviar mensaje</button>
           <a href="login.php" class="btn-inicio"> Salir</a>
    </form>

    <?php if ($mensaje): ?>
        <p class="mensaje"><?php echo $mensaje; ?></p>
    <?php endif; ?>
</body>
</html>
