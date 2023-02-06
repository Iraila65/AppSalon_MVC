<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController {
    public static function index($router) {
        isAdmin();

        $servicios = Servicio::all();
        
        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }

    public static function crear($router) {
        isAdmin();

        $servicio = new Servicio();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //$servicio = new Servicio($_POST);
            $servicio->sincronizar($_POST);
            $servicio->validar();
            $alertas = Servicio::getAlertas();

            if (empty($alertas)) {
                $servicio->guardar();
                header('Location: /servicios');
            }
        }

        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar($router) {
        isAdmin();
        if (is_numeric($_GET['id'])) {
            $id = $_GET['id'];
        }
        if (!isset($id)) Header('Location:/notfn');
        
        $servicio = Servicio::find($id);
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $servicio->sincronizar($_POST);
            $servicio->validar();
            $alertas = Servicio::getAlertas();

            if (empty($alertas)) {
                $servicio->guardar();
                Header('Location: /servicios');
            }
        }

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);

    }

    public static function eliminar() {
        isAdmin();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $servicio = Servicio::find($id);
            $servicio->eliminar();
            Header('Location: /servicios');
        }
    }
}