<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    require_once 'bicicleta.php';
    require_once 'vendor/autoload.php';

    /**
     * 
     */
    class bicicletaApi extends bicicleta
    {
        
        public static function nuevaBicicleta(Request $request, Response $response){
            $color = $request->getAttribute('color');
            $marca = $request->getAttribute('marca');
            $rodado = $request->getAttribute('rodado');
            $bicicleta = new bicicleta($color, $marca, $rodado);
            return $response->withJson($bicicleta->guardar());
        }

        public static function listadoBicicletas($request, $response, $args){
            $filtro = NULL;
            $value = NULL;
            if(array_key_exists("filtro",$args)){
                $filtro = filter_var($args['filtro'], FILTER_SANITIZE_STRING);
            }
            if(array_key_exists("valor", $args)){
                $value = filter_var($args['valor'], FILTER_SANITIZE_STRING);
            }
            
            $bicicletas = bicicleta::traerBicicletas($filtro, $value);
            return $response->withJson($bicicletas);
        }
        public static function unaBicicleta($request, $response, $args){
            if(array_key_exists("id", $args)){
                $id = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);
                $bicicleta = bicicleta::buscar($id);
                return $response->withJson($bicicleta);
            }
            return $response->withJson("bicicleta no encontrada", 400);
        }

        public static function borrarBicicleta($request, $response, $args){
            $id = $request->getAttribute('id');
            $bicicleta = bicicleta::buscar($id);
            
            return $response->withJson($bicicleta->borrar());
        }


    }
    
?>