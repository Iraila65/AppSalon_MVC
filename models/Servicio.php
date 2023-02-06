<?php

namespace Model;

class Servicio extends ActiveRecord {
    protected static $tabla = "servicios";
    protected static $columnasDB = ['id', 'nombre', 'precio'];
    
    public $id;
    public $nombre;
    public $precio;
    
    public function __construct($args = [])
    {
        if (!isset($args['id'])) $args['id']=null;
        if (!isset($args['nombre'])) $args['nombre']="";
        if (!isset($args['precio'])) $args['precio']="";
                
        $this->id = $args['id'];
        $this->nombre = $args['nombre'];
        $this->precio = $args['precio'];
    }

    public function validar() {
        if (!$this->nombre) {
            self::$alertas['error'][] = "El nombre del Servicio es obligatorio";
        }
        if (!$this->precio || $this->precio == 0) {
            self::$alertas['error'][] = "El precio del Servicio es obligatorio";
        } else if (!is_numeric($this->precio)) {
            self::$alertas['error'][] = "El precio no tiene un formato válido";
        }
    }

}