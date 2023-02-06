<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController {
    public static function index($router) {
        isAdmin();

        if (isset($_GET['fecha'])) {
            $fecha = $_GET['fecha'];
            $fechaSep = explode('-', $fecha);
            //la función checkdate espera 3 argumentos que son M, D, A y devuelve true si la fecha es correcta
            if (!checkdate($fechaSep[1], $fechaSep[2], $fechaSep[0])) {
                Header('Location:/notfn');
            }
        } else {
            $fecha = date('Y-m-d');
        }
               

        // Consultar las citas de la fecha seleccionada
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasServicios ";
        $consulta .= " ON citasServicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicioId ";
        $consulta .= " WHERE fecha =  '".$fecha."'";
        
        $citas = AdminCita::consultarSQL($consulta);

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha' => $fecha
        ]);

    }

}