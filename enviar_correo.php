<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correoDestino = $_POST["correo"];

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';   // Servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'mariafernandachavezcoronel11@gmail.com'; // Cambia esto
        $mail->Password = 'mjof qxud ulfd fzxj'; // Cambia esto
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Remitente y destinatario
        $mail->setFrom('GasesySoldaduras@gmail.com', 'Gases Express'); // Cambia esto
        $mail->addAddress($correoDestino);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Recuperación de contraseña';
        $mail->Body    = '
            <h3>Hola 👋</h3>
            <p>Recibimos una solicitud para restablecer tu contraseña.</p>
            <p><a href="https://tu-sitio.com/restablecer.php?correo=' . urlencode($correoDestino) . '">Haz clic aquí para restablecerla</a></p>
            <p>Si no fuiste tú, puedes ignorar este mensaje.</p>
        ';

        $mail->send();
        echo "<script>alert('📧 Correo enviado correctamente'); window.location.href='login.php';</script>";
    } catch (Exception $e) {
        echo "<p style='color:red;'>❌ Error al enviar el correo: {$mail->ErrorInfo}</p>";
    }
}
?>
