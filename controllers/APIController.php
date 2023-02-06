<?php

namespace Controllers;

use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;

class APIController {
    public static function index()   {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardar() {
        // Almacena la cita y devuelve el id de la cita
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        $citaId = $resultado['id'];

        // Almacena la relación de la cita con los servicios
        $servicios = explode("," , $_POST['servicios']);
        foreach($servicios as $servicio) {
            $args = [
                'citaId' => $citaId,
                'servicioId' => $servicio 
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        // Retornamos una respuesta
        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar() {
        isAdmin();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location:'.$_SERVER['HTTP_REFERER']);
        }
    }
}