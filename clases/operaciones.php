<?php
    require_once 'accesoDatos.php';
    
    class operaciones 
    {
        public $idBicicleta;
        public $nombreCliente;
        public $fecha;
        public $precio;
        public $imagen;
        function __construct($idBicicleta = NULL, $nombreCliente = NULL, $fecha = NULL, $precio = NULL, $imagen = NULL)
        {
            if($idBicicleta != NULL && $nombreCliente != NULL && $fecha != NULL && $precio != NULL && $imagen != NULL){
                $this->idBicicleta = $idBicicleta;
                $this->nombreCliente = $nombreCliente;
                $this->fecha = $fecha;
                $this->precio = $precio;
                $this->imagen = $imagen;
            }
        }

        public function guardar(){
            $objetoAccesoDatos = accesoDatos::DameUnObjetoAcceso();
            $consulta = $objetoAccesoDatos->RetornarConsulta("INSERT INTO operaciones (idbicicleta, nombreCliente, fecha, precio, imagen) 
                                                              VALUES (:id, :nombre, :fecha, :precio, :imagen)");
            $consulta->bindValue(':id', $this->idBicicleta, PDO::PARAM_INT);
            $consulta->bindValue(':nombre', $this->nombreCliente, PDO::PARAM_STR);
            $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
            $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
            $consulta->bindValue(':imagen', $this->imagen, PDO::PARAM_STR);

            return $consulta->execute();
        }

        public static function buscar($id){
            $objetoAccesoDatos = accesoDatos::DameUnObjetoAcceso();
            $consulta = $objetoAccesoDatos->RetornarConsulta("SELECT idbicicleta as idBicicleta, nombrecliente as nombreCliente, fecha, precio, imagen FROM operaciones WHERE idbicicleta = :id");
            $consulta->bindValue(':id', $id, PDO::PARAM_INT);
            $consulta->setFetchMode(PDO::FETCH_CLASS, 'operaciones');
            $consulta->execute();
            return $consulta->fetch();
            
        }

        public function modificar(){
            $objetoAccesoDatos = accesoDatos::DameUnObjetoAcceso();
            $consulta = $objetoAccesoDatos->RetornarConsulta("UPDATE  operaciones SET nombreCliente = :nombre, fecha = :fecha, precio =:precio, imagen= :imagen 
                                                              WHERE idbicicleta = :id");
            $consulta->bindValue(':id', $this->idBicicleta, PDO::PARAM_INT);
            $consulta->bindValue(':nombre', $this->nombreCliente, PDO::PARAM_STR);
            $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
            $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
            $consulta->bindValue(':imagen', $this->imagen, PDO::PARAM_STR);

            return $consulta->execute();
        }
    }
    
?>