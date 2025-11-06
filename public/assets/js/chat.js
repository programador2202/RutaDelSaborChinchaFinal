document.addEventListener("DOMContentLoaded", () => {
  const chatbotFab = document.getElementById("chatbot-fab");
  const chatbot = document.getElementById("chatbot");
  const chatbotClose = document.getElementById("chatbot-close");
  const chatbotForm = document.getElementById("chatbot-form");
  const chatbotInput = document.getElementById("chatbot-input");
  const chatbotMessages = document.getElementById("chatbot-messages");

  // Verificación de elementos requeridos
  if (!chatbot || !chatbotMessages) {
    console.error("❌ Error: elementos del chatbot no encontrados en el DOM.");
    return;
  }

  // Mostrar / ocultar chat
  chatbotFab?.addEventListener("click", () => {
    const visible = chatbot.style.display === "flex";
    chatbot.style.display = visible ? "none" : "flex";
    if (!visible) chatbotInput?.focus();
  });

  chatbotClose?.addEventListener("click", () => (chatbot.style.display = "none"));

  // 📨 Enviar mensaje manual (usuario escribe)
  chatbotForm?.addEventListener("submit", async (e) => {
    e.preventDefault();
    const mensaje = chatbotInput?.value.trim();
    if (mensaje) await enviarMensaje(mensaje);
  });

  // Función principal para enviar mensaje al servidor
  async function enviarMensaje(mensaje) {
    agregarMensaje(mensaje, "user");
    chatbotInput.value = "";

    const escribiendo = agregarMensaje("Escribiendo...", "bot", true);

    try {
      if (!window.chatUrl) throw new Error("La variable 'window.chatUrl' no está definida.");

      const response = await fetch(window.chatUrl, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ pregunta: mensaje }),
      });

      if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
      const data = await response.json();

      escribiendo.remove();

      // 🗣️ Mostrar respuesta del bot
      agregarMensaje(data.respuesta || "🤖 No se recibió respuesta del servidor.", "bot", false, true);

      // 🧩 Mostrar botones de opciones
      if (Array.isArray(data.opciones) && data.opciones.length > 0) {
        mostrarOpciones(data.opciones);
      }
    } catch (error) {
      console.error("⚠️ Error:", error);
      escribiendo.remove();
      agregarMensaje("⚠️ Error al conectar con el servidor.", "bot");
    }
  }

  //  Agregar mensajes al chat
  function agregarMensaje(texto, tipo = "bot", temporal = false, html = false) {
    const msg = document.createElement("div");
    msg.classList.add("chat-message", tipo);
    msg.innerHTML = html ? texto : escapeHTML(texto);

    chatbotMessages.appendChild(msg);
    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;

    return temporal ? msg : null;
  }

  // 🎯 Mostrar botones de opciones del bot
  function mostrarOpciones(opciones) {
    const container = document.createElement("div");
    container.classList.add("chat-message", "bot");

    opciones.forEach((op) => {
      const btn = document.createElement("button");
      btn.classList.add("chat-option");
      btn.textContent = op;

      btn.addEventListener("click", () => {
        let textoEnviar;

        // Si es “volver al menú principal”
        if (op.toLowerCase().includes("volver al menú") || op.toLowerCase().includes("volver al menu")) {
          textoEnviar = "volver al menú principal";
        }
        //  Si es categoría
        else if (esCategoria(op)) {
          textoEnviar = `platos de ${op}`;
        }
        // Caso general
        else {
          textoEnviar = op;
        }

        chatbotInput.value = textoEnviar;
        chatbotForm?.dispatchEvent(new Event("submit"));
        container.remove(); // eliminar botones antiguos
      });

      container.appendChild(btn);
    });

    chatbotMessages.appendChild(container);
    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
  }

  // 🧩 Detectar si una opción es una categoría
  function esCategoria(texto) {
    const palabrasClave = [
      "restaurantes", "recomendados", "reservar",
      "categorías", "categorias", "platos", "bebidas", "postres"
    ];
    const tieneEmoji = /[⬅️➡️⬆️⬇️]/.test(texto);
    return !palabrasClave.some((p) => texto.toLowerCase().includes(p)) && !tieneEmoji;
  }

  // 🧼 Escapar HTML
  function escapeHTML(str) {
    const div = document.createElement("div");
    div.textContent = str;
    return div.innerHTML;
  }
});
