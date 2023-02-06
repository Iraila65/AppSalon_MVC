<?php

namespace Model;

class CitaServicio extends ActiveRecord {
    protected static $tabla = "citasservicios";
    protected static $columnasDB = ['id', 'citaId', 'servicioId'];
    
    public $id;
    public $citaId;
    public $servicioId;

    public function __construct($args = [])
    {
        if (!isset($args['id'])) $args['id']=null;
        if (!isset($args['citaId'])) $args['citaId']="";
        if (!isset($args['servicioId'])) $args['servicioId']="";
        
        $this->id = $args['id'];
        $this->citaId = $args['citaId'];
        $this->servicioId = $args['servicioId'];
    }

}