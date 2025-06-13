<?php
$conexion = new mysqli("localhost", "root", "", "seguridad_bd");
$conexion->set_charset("utf8mb4");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST["correo"];

    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        header("Location: nueva_contrasena.php?correo=" . urlencode($correo));
        exit();
    } else {
        echo "<p style='color: red; font-family: sans-serif;'>❌ El correo no está registrado.</p>";
        echo "<a href='recuperar.php' style='color: #ffcc33;'>Volver</a>";
    }

    $stmt->close();
}
?>
