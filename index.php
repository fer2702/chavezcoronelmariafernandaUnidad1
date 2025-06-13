<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Soldaduras y Gases Express</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .fade-in {
      animation: fadeIn 1.5s ease-in-out;
    }
    @keyframes fadeIn {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    /* Para darle efecto dinámico a botones */
    .btn-primary:hover {
      background-color: #FF6700 !important; /* naranja intenso */
      box-shadow: 0 0 8px #FF6700;
      transform: scale(1.05);
      transition: all 0.3s ease;
    }
    .btn-secondary:hover {
      background-color: #27AE60 !important; /* verde intenso */
      box-shadow: 0 0 8px #27AE60;
      transform: scale(1.05);
      transition: all 0.3s ease;
    }
  </style>
</head>
<body class="bg-black min-h-screen flex flex-col font-sans text-white">

  <!-- NAVBAR -->
  <nav class="bg-gray-900 bg-opacity-95 p-4 flex items-center justify-between shadow-lg">
    <div class="text-2xl font-extrabold tracking-wide text-orange-500 select-none">🔥 Gases Express</div>
    <div class="space-x-6 hidden md:flex">
      <a href="index.php" class="text-white hover:text-orange-400 transition">Inicio</a>
      <a href="#nosotros" class="text-white hover:text-orange-400 transition">Nosotros</a>
      <a href="servicios.php" class="text-white hover:text-orange-400 transition">Servicios</a>
      <a href="chat_bot.php" class="text-white hover:text-orange-400 transition">Chat bot</a>
    </div>
    <button 
      class="btn-primary bg-orange-600 px-5 py-2 rounded-full font-semibold text-white hover:bg-orange-500 transition shadow-md"
      onclick="window.location.href='login.php'">
      Iniciar Sesión
    </button>

  </nav>

  <!-- CONTENIDO PRINCIPAL -->
  <main class="flex-grow flex items-center justify-center px-6">
    <div class="fade-in p-10 bg-gray-900 bg-opacity-80 rounded-3xl shadow-2xl max-w-lg w-full text-center">
      <h1 class="text-5xl font-bold mb-5 text-orange-500 drop-shadow-lg">¡Bienvenido!</h1>
      <p class="mb-8 text-lg text-gray-300">Explora nuestros servicios de soldaduras y gases industriales con calidad y confianza.</p>
      <button
        id="clickMeBtn"
        class="btn-secondary bg-green-600 px-8 py-3 rounded-full font-bold text-white shadow-md hover:bg-green-500 transition transform duration-300"
        onclick="window.location.href='registro.php'"
      >
        Registrarme
      </button>
      <p id="responseText" class="mt-6 text-sm opacity-0 text-green-400 transition-opacity duration-700"></p>
    </div>
  </main>

  <!-- FOOTER -->
  <footer class="bg-gray-900 bg-opacity-95 text-center text-sm p-5 mt-12 text-gray-400 select-none">
    © 2025 Soldaduras y Gases Express. Todos los derechos reservados.
  </footer>

  <script>
    const btn = document.getElementById('clickMeBtn');
    const text = document.getElementById('responseText');
    btn.addEventListener('click', () => {
      text.textContent = "¡Gracias por registrarte!";
      text.classList.remove('opacity-0');
      text.classList.add('opacity-100');
    });
  </script>

</body>
</html>




