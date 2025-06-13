<?php 
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Ayuda - Plataforma</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #121212;
            color: #fff;
            margin: 0;
            padding: 20px 40px;
        }
        h1 {
            color: #ff6600;
            text-align: center;
        }
        .accordion {
            max-width: 800px;
            margin: 20px auto;
            background-color: #1f1f1f;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(255, 102, 0, 0.6);
        }
        .accordion-item {
            border-bottom: 1px solid #333;
        }
        .accordion-header {
            background-color: #222;
            cursor: pointer;
            padding: 18px 20px;
            font-weight: 600;
            color: #ffcc33;
            user-select: none;
            transition: background-color 0.3s ease;
        }
        .accordion-header:hover {
            background-color: #ff6600;
            color: #121212;
        }
        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease;
            background-color: #1f1f1f;
            padding: 0 20px;
            color: #ddd;
        }
        .accordion-content p {
            margin: 15px 0;
            line-height: 1.6;
        }
        .accordion-content ul {
            padding-left: 20px;
        }
        /* Botón salir */
        .btn-salir {
            display: block;
            max-width: 100px;
            margin: 30px auto 0 auto;
            padding: 10px 15px;
            background-color: #ff6600;
            color: #121212;
            font-weight: bold;
            text-align: center;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }
        .btn-salir:hover {
            background-color: #ff3300;
            color: white;
        }
    </style>
</head>
<body>

<h1>Centro de Ayuda</h1>

<div class="accordion">

    <div class="accordion-item">
        <div class="accordion-header">¿Cómo me registro?</div>
        <div class="accordion-content">
            <p>Haz clic en "Registrarse", llena el formulario y confirma tu correo electrónico para activar tu cuenta.</p>
        </div>
    </div>

    <div class="accordion-item">
        <div class="accordion-header">¿Olvidé mi contraseña, qué hago?</div>
        <div class="accordion-content">
            <p>Usa la opción "Recuperación de contraseña" en el menú para restablecer tu contraseña ingresando tu correo.</p>
        </div>
    </div>

    <div class="accordion-item">
        <div class="accordion-header">¿Cómo envío un mensaje en el buzón?</div>
        <div class="accordion-content">
            <p>Ve al buzón y usa el formulario para escribir y enviar mensajes al equipo de soporte.</p>
        </div>
    </div>

    <div class="accordion-item">
        <div class="accordion-header">Contacto</div>
        <div class="accordion-content">
            <p>Si tienes dudas adicionales, escríbenos a <a href="mailto:soldadurasygasesexpress@gmail.com" style="color:#ffcc33;">soldadurasygasesexpress@gmail.com</a> o usa el formulario en "Contáctanos".</p>
        </div>
    </div>

</div>

<!-- Botón para cerrar sesión -->
<a href="index.php" class="btn-salir">Salir</a>

<script>
    // Script para que el accordion abra/cierre contenido
    const headers = document.querySelectorAll('.accordion-header');

    headers.forEach(header => {
        header.addEventListener('click', () => {
            const currentlyActive = document.querySelector('.accordion-header.active');
            if (currentlyActive && currentlyActive !== header) {
                currentlyActive.classList.remove('active');
                currentlyActive.nextElementSibling.style.maxHeight = 0;
            }

            header.classList.toggle('active');
            const content = header.nextElementSibling;
            if (header.classList.contains('active')) {
                content.style.maxHeight = content.scrollHeight + "px";
            } else {
                content.style.maxHeight = 0;
            }
        });
    });
</script>

</body>
</html>

