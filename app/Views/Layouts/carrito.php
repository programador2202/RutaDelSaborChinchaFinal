<!-- 🔗 Librerías -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
#carrito-fab {
  position: fixed;
  bottom: 100px;
  right: 32px;
  background: #28a745;
  color: #fff;
  border-radius: 50%;
  width: 56px;
  height: 56px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 1.5rem;
  cursor: pointer;
  z-index: 10000;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  transition: transform 0.2s ease;
}
#carrito-fab:hover { transform: scale(1.1); }

#carrito-badge {
  position: absolute;
  top: -5px;
  right: -5px;
  background: red;
  color: white;
  font-size: 0.75rem;
  width: 20px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  font-weight: bold;
}

/* ====== VENTANA CARRITO ====== */
#carrito-window {
  display: none;
  position: fixed;
  bottom: 170px;
  right: 32px;
  width: 360px;
  max-width: 90%;
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 4px 16px rgba(0,0,0,0.2);
  z-index: 10000;
  overflow: hidden;
  flex-direction: column;
}
#carrito-header {
  background: #28a745;
  color: #fff;
  padding: 12px;
  font-weight: bold;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
#carrito-items {
  height: 260px;
  overflow-y: auto;
  padding: 12px;
}
#carrito-items .carrito-item {
  display: flex;
  justify-content: space-between;
  margin-bottom: 8px;
  padding: 6px 8px;
  border-radius: 8px;
  background: #f8f9fa;
}

/* Chatbox */
#chatbot {
  position: fixed;
  bottom: 80px;
  right: 20px;
  width: 300px;
  max-height: 400px;
  background: #fff;
  border: 1px solid #ccc;
  border-radius: 10px;
  display: none;
  flex-direction: column;
  overflow: hidden;
  box-shadow: 0 5px 15px rgba(0,0,0,0.3);
  z-index: 9999;
}

/* Header */
#chatbot-header {
  background: #007baf;
  color: #fff;
  padding: 10px;
  font-weight: bold;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

/* Mensajes */
#chatbot-messages {
  flex: 1;
  padding: 10px;
  overflow-y: auto;
}

/* Formulario */
#chatbot-form {
  display: flex;
  border-top: 1px solid #ccc;
}

#chatbot-form input {
  flex: 1;
  border: none;
  padding: 8px;
}

#chatbot-form button {
  border: none;
  background: #007baf;
  color: #fff;
  padding: 0 12px;
  cursor: pointer;
}

/* Botón flotante */
#chatbot-fab {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background: #007baf;
  color: #fff;
  border: none;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  font-size: 24px;
  cursor: pointer;
  z-index: 9999;
}

/* Mensajes */
.chat-message {
  margin-bottom: 8px;
  padding: 6px 10px;
  border-radius: 10px;
  max-width: 85%;
}

.chat-message.user {
  background: #007baf;
  color: #fff;
  align-self: flex-end;
}

.chat-message.bot {
  background: #f1f1f1;
  color: #000;
  align-self: flex-start;
}

.chat-message button.chat-option {
  margin: 2px;
  padding: 4px 8px;
  cursor: pointer;
  border: 1px solid #007baf;
  border-radius: 5px;
  background: #fff;
  color: #007baf;
}

</style>
<!-- ====== FAB CARRITO ====== -->
<a href="#" id="carrito-fab" title="Carrito de pedidos">
  <i class="fas fa-shopping-cart"></i>
  <span id="carrito-badge">0</span>
</a>

<div id="carrito-window">
  <div id="carrito-header">
    Carrito de pedidos
    <span style="cursor:pointer;" onclick="toggleCarrito(false)">&times;</span>
  </div>
  <div id="carrito-items"></div>
  <div style="padding:10px; border-top:1px solid #eee;">
    <button id="enviarWhatsApp" class="btn btn-success w-100">Enviar por WhatsApp</button>
  </div>
</div>

