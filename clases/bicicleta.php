<?php
    require_once 'accesoDatos.php';
    class bicicleta 
    {
        public $id;
        public $color;
        public $marca;
        public $rodado; 
        function __construct( $id=NULL, $color=NULL, $marca= NULL, $rodado = NULL)
        {
            if($id != NULL && $color != NULL && $marca != NULL && $rodado != NULL){
                $this->color = $color;
                $this->marca = $marca;
                $this->rodado = $rodado;
            }
        }

        public function guardar(){
            $objetoAccesoDatos = accesoDatos::DameUnObjetoAcceso();
            $consulta = $objetoAccesoDatos->RetornarConsulta("INSERT INTO bicicletas (color, marca, rodado) VALUES(:color, :marca, :rodado)");
            $consulta->bindValue(":color", $this->color, PDO::PARAM_STR);
            $consulta->bindValue(":marca",$this->marca, PDO::PARAM_STR);
            $consulta->bindValue(":rodado", $this->rodado, PDO::PARAM_INT);
            return $consulta->execute();
            
        }
        /**
         * Devuelve todas las bicicletas en la base de datos.
         * 
         * 
         *
         * @param string $filtro segun la key es el tipo de filtro que se aplica. Si es NULL trae todos
         * @param string $valor
         * @return listaBicicletas array con todas las bicicletas
         */
        public static function traerBicicletas($filtro = NULL, $valor = NULL){
            $listaBicicletas = array();
            $objetoAccesoDatos = accesoDatos::DameUnObjetoAcceso();
            
            
            if(!isset($filtro) && !isset($valor)){
                $consulta = $objetoAccesoDatos->RetornarConsulta("SELECT * FROM bicicletas");    
            }else{
                $columna = bicicleta::getFilter($filtro);
                if(isset($columna)){
                    $consulta = $objetoAccesoDatos->RetornarConsulta("SELECT * FROM bicicletas WHERE $columna = :value");
                    if(is_numeric($filtro[$columna])){
                        $consulta->bindValue(':value', $filtro[$columna], PDO::PARAM_INT);
                    }
                    else{
                        $consulta->bindValue(':value', $filtro[$columna], PDO::PARAM_STR);
                    }
                }
            }            
            $consulta->execute();
            $listaBicicletas = $consulta->fetchAll(PDO::FETCH_CLASS, "bicicleta");
            return $listaBicicletas;
            
        }

        public static function buscar($id){
            $objetoAccesoDatos = accesoDatos::DameUnObjetoAcceso();
            $consulta = $objetoAccesoDatos->RetornarConsulta("SELECT * FROM bicicletas WHERE $id = :id");
            $consulta->bindValue(':id', $id, PDO::PARAM_INT);
            $consulta->setFetchMode(PDO::FETCH_CLASS, 'bicicleta');
            $consulta->execute();
            return $consulta->fetch();
        }

        public function borrar(){
            $objetoAccesoDatos = accesoDatos::DameUnObjetoAcceso();
            $consulta = $objetoAccesoDatos->RetornarConsulta("DELETE FROM bicicletas WHERE id = :id");
            $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);

        }












        /**
         * Funcion para prevenir que haya una inyeccion sql
         *
         * @param string $filtro
         * @return void
         */
        private static function getFilter( $filtro ) 
        {
            switch ($filtro) {
                case 'color':
                    $filtro_sanitize = 'color';
                    break;
                case 'marca':
                    $filtro_sanitize = 'marca';
                    break;
                case 'rodado':
                    $filtro_sanitize = 'rodado';
                default:
                    $filtro_sanitize = NULL;
                    break;
            }
            return $filtro_sanitize;
        }
    }
    
?>