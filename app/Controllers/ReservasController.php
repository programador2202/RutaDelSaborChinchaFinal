<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Reservas;

class ReservasController extends BaseController
{
    public function index()
{
    $reservaModel = new Reservas();
    $nivel        = session()->get('nivelacceso');
    $idpersona    = session()->get('idpersona');

    if ($nivel === 'representante') {
        //Obtener reservas solo de los locales que pertenecen al representante
        $reservas = $reservaModel->obtenerReservasPorRepresentante($idpersona);
    } else {
        //Para admin u otros niveles, traer todas
        $reservas = $reservaModel->obtenerReservasConUsuarios();
    }

    $data = [
        'reservas' => $reservas,
        'header'   => view('admin/dashboard')
    ];

    return view('admin/recursos/Reservas', $data);
    
}

public function vistaPublica()
{
    $session = session();

    //Verificar si el usuario está logueado
    if (!$session->has('logged_in') || !$session->get('logged_in')) {
        return redirect()->to('/login')->with('error', 'Debes iniciar sesión para hacer reservas.');
    }

    //Capturar idlocal desde la URL
    $idlocales = $this->request->getGet('idlocal');

    $data = [
        'nombreCompleto' => $session->get('nombre') . ' ' . $session->get('apellido'),
        'idusuario'      => $session->get('user_id'),
        'email'          => $session->get('email'),
        'telefono'       => $session->get('telefono'),
        'idlocales'      => $idlocales, // se pasa a la vista
    ];

    return view('PaginaPrincipal/Reservas', $data);
}




    //Método AJAX general

    public function ajax()
    {
        $reservaModel = new Reservas();
        $accion       = $this->request->getVar('accion');
        $respuesta    = ['status' => 'error', 'mensaje' => 'Acción no definida'];

         if ($accion === 'registrar') {
        $idlocal   = $this->request->getVar('idlocales');
        $idhorario = $this->request->getVar('idhorario');
        $fechaHora = $this->request->getVar('fechahora');
        $idPersona = $this->request->getVar('idpersonasolicitud');

        //Convertir la fecha y hora enviada
        try {
            $fechaReserva = new \DateTime($fechaHora);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status'  => 'error',
                'mensaje' => 'Formato de fecha y hora inválido.'
            ]);
        }

        //Validar que no sea una fecha pasada
        $ahora = new \DateTime(); // fecha y hora actual
        if ($fechaReserva < $ahora) {
            return $this->response->setJSON([
                'status'  => 'error',
                'mensaje' => 'No se puede reservar para horas o fechas pasadas.'
            ]);
        }

        //Obtener horario del local
        $db = \Config\Database::connect();
        $builder = $db->table('horarios');
        $builder->select('inicio, fin');
        $builder->where('idhorario', $idhorario);
        $horario = $builder->get()->getRow();

        if (!$horario) {
            return $this->response->setJSON([
                'status'  => 'error',
                'mensaje' => 'El horario seleccionado no existe.'
            ]);
        }

        //Validar que la hora esté dentro del rango del local
        $horaReserva = $fechaReserva->format('H:i:s');

        if ($horaReserva < $horario->inicio || $horaReserva > $horario->fin) {
            return $this->response->setJSON([
                'status'  => 'error',
                'mensaje' => 'La hora seleccionada está fuera del horario de atención del local.'
            ]);
        }

        //Registrar la reserva si pasa todas las validaciones
        $registro = [
            'idhorario'          => $idhorario,
            'idlocales'          => $idlocal,
            'fechahora'          => $fechaHora,
            'cantidadpersonas'   => $this->request->getVar('cantidadpersonas'),
            'confirmacion'       => 'pendiente',
            'idpersonasolicitud' => $idPersona,
        ];

            $reservaModel->insert($registro);
            $respuesta = ['status' => 'success', 'mensaje' => 'Reserva registrada correctamente'];

                // Guardar en sesión el local reservado
                $reservas = session()->get('reservas_realizadas') ?? [];
                $reservas[] = $idlocal;
                session()->set('reservas_realizadas', $reservas);

    }
        //Actualizar reserva
        elseif ($accion === 'actualizar') {
            $id = $this->request->getVar('idreserva');
            $reserva = $reservaModel->find($id);

            if (!$reserva) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'mensaje' => 'La reserva no existe'
                ]);
            }

            $datos = [
                'idhorario'        => $this->request->getVar('idhorario'),
                'idlocales'        => $this->request->getVar('idlocales'),
                'fechahora'        => $this->request->getVar('fechahora'),
                'cantidadpersonas' => $this->request->getVar('cantidadpersonas'),
                'confirmacion'     => $this->request->getVar('confirmacion'),
                'idusuariovalida'  => $this->request->getVar('idusuariovalida'),
            ];

            $reservaModel->update($id, $datos);
            $respuesta = ['status' => 'success', 'mensaje' => 'Reserva actualizada correctamente'];
        }

        //Eliminar reserva
        elseif ($accion === 'borrar') {
            $id = $this->request->getVar('idreserva');
            $reserva = $reservaModel->find($id);

            if ($reserva) {
                try {
                    $reservaModel->delete($id);
                    $respuesta = ['status' => 'success', 'mensaje' => 'Reserva eliminada correctamente'];
                } catch (\Exception $e) {
                    if (strpos($e->getMessage(), '1451') !== false) {
                        $respuesta = [
                            'status'  => 'error',
                            'mensaje' => 'No se puede eliminar la reserva porque está relacionada con otros registros'
                        ];
                    } else {
                        $respuesta = [
                            'status'  => 'error',
                            'mensaje' => 'Error al intentar eliminar la reserva'
                        ];
                    }
                }
            } else {
                $respuesta = ['status' => 'error', 'mensaje' => 'La reserva no existe'];
            }
        }

        //Cambiar estado (confirmar o cancelar)
        elseif ($accion === 'cambiar_estado') {
            $id = $this->request->getVar('idreserva');
            $nuevoEstado = $this->request->getVar('estado');

            if (!in_array($nuevoEstado, ['pendiente', 'confirmado', 'cancelado'])) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'mensaje' => 'Estado no válido'
                ]);
            }

            $reservaModel->update($id, ['confirmacion' => $nuevoEstado]);
            $respuesta = [
                'status'  => 'success',
                'mensaje' => 'Estado de reserva actualizado a: ' . ucfirst($nuevoEstado)
            ];
        }

        return $this->response->setJSON($respuesta);
    }
}
