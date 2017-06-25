<?php

    class verificadora 
    {
        public static function datosUsuario($request, $response, $next){
            $data = $request->getParsedBody();
            $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
            $clave = filter_var($data['clave'], FILTER_SANITIZE_STRING);
            $mail = filter_var($data['mail'], FILTER_SANITIZE_STRING);
            if($nombre && $clave && $mail){
                $request = $request->withAttribute('nombre', $nombre);
                $request = $request->withAttribute('clave', $clave);
                $request = $request->withAttribute('mail', $mail);
                return $next($request, $response);
            }
            return  $response->withJson("Algunas de los datos son incorrectos", 400);
        }
        public static function datosBicicletas($request, $response, $next){
            $data = $request->getParsedBody();
            if($request->isPost()){
                $color = filter_var($data['color'], FILTER_SANITIZE_STRING);
                $marca = filter_var($data['marca'], FILTER_SANITIZE_STRING);
                $rodado = filter_var($data['rodado'], FILTER_SANITIZE_NUMBER_INT);
                if($color && $marca && $rodado){
                    $request = $request->withAttribute('color', $color);
                    $request = $request->withAttribute('marca', $marca);
                    $request = $request->withAttribute('rodado', $rodado);
                    return $next($request, $response);
                }
                return $response->withJson("Algunos de los datos son incorrecto", 400);    
            }
            elseif ($request->isGet()) {
                return $next($request, $response);
            }
            elseif($request->isDelete()){
                $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);
                if($id){
                    $request = $request->withAttribute('id', $id);
                    return $next($request, $response);
                }
                return $response->withJson("id no pasado", 400);
            }
        }

        public function datosAlta($request, $response, $next){
            if($request->isPost()){
                $data = $request->getParsedBody();    
                $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);
                $nombreCliente = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
                //VERIFICAR FECHA
                $fecha = filter_var($data['fecha'], FILTER_SANITIZE_STRING);
                $precio = filter_var($data['precio'], FILTER_SANITIZE_STRING);
            }
            else{
                $ruta = $request->getAttribute('route');
                $id = filter_var($ruta->getArgument('id'), FILTER_SANITIZE_NUMBER_INT);
                $nombreCliente = filter_var($ruta->getArgument('nombre'), FILTER_SANITIZE_STRING);
                //VERIFICAR FECHA
                $fecha = filter_var($ruta->getArgument('fecha'), FILTER_SANITIZE_STRING);
                $precio = filter_var($ruta->getArgument('precio'), FILTER_SANITIZE_STRING);

            }
            if($id && $fecha && $precio && $nombreCliente){
                $request = $request->withAttribute('id', $id);
                $request = $request->withAttribute('nombre', $nombreCliente);
                $request = $request->withAttribute('fecha', $fecha);
                $request = $request->withAttribute('precio', $precio);

                return $next($request, $response);
            }
            return $response->withJson("Datos no pasados", 400);

            
        }
    }
    
?>