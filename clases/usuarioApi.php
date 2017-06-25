<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require_once 'usuario.php';
    require_once 'vendor/autoload.php';
    class usuarioApi extends usuario
    {
        public static function verificar(Request $request, Response $response){
            $mail = $request->getAttribute('mail');
            $nombre = $request->getAttribute('nombre');
            $clave = $request->getAttribute('clave');
            $usuario = new usuario($mail, $nombre, $clave);
            $retorno = $usuario->verificarDB();
            return $response->withJson($usuario->verificar());
            
        }
    }
    
?>