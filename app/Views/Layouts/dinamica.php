  <style>
    #carrito-notificaciones div {
    opacity: 1;
    transform: translateY(0);
}

    #carrito-fab {
  position: fixed;
  bottom: 100px;
  right: 32px;
  background:#28a745;
  color:#fff;
  border-radius:50%;
  width:56px;
  height:56px;
  display:flex;
  justify-content:center;
  align-items:center;
  font-size:1.5rem;
  cursor:pointer;
  z-index:10000;
  box-shadow:0 4px 12px rgba(0,0,0,0.2);
}

#carrito-window {
  display:none;
  position:fixed;
  bottom:170px;
  right:32px;
  width:360px;
  max-width:90%;
  background:#fff;
  border-radius:16px;
  box-shadow:0 4px 16px rgba(0,0,0,0.2);
  z-index:10000;
  overflow:hidden;
  flex-direction:column;
}

#carrito-items .carrito-item {
  display:flex;
  justify-content:space-between;
  margin-bottom:8px;
  padding:6px 8px;
  border-radius:8px;
  background:#f8f9fa;
}
#carrito-items .carrito-item span {
  font-weight:bold;
}

    #chatbot-fab {
  position: fixed;
  bottom: 32px;
  right: 32px;
  background:#007baf;
  color:#fff;
  border-radius:50%;
  width:56px;
  height:56px;
  display:flex;
  justify-content:center;
  align-items:center;
  font-size:1.5rem;
  cursor:pointer;
  z-index:10000;
  box-shadow:0 4px 12px rgba(0,0,0,0.2);
}

#chatbot-window {
  display:none;
  position:fixed;
  bottom:100px;
  right:32px;
  width:360px;
  max-width:90%;
  background:#fff;
  border-radius:16px;
  box-shadow:0 4px 16px rgba(0,0,0,0.2);
  z-index:10000;
  overflow:hidden;
  flex-direction:column;
}

#chatbot-messages {
  height:260px;
  overflow-y:auto;
  padding:12px;
  font-size:0.95rem;
}

.chat-msg {
  margin-bottom:10px;
  padding:8px 12px;
  border-radius:12px;
  max-width:80%;
  word-wrap:break-word;
}

.chat-user {
  background:#d1e7ff;
  align-self:flex-end;
}

.chat-bot {
  background:#f1f1f1;
  align-self:flex-start;
}

.chat-btn {
  display:inline-block;
  margin-top:6px;
  margin-right:6px;
  padding:4px 10px;
  background:#007baf;
  color:#fff;
  border:none;
  border-radius:6px;
  cursor:pointer;
  font-size:0.85rem;
}



  </style>
  
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />


<!-- Chat -->
  <a href="#" id="chatbot-fab" title="Chat inteligente"><i class="fas fa-robot"></i></a>
  <div id="chatbot-window">
    <div style="background:#007baf; color:#fff; padding:12px; font-weight:bold;">
      Chat Inteligente
      <span style="float:right; cursor:pointer;" onclick="document.getElementById('chatbot-window').style.display='none'">&times;</span>
    </div>
    <div id="chatbot-messages"></div>
    <form id="chatbot-form" style="display:flex; border-top:1px solid #eee;">
      <input type="text" id="chatbot-input" autocomplete="off" placeholder="Escribe tu consulta..." style="flex:1; border:none; padding:10px;">
      <button type="submit" style="background:#007baf; color:#fff; border:none; padding:0 16px;">Enviar</button>
    </form>
  </div>

<!-- Carrito flotante con badge -->
<a href="#" id="carrito-fab" title="Carrito de pedidos" style="position:fixed; bottom:100px; right:32px; z-index:10000; display:flex; align-items:center; justify-content:center; width:56px; height:56px; border-radius:50%; background:#28a745; color:#fff; font-size:1.5rem; cursor:pointer; box-shadow:0 4px 12px rgba(0,0,0,0.2);">
  <i class="fas fa-shopping-cart"></i>
  <span id="carrito-badge" style="position:absolute; top:-5px; right:-5px; background:red; color:white; font-size:0.75rem; width:20px; height:20px; display:flex; align-items:center; justify-content:center; border-radius:50%; font-weight:bold;">0</span>
</a>

<div id="carrito-window" style="display:none; position:fixed; bottom:170px; right:32px; width:360px; max-width:90%; background:#fff; border-radius:16px; box-shadow:0 4px 16px rgba(0,0,0,0.2); z-index:10000; overflow:hidden; flex-direction:column;">
  <div id="carrito-notificaciones" style="position:absolute; top:-60px; right:0; width:100%; display:flex; flex-direction:column; align-items:flex-end; z-index:1001;"></div>

  <div style="background:#28a745; color:#fff; padding:12px; font-weight:bold; display:flex; justify-content:space-between; align-items:center;">
    Carrito de pedidos
    <span style="cursor:pointer;" onclick="toggleCarrito()">&times;</span>
  </div>
  
  <div id="carrito-items" style="height:260px; overflow-y:auto; padding:12px;"></div>
  <div style="padding:10px; border-top:1px solid #eee;">
    <button id="enviarWhatsApp" class="btn btn-success w-100">Enviar por WhatsApp</button>
  </div>
</div>