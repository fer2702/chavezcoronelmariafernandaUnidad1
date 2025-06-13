<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Página de Bienvenida</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #121212;
            color: #fff;
        }

        nav {
            background-color: #1f1f1f;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 0 10px #ff6600;
        }

        nav .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ff6600;
        }

        nav .menu a {
            color: #fff;
            margin: 0 12px;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 8px;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        nav .menu a:hover {
            background-color: #ff6600;
            color: #121212;
        }

        .container {
            padding: 40px 30px;
        }

        h1 {
            color: #ffcc33;
            margin-bottom: 20px;
        }

        .gases-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 30px;
        }

        .gases-info img {
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 0 15px #ff6600;
        }

        .gases-info p {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #1f1f1f;
            color: #aaa;
            margin-top: 50px;
        }

        /* Estilos para el contacto flotante */
        #contacto-info {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        #contacto-info details {
            background-color: #1f1f1f;
            border: 2px solid #ff6600;
            border-radius: 12px;
            padding: 10px;
            width: 280px;
            box-shadow: 0 0 12px rgba(255, 102, 0, 0.6);
        }

        #contacto-info summary {
            color: #ffcc33;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            list-style: none;
        }

        /* Quitar el triángulo predeterminado de summary */
        #contacto-info summary::-webkit-details-marker {
            display: none;
        }

        #contacto-info summary::marker {
            content: '';
        }

        #contacto-info div {
            margin-top: 10px;
            color: #fff;
            font-size: 14px;
        }

        #contacto-info a {
            color: #ffcc33;
            text-decoration: none;
        }

        #contacto-info a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">Soldaduras y Gases Express</div>
        <div class="menu">
            <a href="buzon.php">📩 Buzón</a>
            <a href="ayuda.php">❓ Ayuda</a>
            <a href="#" id="abrir-contacto">📞 Contáctanos</a>
            <a href="recuperar.php">🔑 Recuperar contraseña</a>
            <a href="chat_bot.php">💬 Chat</a>
             <a href="index.php">Cerrar</a>
        </div>
    </nav>

    <div class="container">
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION["usuario"]); ?> 👋</h1>

        <div class="gases-info">
            <div>
                <h2>¿Qué son los gases industriales?</h2>
                <p>
                    Los gases industriales son sustancias en estado gaseoso que se producen para su uso en la industria.
                    Entre los más comunes están el oxígeno, nitrógeno, argón, dióxido de carbono, hidrógeno y acetileno.
                    Se utilizan en soldaduras, cortes, procesos químicos, refrigeración y más.
                </p>
                <p>
                    En Soldaduras y Gases Express, ofrecemos soluciones seguras y eficientes para tus necesidades en el sector automotriz, metalmecánico, hospitalario y alimenticio.
                </p>
            </div>
            <div>
                <img src="img/logo.jpg" alt="Logo de la empresa" />
            </div>
        </div>
    </div>

    <footer>
        &copy; 2025 Soldaduras y Gases Express. Todos los derechos reservados.
    </footer>

    <div id="contacto-info">
        <details>
            <summary>📞 Contáctanos</summary>
            <div>
                <p><strong>Teléfono:</strong> 844 326 33 06</p>
                <p><strong>Correo:</strong> <a href="mailto:soldadurasygasesexpress@gmail.com">soldadurasygasesexpress@gmail.com</a></p>
                <p><strong>Sitio Web:</strong> <a href="https://www.soldadurasygasesexpress.com" target="_blank" rel="noopener noreferrer">soldadurasygasesexpress.com</a></p>
            </div>
        </details>
    </div>

    <script>
        document.getElementById('abrir-contacto').addEventListener('click', function(e) {
            e.preventDefault();
            const contactoDetails = document.querySelector('#contacto-info details');
            if (contactoDetails) {
                contactoDetails.open = true;
                contactoDetails.scrollIntoView({ behavior: 'smooth' });
            }
        });
    </script>
</body>
</html>
