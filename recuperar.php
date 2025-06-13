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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST['correo'];

    // Verificar si el correo existe en la base de datos
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($usuario = $result->fetch_assoc()) {
        // Crear un token único
        $token = bin2hex(random_bytes(32));
        $token_expira = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Guardar token en base de datos
        $sql_token = "UPDATE usuarios SET token_recuperacion=?, token_expira=? WHERE correo=?";
        $stmt_token = $conn->prepare($sql_token);
        $stmt_token->bind_param("sss", $token, $token_expira, $correo);
        $stmt_token->execute();

        // Enviar correo con el link de recuperación
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mariafernandachavezcoronel11@gmail.com';
            $mail->Password = 'mjof qxud ulfd fzxj'; // App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('GasesySoldadurasExpress@gmail.com', 'Soporte');
            $mail->addAddress($correo);

            $mail->isHTML(true);
            $mail->Subject = 'Recuperar contraseña';
            $mail->Body = "
                <p>Hola, {$usuario['usuario']}.</p>
                <p>Hemos recibido una solicitud para restablecer tu contraseña.</p>
                <p><a href='http://localhost/gs/reset_password.php?token=$token'>Haz clic aquí para cambiar tu contraseña</a></p>
                <p>Este enlace es válido por 1 hora.</p>
            ";

            $mail->send();
            $mensaje = "📧 Se ha enviado un enlace de recuperación a tu correo.";
        } catch (Exception $e) {
            $mensaje = "❌ Error al enviar correo: {$mail->ErrorInfo}";
        }
    } else {
        $mensaje = "⚠️ El correo no está registrado.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #121212;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            background-color: #1f1f1f;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px #ff6600;
        }
        input {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 12px;
            border-radius: 10px;
            border: none;
        }
        input[type=submit] {
            background-color: #ff6600;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }
        a {
            color: #ffcc33;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>Recuperar Contraseña</h2>
        <?php if ($mensaje) echo "<p>$mensaje</p>"; ?>
        <form method="POST">
            <input type="email" name="correo" placeholder="Correo registrado" required>
            <input type="submit" value="Enviar enlace">
        </form>
        <p><a href="login.php">← Volver al inicio</a></p>
    </div>
</body>
</html>
