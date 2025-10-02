<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Negocio;
use App\Models\Locales;
use App\Models\Cartas;

class ChatController extends Controller
{
    public function index()
    {
        $data = $this->request->getJSON(true);
        $pregunta = strtolower(trim($data['pregunta'] ?? ''));

        $respuesta = "Hmm 🤔 no estoy seguro de lo que quieres decir. Puedes preguntar sobre restaurantes, platos o reservas.";

        // Modelos
        $negocioModel = new Negocio();
        $localModel = new Locales();
        $cartasModel = new Cartas();

        // Saludos
        if (preg_match('/hola|buenas|hey|hi/i', $pregunta)) {
            $respuesta = "¡Hola! 👋 Bienvenido a Ruta del Sabor Chincha 🍽️. ¿Qué deseas hacer?";
        }
        // Reservas → WhatsApp
        elseif (preg_match('/reserva|reservar|cita|hacer reserva/i', $pregunta)) {
            $numeroWhatsapp = '+51999999999';
            $mensaje = urlencode("Hola! Quiero hacer una reserva en Ruta del Sabor Chincha 🍽️");
            $link = "https://wa.me/{$numeroWhatsapp}?text={$mensaje}";
            $respuesta = "Para reservar tu mesa haz clic aquí 👉 <a href='{$link}' target='_blank'>Reservar por WhatsApp</a>";
        }
        // Contacto
        elseif (preg_match('/contacto|información|informacion|teléfono|email|correo/i', $pregunta)) {
            $respuesta = "📧 Puedes escribirnos a contacto@rutadelsabor.com o enviarnos un WhatsApp al 📱 +51 999 999 999.";
        }
        // Buscar por plato
        else {
            // Buscar coincidencias en cartas
            $platos = $cartasModel
                ->like('nombreplato', $pregunta)
                ->findAll(5);

            if (!empty($platos)) {
                $lista = [];
                foreach ($platos as $p) {
                    // Obtener el negocio del restaurante
                    $local = $localModel->find($p['idlocales']);
                    $negocio = $negocioModel->find($local['idnegocio']);
                    $link = base_url("/restaurantes/{$negocio['nombrecomercial']}");
                    $lista[] = "{$p['nombreplato']} - {$negocio['nombrecomercial']} - <a href='$link'>Ver</a>";
                }
                $respuesta = "🍽️ Encontré estos platos que coinciden:\n- " . implode("\n- ", $lista);
            } else {
                // Si no hay platos, sugerir restaurantes populares
                $populares = $negocioModel->orderBy('idnegocio','ASC')->findAll(3);
                $lista = [];
                foreach ($populares as $n) {
                    $link = base_url("/restaurantes/{$n['nombrecomercial']}");
                    $lista[] = "{$n['nombrecomercial']} - <a href='$link'>Ver</a>";
                }
                $respuesta = "No encontré coincidencias exactas 😅, pero estos restaurantes son populares:\n- " . implode("\n- ", $lista);
            }
        }

        return $this->response->setJSON(['respuesta' => $respuesta]);
    }
}
