<?php
    require_once 'accesoDatos.php';
    class usuario 
    {
        public $mail;
        public $nombre;
        private $_clave;
        function __construct($mail = NULL, $nombre = NULL, $clave = NULL)
        {
            if($mail != NULL && $nombre != NULL && $clave != NULL){
                $this->mail = $mail;
                $this->nombre = $nombre;
                $this->clave = $clave;
            }
        }
        public function guardar(){
            $objetoAccesoDatos = accesoDatos::DameUnObjetoAcceso();
            $empleadoBase = empleado::buscar($this->mail);
            if(!isset($empleadoBase->mail)){
                $consulta = $objetoAccesoDatos->RetornarConsulta("INSERT INTO usuarios (mail, nombre, clave) VALUES (:mail, :nombre, :clave)");
                $consulta->bindValue(":mail", $this->mail, PDO::PARAM_STR);
                $consulta->bindValue(":nombre", $this->nombre, PDO::PARAM_STR);
                $consulta->bindValue(":clave", $this->_clave, PDO::PARAM_STR);
                $retorno['exito'] = $consulta->execute;
                if(!$retorno['exito']){
                    $errores = $consulta->errorInfo();
                    $retorno['error'] = $errores[2];
                }
            }
            else{
                $retorno['exito'] = false;
                $retorno['error'] = "Ya existe alguien con ese mail";

            }
            return $retorno;
        }
        public static function buscar ($mail){
            $objetoAccesoDatos = accesoDatos::DameUnObjetoAcceso();
            $consulta = $objetoAccesoDatos->RetornarConsulta("SELECT mail, nombre, clave as _clave FROM usuarios WHERE mail = :mail");
            $consulta->bindValue(":mail", $mail, PDO::PARAM_STR);
            $consulta->setFetchMode(PDO::FETCH_CLASS, "usuario");
            $consulta->execute();
            $empleado = $consulta->fetch();
        }

        public function verificarDB(){
            $objetoAccesoDatos = accesoDatos::DameUnObjetoAcceso();
            $consulta = $objetoAccesoDatos->RetornarConsulta("SELECT 1 FROM usuarios WHERE mail = :mail AND nombre = :nombre AND clave = :clave");
            $consulta->bindValue(":mail",$this->mail, PDO::PARAM_STR);
            $consulta->bindValue(":nombre", $this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(":clave", $this->clave, PDO::PARAM_STR);
            $consulta->setFetchMode(PDO::FETCH_CLASS, "usuario");
            $retorno['respuesta'] = "noOk";
            if($consulta->execute() && $retorno['usuario'] = $consulta->fetch()){
                $retorno['respuesta'] = 'ok';
            }
            return $retorno;
            
        }
    }
    
?>