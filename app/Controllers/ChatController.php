<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Negocio;
use App\Models\Locales;
use App\Models\Cartas;
use App\Models\Horario;
use App\Models\Reservas;
use App\Models\Categorias;

class ChatController extends Controller
{
    public function index()
    {
        helper(['url', 'text', 'date']);

        $data = $this->request->getJSON(true);
        $pregunta = strtolower(trim($data['pregunta'] ?? ''));

        $negocioModel     = new Negocio();
        $localModel       = new Locales();
        $cartasModel      = new Cartas();
        $horarioModel     = new Horario();
        $reservaModel     = new Reservas();
        $categoriasModel  = new Categorias();

        $categoriasDB = $categoriasModel->findAll();

        $menuPrincipal = [
            "🍽️ Ver Restaurantes",
            "📋 Platos recomendados",
            "🍷 Ver Vinícolas y bebidas",
            "🕒 Reservar mesa",
            "📍 Categorías"
        ];

        // 🔹 Detectar si la entrada coincide con una categoría
        foreach ($categoriasDB as $cat) {
            $nombreCategoria = strtolower($cat['categoria']);
            if ($pregunta === $nombreCategoria) {
                $pregunta = "platos de " . $cat['categoria'];
                break;
            }
        }

        // 👋 SALUDO INICIAL
        if (empty($pregunta) || preg_match('/\b(hola|buenas|inicio|menu|menú|hey|ola)\b/i', $pregunta)) {
            $respuesta = "
            <div style='text-align:center;padding:10px;'>
              <h5>👋 ¡Bienvenido a <b>Ruta del Sabor Chincha</b>!</h5>
              <p>¿Qué deseas hacer hoy?</p>
            </div>";

            return $this->response->setJSON([
                'respuesta' => $respuesta,
                'opciones'  => $menuPrincipal
            ]);
        }

        // 🍷 BEBIDAS / VINÍCOLAS
        if (preg_match('/\b(vino|vinícola|bodega|licor|bebida|bebidas|vitinicolas)\b/i', $pregunta)) {
            $negocios = $negocioModel
                ->select('idnegocio, nombrecomercial, logo')
                ->join('categorias AS c', 'negocios.idcategoria = c.idcategoria')
                ->where('LOWER(c.categoria)', 'vitinicolas')
                ->findAll();

            if (empty($negocios)) {
                $respuesta = "<div style='text-align:center;color:#555;'>🍷 No hay vinícolas o locales de bebidas registrados por el momento.</div>";
            } else {
                $html = "<div style='display:flex;flex-direction:column;gap:10px;'>";
                foreach ($negocios as $n) {
                    $logo = !empty($n['logo']) ? base_url($n['logo']) : base_url('assets/img/default-wine.png');
                    $urlDetalle = base_url("negocios/detalle/{$n['idnegocio']}");
                    $html .= "
                    <div style='border:1px solid #ddd;border-radius:10px;overflow:hidden;background:#fff;box-shadow:0 2px 5px rgba(0,0,0,0.1);'>
                        <img src='{$logo}' style='width:100%;height:130px;object-fit:cover;'>
                        <div style='padding:8px;text-align:center;'>
                            <h6 style='margin:5px 0;font-weight:600;'>{$n['nombrecomercial']}</h6>
                            <a href='{$urlDetalle}' target='_blank' style='display:inline-block;margin-top:4px;padding:5px 10px;font-size:12px;border-radius:6px;background:#8B0000;color:#fff;text-decoration:none;'>Ver vinícola</a>
                        </div>
                    </div>";
                }
                $html .= "</div>";
                $respuesta = $html;
            }

            return $this->response->setJSON([
                'respuesta' => $respuesta,
                'opciones'  => $menuPrincipal
            ]);
        }

        // 🍽️ PLATOS Y CATEGORÍAS
        if (preg_match('/\b(platos|plato|recomendados|comida|menu|carta|enséñame|categorías|categorias)\b/i', $pregunta)) {
            $horaActual = date('H:i:s');
            $localAbierto = $horarioModel
                ->where('diasemana', $this->getDiaSemana())
                ->where('inicio <=', $horaActual)
                ->where('fin >=', $horaActual)
                ->first();

            // 🔹 Buscar categoría dentro del texto
            $categoria = '';
            foreach ($categoriasDB as $cat) {
                $nombreCategoria = strtolower($cat['categoria']);
                if (strpos($pregunta, $nombreCategoria) !== false) {
                    $categoria = $cat['categoria'];
                    break;
                }
            }

            // 🔹 Si no se seleccionó categoría → mostrar lista
            if (empty($categoria)) {
                $respuesta = "
                <div style='text-align:center;padding:10px;'>
                    <h5>🍽️ ¿Qué tipo de comida te gustaría ver?</h5>
                    <p>Selecciona una categoría:</p>
                </div>";

                $opciones = array_column($categoriasDB, 'categoria');
                return $this->response->setJSON([
                    'respuesta' => $respuesta,
                    'opciones'  => $opciones
                ]);
            }

            // 🔹 Buscar platos por categoría
            $platos = $cartasModel
                ->select('c.idcarta, c.nombreplato, c.precio, c.foto, n.idnegocio, n.nombrecomercial')
                ->from('cartas AS c')
                ->join('locales AS l', 'c.idlocales = l.idlocales')
                ->join('negocios AS n', 'l.idnegocio = n.idnegocio')
                ->join('categorias AS cat', 'n.idcategoria = cat.idcategoria')
                ->where('cat.categoria', $categoria)
                ->groupBy('c.idcarta')
                ->findAll();

            if (empty($platos)) {
                $respuesta = "<div style='text-align:center;padding:10px;color:#555;'>🍽️ No hay platos disponibles en la categoría <b>{$categoria}</b>.</div>";
                return $this->response->setJSON([
                    'respuesta' => $respuesta,
                    'opciones'  => $menuPrincipal
                ]);
            }

            $mensajeHorario = !$localAbierto
                ? "<div style='text-align:center;color:#007bff;font-size:13px;'>🕒 Los restaurantes están cerrados ahora, pero aquí tienes algunas opciones:</div>"
                : "";

            $html = $mensajeHorario . "<div style='display:flex;flex-direction:column;gap:10px;margin-top:8px;'>";

            foreach ($platos as $p) {
                $img = !empty($p['foto']) ? base_url($p['foto']) : base_url('assets/img/default-food.png');
                $urlNegocio = base_url("negocios/detalle/{$p['idnegocio']}");

                $html .= "
                <div style='border:1px solid #ddd;border-radius:10px;overflow:hidden;background:#fff;box-shadow:0 2px 5px rgba(0,0,0,0.1);'>
                    <img src='{$img}' style='width:100%;height:140px;object-fit:cover;'>
                    <div style='padding:8px;text-align:center;'>
                        <h6 style='margin:5px 0;font-weight:600;'>{$p['nombreplato']}</h6>
                        <p style='margin:0;color:#555;font-size:13px;'>S/ " . number_format($p['precio'], 2) . "</p>
                        <div style='margin-top:5px;display:flex;justify-content:center;gap:5px;'>
                            <a href='{$urlNegocio}' target='_blank' style='padding:5px 8px;font-size:12px;border-radius:6px;background:#007bff;color:#fff;text-decoration:none;'>Ver restaurante</a>
                            <a href='{$urlNegocio}#reservar' target='_blank' style='padding:5px 8px;font-size:12px;border-radius:6px;background:#28a745;color:#fff;text-decoration:none;'>Reservar</a>
                        </div>
                    </div>
                </div>";
            }
            $html .= "</div>";

            return $this->response->setJSON([
                'respuesta' => $html,
                'opciones'  => $menuPrincipal
            ]);
        }

        // 🏠 RESTAURANTES
        if (preg_match('/\b(restaurantes|locales|ver restaurantes|sitios|lugares)\b/i', $pregunta)) {
            $negocios = $negocioModel->findAll(6);

            if (empty($negocios)) {
                $respuesta = "<div style='text-align:center;color:#555;'>😕 No hay restaurantes registrados aún.</div>";
            } else {
                $html = "<div style='display:flex;flex-direction:column;gap:10px;'>";
                foreach ($negocios as $n) {
                    $logo = !empty($n['logo']) ? base_url($n['logo']) : base_url('assets/img/default-restaurant.png');
                    $urlDetalle = base_url("negocios/detalle/{$n['idnegocio']}");
                    $html .= "
                    <div style='border:1px solid #ddd;border-radius:10px;overflow:hidden;background:#fff;box-shadow:0 2px 5px rgba(0,0,0,0.1);'>
                        <img src='{$logo}' style='width:100%;height:130px;object-fit:cover;'>
                        <div style='padding:8px;text-align:center;'>
                            <h6 style='margin:5px 0;font-weight:600;'>{$n['nombrecomercial']}</h6>
                            <a href='{$urlDetalle}#reservar' target='_blank' style='display:inline-block;margin-top:4px;padding:5px 10px;font-size:12px;border-radius:6px;background:#28a745;color:#fff;text-decoration:none;'>Reservar</a>
                        </div>
                    </div>";
                }
                $html .= "</div>";
                $respuesta = $html;
            }

            return $this->response->setJSON([
                'respuesta' => $respuesta,
                'opciones'  => $menuPrincipal
            ]);
        }

        // 📅 RESERVAS
        if (preg_match('/\b(reservar|reserva|mesa|booking|whatsapp)\b/i', $pregunta)) {
            $respuesta = "
            <div style='text-align:center;padding:10px;'>
              <h5>📅 Reservas</h5>
              <p>Selecciona un restaurante para continuar:</p>
            </div>";

            $negocios = $negocioModel->findAll(5);
            $html = "<div style='display:flex;flex-direction:column;gap:10px;margin-top:5px;'>";
            foreach ($negocios as $n) {
                $logo = !empty($n['logo']) ? base_url($n['logo']) : base_url('assets/img/default-restaurant.png');
                $urlDetalle = base_url("negocios/detalle/{$n['idnegocio']}#reservar");
                $html .= "
                <div style='border:1px solid #ddd;border-radius:10px;overflow:hidden;background:#fff;'>
                    <img src='{$logo}' style='width:100%;height:130px;object-fit:cover;'>
                    <div style='padding:8px;text-align:center;'>
                        <h6 style='margin:5px 0;font-weight:600;'>{$n['nombrecomercial']}</h6>
                        <a href='{$urlDetalle}' target='_blank' style='display:inline-block;margin-top:4px;padding:5px 10px;font-size:12px;border-radius:6px;background:#28a745;color:#fff;text-decoration:none;'>Reservar mesa</a>
                    </div>
                </div>";
            }
            $html .= "</div>";

            return $this->response->setJSON([
                'respuesta' => $respuesta . $html,
                'opciones'  => $menuPrincipal
            ]);
        }

        // 🚫 MENSAJE POR DEFECTO
        $respuesta = "
        <div style='text-align:center;color:#555;padding:10px;'>
            🤖 No entendí tu solicitud.<br>
            Por favor, selecciona una opción del menú 👇
        </div>";

        return $this->response->setJSON([
            'respuesta' => $respuesta,
            'opciones'  => $menuPrincipal
        ]);
    }

    private function getDiaSemana()
    {
        $dias = ['lunes','martes','miercoles','jueves','viernes','sabado','domingo'];
        $numDia = date('N') - 1;
        return $dias[$numDia] ?? 'lunes';
    }
}
