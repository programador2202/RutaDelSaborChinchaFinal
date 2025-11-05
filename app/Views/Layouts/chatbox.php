<style>
/* 🌐 Chatbox general */
#chatbot {
  position: fixed;
  bottom: 90px;
  right: 25px;
  width: 380px;
  max-height: 600px;
  display: none;
  flex-direction: column;
  border-radius: 18px;
  overflow: hidden;
  background: rgba(255, 255, 255, 0.85);
  backdrop-filter: blur(15px);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
  border: 1px solid rgba(255, 255, 255, 0.3);
  font-family: 'Poppins', sans-serif;
  transition: all 0.3s ease-in-out;
  z-index: 999999 !important;
}

/* 🟦 Encabezado */
#chatbot-header {
  background: linear-gradient(135deg, #007bff, #00bcd4);
  color: #fff;
  padding: 14px 18px;
  font-weight: 600;
  font-size: 16px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
#chatbot-header button {
  background: transparent;
  border: none;
  color: #fff;
  font-size: 22px;
  cursor: pointer;
  transition: transform 0.2s ease;
}
#chatbot-header button:hover {
  transform: scale(1.2);
}

/* 💬 Contenedor de mensajes */
#chatbot-messages {
  flex: 1;
  padding: 20px;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  gap: 10px;
  background: rgba(255, 255, 255, 0.9);
}

/* ✍️ Input */
#chatbot-form {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px;
  background: rgba(255,255,255,0.9);
  border-top: 1px solid rgba(0,0,0,0.1);
}
#chatbot-input {
  flex: 1;
  border: none;
  border-radius: 25px;
  padding: 14px 20px;
  background: rgba(255,255,255,0.9);
  outline: none;
  font-size: 14px;
}
#chatbot-input:focus {
  background: #fff;
  box-shadow: 0 0 5px rgba(0,123,255,0.4);
}
#chatbot-form button {
  background: linear-gradient(135deg, #007bff, #00bcd4);
  border: none;
  color: #fff;
  width: 44px;
  height: 44px;
  border-radius: 50%;
  font-size: 18px;
  cursor: pointer;
  transition: all 0.3s ease;
}
#chatbot-form button:hover {
  transform: scale(1.1);
}

/* 💭 Mensajes */
.chat-message {
  max-width: 90%;
  padding: 10px 14px;
  border-radius: 16px;
  font-size: 14px;
  line-height: 1.4;
  word-wrap: break-word;
  animation: fadeIn 0.3s ease;
}
.chat-message.user {
  background: linear-gradient(135deg, #007bff, #00bcd4);
  color: #fff;
  align-self: flex-end;
  border-bottom-right-radius: 5px;
  box-shadow: 0 4px 8px rgba(0,123,255,0.2);
}
.chat-message.bot {
  background: #fff;
  color: #333;
  align-self: flex-start;
  border-bottom-left-radius: 5px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* 🔘 Botones dentro del chat */
.chat-message button.chat-option {
  margin-top: 6px;
  padding: 7px 13px;
  cursor: pointer;
  border: 1px solid #007bff;
  border-radius: 20px;
  background: #fff;
  color: #007bff;
  font-size: 13px;
  transition: all 0.3s ease;
}
.chat-message button.chat-option:hover {
  background: #007bff;
  color: #fff;
}

/* ⚡ Botón flotante */
#chatbot-fab {
  position: fixed;
  bottom: 25px;
  right: 25px;
  width: 65px;
  height: 65px;
  border-radius: 50%;
  border: none;
  font-size: 28px;
  cursor: pointer;
  background: linear-gradient(135deg, #007bff, #00bcd4);
  color: #fff;
  box-shadow: 0 8px 25px rgba(0,0,0,0.25);
  transition: all 0.3s ease;
  z-index: 999999 !important;
}
#chatbot-fab:hover {
  transform: scale(1.1) rotate(6deg);
}

/* 🔮 Animaciones */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(8px); }
  to { opacity: 1; transform: translateY(0); }
}

/* 📱 Responsive móvil */
@media (max-width: 576px) {
  #chatbot {
    width: 90%;
    right: 5%;
    bottom: 80px;
    max-height: 80%;
  }
  #chatbot-fab {
    bottom: 20px;
    right: 20px;
    width: 55px;
    height: 55px;
    font-size: 22px;
  }
}
</style>


<!-- 💬 Botón flotante -->
<button id="chatbot-fab"><i class="fas fa-comment-dots"></i></button>

<!-- 🧠 Ventana del Chat -->
<div id="chatbot">
  <div id="chatbot-header">
    <span>🤖 Chat Asistente</span>
    <button id="chatbot-close">&times;</button>
  </div>
  <div id="chatbot-messages"></div>
  <form id="chatbot-form">
    <input type="text" id="chatbot-input" placeholder="Escribe tu mensaje..." autocomplete="off">
    <button type="submit"><i class="fas fa-paper-plane"></i></button>
  </form>
</div>

<!-- 🧩 Variables globales y script -->
<script>
  window.chatUrl = "<?= base_url('/chat') ?>";
</script>
<script src="<?= base_url('assets/js/chat.js') ?>"></script>
