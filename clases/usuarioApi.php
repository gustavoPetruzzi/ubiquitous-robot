<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require_once 'usuario.php';
    require_once 'vendor/autoload.php';
    class usuarioApi extends usuario
    {
        public static function verificarUsuario(Request $request, Response $response){
            $data = $request->getParsedBody();
            $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
            $clave = filter_var($data['clave'], FILTER_SANITIZE_STRING);
            $mail = filter_var($data['mail'], FILTER_SANITIZE_STRING);
            $usuario = new usuario($mail, $nombre, $clave);
            $retorno = $usuario->verificar();
            return $response->withJson($usuario->verificar());
            
        }
    }
    
?>