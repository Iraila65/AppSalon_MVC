<?php

namespace Model;

class Cita extends ActiveRecord {
    protected static $tabla = "citas";
    protected static $columnasDB = ['id', 'fecha', 'hora', 'usuarioId'];
    
    public $id;
    public $fecha;
    public $hora;
    public $usuarioId; 

    public function __construct($args = [])
    {
        if (!isset($args['id'])) $args['id']=null;
        if (!isset($args['fecha'])) $args['fecha']="";
        if (!isset($args['hora'])) $args['hora']="";
        if (!isset($args['usuarioId'])) $args['usuarioId']="";
                
        $this->id = $args['id'];
        $this->fecha = $args['fecha'];
        $this->hora = $args['hora'];
        $this->usuarioId = $args['usuarioId'];
    }

}