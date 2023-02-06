<?php

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = "usuarios";
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password',
                    'telefono', 'admin', 'confirmado', 'token', 'creado'];
    
    public $id;
    public $nombre;
    public $apellido;
    public $email; 
    public $password; 
    public $telefono; 
    public $admin;
    public $confirmado;
    public $token;
    public $creado;

    public function __construct($args = [])
    {
        if (!isset($args['id'])) $args['id']=null;
        if (!isset($args['nombre'])) $args['nombre']="";
        if (!isset($args['apellido'])) $args['apellido']="";
        if (!isset($args['email'])) $args['email']="";
        if (!isset($args['password'])) $args['password']="";
        if (!isset($args['telefono'])) $args['telefono']="";
        if (!isset($args['admin'])) $args['admin']=0;
        if (!isset($args['confirmado'])) $args['confirmado']=0;
        if (!isset($args['token'])) $args['token']="";
        
        $this->id = $args['id'];
        $this->nombre = $args['nombre'];
        $this->apellido = $args['apellido'];
        $this->email = $args['email'];
        $this->password = $args['password'];
        $this->telefono = $args['telefono'];
        $this->admin = $args['admin'];
        $this->confirmado = $args['confirmado'];
        $this->token = $args['token'];
        $this->creado = date('Y/m/d');
    }

    // Validación para la creación de una cuenta
    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = "El nombre es obligatorio";
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = "El apellido es obligatorio";
        }
        $emailValido = s(filter_var($this->email, FILTER_VALIDATE_EMAIL));
        if (!$emailValido) {
            self::$alertas['error'][] = "Email no valido";
        }
        if (!$this->password) {
            self::$alertas['error'][] = "Es obligatoria una password";
        } elseif ( strlen($this->password) < 6) {
            self::$alertas['error'][] = "La password es demasiado corta, debe ser de al menos 6 caracteres";
        }
        return self::$alertas;
    }

    public function existeUsuario() {
        $query = "SELECT * FROM ".static::$tabla." WHERE email= '".$this->email."' LIMIT 1";    
        $resultado = self::$db->query($query);
        if ($resultado->num_rows) {
            self::$alertas['error'][] = "El usuario ya está registrado";
        }
        return $resultado;  
    }

    public function hashPasword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function generarToken() {
        $this->token = uniqid();
    }

    public function validarLogin() {    
        $emailValido = s(filter_var($this->email, FILTER_VALIDATE_EMAIL));
        if (!$emailValido) {
            self::$alertas['error'][] = "Email no valido";
        }
        if (!$this->password) {
            self::$alertas['error'][] = "Es obligatoria la password";
        } 
        return self::$alertas;
    }

    public function validarPassAndConf($usuario) {
        $correcto = false;
        
        // Comprobar el password
        $passCorrecta = password_verify($this->password, $usuario->password);
        if ($passCorrecta) {
            if ($usuario->confirmado) {
                $correcto = true;
            } else {
                self::$alertas['error'][] = 'El usuario aún no está confirmado';
            }
            
        } else {
            Usuario::setAlerta('error', 'La password no es correcta');
        }

        return $correcto;
    }

    public function validarPass() {
        
        if (!$this->password) {
            self::$alertas['error'][] = "Es obligatoria una password";
        } elseif ( strlen($this->password) < 6) {
            self::$alertas['error'][] = "La password es demasiado corta, debe ser de al menos 6 caracteres";
        }
        return self::$alertas;
    }

}