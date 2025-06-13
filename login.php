<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "seguridad_bd";

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST["correo"];
    $password = $_POST["contrasena"];

    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($password, $usuario["password"])) {
            $_SESSION["usuario"] = $usuario["usuario"];
            header("Location: bienvenida.php"); // Página de destino tras login exitoso
            exit();
        } else {
            $mensaje = "⚠️ Contraseña incorrecta.";
        }
    } else {
        $mensaje = "⚠️ El correo no está registrado.";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Iniciar Sesión</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #121212;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .container {
            background-color: #1f1f1f;
            padding: 40px 35px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(255, 102, 0, 0.7);
            width: 100%;
            max-width: 420px;
            text-align: center;
            border: 2px solid #ff6600;
        }

        h2 {
            color: #ff6600;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 2rem;
            text-shadow: 0 0 8px #ffcc33;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 14px 16px;
            margin: 12px 0;
            border: 2px solid #333;
            border-radius: 12px;
            font-size: 16px;
            background-color: #222;
            color: #fff;
            font-weight: 500;
            transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        input:focus {
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
            margin-top: 15px;
            font-weight: 600;
            box-shadow: 0 0 10px #ff6600;
        }

        input[type="submit"]:hover {
            background-color: #e65c00;
            transform: scale(1.05);
            box-shadow: 0 0 20px #ffcc33;
        }

        p.mensaje {
            margin-top: 20px;
            font-weight: 600;
            color: #ffcc33;
            font-size: 0.95rem;
            text-shadow: 0 0 5px #ffcc33;
        }

        .top-bar {
            margin-top: 18px;
        }

        .btn-inicio {
            display: inline-block;
            padding: 10px 24px;
            background-color: #333;
            color: #ff6600;
            font-weight: 600;
            border-radius: 25px;
            text-decoration: none;
            box-shadow: 0 0 8px #ff6600;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-inicio:hover {
            background-color: #ffcc33;
            color: #121212;
            box-shadow: 0 0 15px #ffcc33;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Iniciar Sesión</h2>
        <?php if ($mensaje) echo "<p class='mensaje'>$mensaje</p>"; ?>
        <form method="POST">
            <input type="email" name="correo" placeholder="📧 Correo electrónico" required>
            <input type="password" name="contrasena" placeholder="🔒 Contraseña" required>
            <input type="submit" value="Entrar">
            <div class="top-bar">
                <a href="registro.php" class="btn-inicio">📝 Registrarse</a>
            </div>
            <div class="top-bar">
                <a href="recuperar.php" class="btn-inicio">🔒 ¡Olvidaste tu contraseña?</a>
            </div>
        </form>
    </div>
</body>
</html>
