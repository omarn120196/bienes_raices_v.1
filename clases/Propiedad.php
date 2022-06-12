<?php 

namespace App;

use GuzzleHttp\Psr7\Query;

class Propiedad{

    //Base de Datos
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    //Errores
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? 1;
    }

    //Definir la conexión a la base de datos--------------------------------------
    public static function setDB($database){
        self::$db = $database;
    }

    public function guardar(){
        if(!is_null($this->id)){
            //Actualizando
            $this->actualizar();
        }
        else{
            //Creando un nuevo registro
            $this->crear();
        }
    }

    public function crear(){

        //Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        $columnas = join(', ', array_keys($atributos));
        $valores = join("', '", array_values($atributos));

        //Insertar en la BD
        $query = "INSERT INTO propiedades (";
        $query .= $columnas;
        $query .= " ) VALUES ( '";
        $query .= $valores;
        $query .= " ') ";

        $resultado = self::$db->query($query);

        if($resultado){
                
            //Redireccionar al usuario
            header('Location: /admin?resultado=1');
        }
    }

    //Actalizar un registro
    public function actualizar(){
        //Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE propiedades SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        $resultado = self::$db->query($query);
                    
        if($resultado){       
            //Redireccionar al usuario
            header('Location: /admin?resultado=2');
        }
    }

    //Eliminar un registro
    public function eliminar(){
        $query = "DELETE FROM propiedades WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

        $resultado = self::$db->query($query);
        if($resultado){
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }
    }

    //identificar y unir los atributos de la base de datos
    public function atributos(){
        $atributos = [];
        foreach(self::$columnasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value); 
        }

        return $sanitizado;
    }

    //Subida de archivos
    public function setImagen($imagen){
        //Elimina la imagen previa
        if(!is_null($this->id)){
            $this->borrarImagen();
        }
        //Asignar al atributo imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    //Borrar imagen
    public function borrarImagen(){
        //Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);

        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen);
        }  
    }

    //Validación 
    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = 'Debes añadir un título';
        }
        if(!$this->precio){
            self::$errores[] = 'Debes añadir un precio';
        }
        if(strlen($this->descripcion) < 50){
            self::$errores[] = 'Debes añadir una descripcion y debe contener al menos 50 caracteres';
        }
        if(!$this->habitaciones){
            self::$errores[] = 'Debes añadir un numero de habitaciones';
        }
        if(!$this->wc){
            self::$errores[] = 'Debes añadir un numero de baños';
        }
        if(!$this->estacionamiento){
            self::$errores[] = 'Debes añadir el numero de estacionamientos';
        }
        if(!$this->vendedorId){
            self::$errores[] = 'Elige un vendedor';
        }
        if(!$this->imagen){
            self::$errores[] = 'Debes elegir una imagen';
        }

        return self::$errores;
    }

    //Listar todas las propiedades
    public static function all(){
        $query = "SELECT * FROM propiedades";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Buscar un registros por su Id
    public static function find($id){
        $query = "SELECT * FROM propiedades WHERE id = ${id}";
        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        
        //Consultar la BD
        $resultado = self::$db->query($query);

        //Iterar los resulyados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }

        //Liberar memoria
        $resultado->free();

        //Retornar resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new self;

        foreach($registro as $key => $value){
            if(property_exists( $objeto, $key )){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    } 

    //Sincroniza el objeto en memoria por los cambios actualizados por el usuario
    public function sincronizar($args = []){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}