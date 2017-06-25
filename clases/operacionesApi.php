<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    
    require_once 'operaciones.php';
    require_once 'bicicleta.php';
    require_once 'IApiUsable.php';
    require_once 'vendor/autoload.php';

    class operacionesApi extends operaciones  implements IApiUsable
    {
        public function TraerUno($request, $response, $args){

        }
        public function TraerTodos($request, $response, $args){

        }
        public function CargarUno($request, $response, $args){
            $id = $request->getAttribute('id');
            $nombre = $request->getAttribute('nombre');
            $fecha = $request->getAttribute('fecha');
            $precio = $request->getAttribute('precio');
            $imagen = $request->getAttribute('imagen');
            $bicicleta = bicicleta::buscar($id);
            if($bicicleta){
                $operacion = new operaciones($id, $nombre, $fecha, $precio, $imagen );
                return $response->withJson($operacion->guardar());    
            }
            
            return $response->withJson("id Bicicleta erroneo", 400);
        }
        public function BorrarUno($request, $response, $args){
            
        }
        public function ModificarUno($request, $response, $args){

        }
    }
    
?>