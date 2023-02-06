<?php

namespace Model;

class AdminCita extends ActiveRecord {
    protected static $tabla = "citaServicio";
    protected static $columnasDB = ['id', 'hora', 'cliente', 'email', 'telefono', 'servicio', 'precio'];

    public $id;
    public $hora;
    public $cliente; 
    public $email;
    public $telefono;
    public $servicio;
    public $precio;

    public function __construct($args = [])
    {
        if (!isset($args['id'])) $args['id']=null;
        if (!isset($args['hora'])) $args['hora']="";
        if (!isset($args['cliente'])) $args['cliente']="";
        if (!isset($args['email'])) $args['email']="";
        if (!isset($args['telefono'])) $args['telefono']="";
        if (!isset($args['servicio'])) $args['servicio']="";
        if (!isset($args['precio'])) $args['precio']="";
                
        $this->id = $args['id'];
        $this->hora = $args['hora'];
        $this->cliente = $args['cliente'];
        $this->email = $args['email'];
        $this->telefono = $args['telefono'];
        $this->servicio = $args['servicio'];
        $this->precio = $args['precio'];
    }
}