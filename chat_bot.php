<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Chatbot de Soldaduras y Gases</title>
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #121212;
      color: #e0e0e0;
      display: flex;
      flex-direction: column;
      height: 100vh;
    }
    main {
      flex-grow: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .chat-container {
      width: 360px;
      background-color: #1f1f1f;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(255, 102, 0, 0.6);
      display: flex;
      flex-direction: column;
      height: 480px;
    }
    #chat {
      flex-grow: 1;
      padding: 10px 14px;
      overflow-y: auto;
      font-size: 13px;
      line-height: 1.3;
      display: flex;
      flex-direction: column;
      gap: 8px;
      border-bottom: 1px solid #333;
    }
    #chat p {
      max-width: 70%;
      padding: 8px 12px;
      border-radius: 12px;
      word-break: break-word;
    }
    .bot-message {
      background-color: #ff6600;
      color: #121212;
      align-self: flex-start;
    }
    .user-message {
      background-color: #333333;
      color: #f0f0f0;
      align-self: flex-end;
    }
    form#input-area {
      display: flex;
      gap: 8px;
      padding: 12px;
    }
    form#input-area input[type="text"] {
      flex-grow: 1;
      padding: 8px 12px;
      border-radius: 10px;
      border: 1px solid #444;
      background-color: #222;
      color: #eee;
      font-size: 14px;
    }
    form#input-area input[type="text"]:focus {
      outline: none;
      border-color: #ff6600;
    }
    form#input-area button {
      padding: 8px 16px;
      background-color: #ff6600;
      border: none;
      border-radius: 10px;
      font-weight: 600;
      color: #121212;
      cursor: pointer;
    }
    form#input-area button:hover {
      background-color: #e65c00;
    }
    #chat::-webkit-scrollbar {
      width: 8px;
    }
    #chat::-webkit-scrollbar-track {
      background: #1f1f1f;
    }
    #chat::-webkit-scrollbar-thumb {
      background-color: #ff6600;
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <main>
    <div class="chat-container">
      <div id="chat">
        <p class="bot-message">¡Hola! Soy tu asistente experto en soldaduras y gases. ¿En qué puedo ayudarte?</p>
      </div>
      <form id="input-area">
        <input type="text" id="user-input" placeholder="Escribe tu pregunta..." autocomplete="off" />
        <button type="submit">Enviar</button>
      </form>
    </div>
     <a href="login.php" class="btn-inicio">Iniciar sesión</a>
  </main>

  <script>
    const chat = document.getElementById('chat');
    const input = document.getElementById('user-input');
    const form = document.getElementById('input-area');

    function agregarMensaje(mensaje, tipo) {
      const p = document.createElement('p');
      p.textContent = mensaje;
      p.className = tipo === 'bot' ? 'bot-message' : 'user-message';
      chat.appendChild(p);
      chat.scrollTop = chat.scrollHeight;
    }

    function obtenerRespuesta(pregunta) {
      const msg = pregunta.toLowerCase();

      if (msg.includes("horario")) {
        return "Nuestro horario es de lunes a sábado, de 8am a 6pm.";
      }
      if (msg.includes("gas") || msg.includes("gases")) {
        return "Contamos con gases industriales como oxígeno, acetileno, argón y CO2.";
      }
      if (msg.includes("soldadura") || msg.includes("electrodo")) {
        return "Ofrecemos soldaduras TIG, MIG y por arco. También vendemos electrodos y varillas.";
      }
      if (msg.includes("precio") || msg.includes("costo")) {
        return "Los precios varían según el producto. ¿Qué te interesa específicamente?";
      }
      if (msg.includes("envío") || msg.includes("entrega")) {
        return "Ofrecemos envíos locales y entregas el mismo día en pedidos mayores a $1,000.";
      }
      if (msg.includes("gracias") || msg.includes("thank")) {
        return "¡Con gusto! Si necesitas más ayuda, aquí estaré.";
      }

      return "Lo siento, no entendí tu mensaje. ¿Podrías formularlo de otra manera?";
    }

    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const mensaje = input.value.trim();
      if (!mensaje) return;
      agregarMensaje(mensaje, 'user');
      input.value = '';

      setTimeout(() => {
        const respuesta = obtenerRespuesta(mensaje);
        agregarMensaje(respuesta, 'bot');
      }, 500);
    });
  </script>
</body>
</html>
