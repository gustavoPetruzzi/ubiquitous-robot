<?php
    /**
     * 
     */
    class archivos 
    {
        //Hacerlo para varios archivos
        public function subirArchivo($request, $response, $args){
            if($request->isPost()){
                $tiposValidos = ['jpg', 'jpeg', 'png'];
                $nuevas = "fotos/ventas/";
                $backup = "fotos/backup";
                $imagen = $request->getUploadedFiles();
                $nombreOriginal = $imagen['imagen']->getClientFilename();
                $extension = explode(".", $nombreOriginal);
                $extension = end($extension);
                if(in_array($extension, $tiposValidos)){

                    $nombreNuevo = $id."-".$nombreCliente.".".$extension;
                    $fotosExistentes = scandir($nuevas);
                    if(!in_array($nombreNuevo, $fotosExistentes)){
                        $imagen['imagen']->moveTo($nuevas.$nombreNuevo);
                    }
                    else{
                        rename($nuevas.$nombreNuevo, $backup.$nombreNuevo);
                        $imagen['imagen']->moveTo($nuevas.$nombreNuevo);
                    }



                    $request = $request->withAttribute('id', $id);
                    $request = $request->withAttribute('precio', $precio);
                    $request = $request->withAttribute('nombre', $nombreCliente);
                    $request = $request->withAttribute('fecha', $fecha);
                    $request = $request->withAttribute('imagen', $nombreNuevo);
                    
                    return $next($request, $response);
                }
                return $request->withJson("error imagen", 400);
            }
            else{
                return $next($request, $response);
            }            
        }
    }
    

?>