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
            $data = $request->getParsedBody();
            $color = filter_var($data['color'], FILTER_SANITIZE_STRING);
            $marca = filter_var($data['marca'], FILTER_SANITIZE_STRING);
            $rodado = filter_var($data['rodado'], FILTER_SANITIZE_INT);
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


    }
    
?>