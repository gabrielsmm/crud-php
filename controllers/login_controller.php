<?php

require_once("../models/usuario.php");
require_once("../services/conexao.service.php");
require_once("../services/usuario.service.php");

class LoginController {

    public function __construct() {
        $this->fazerLogin();
    }

    private function fazerLogin() {
        session_start();

        $valida_campos = true;

        foreach($_POST as $campo){
            if(empty($campo)){
                header('Location: ../view/index.php?erro=campo');
                $valida_campos = false;
            }
        }

        $usuario = new Usuario();
        $usuario->setLogin($_POST['login']);
        $usuario->setSenha($_POST['senha']);

        $conexao = new Conexao();

        $usuarioService = new UsuarioService($conexao, $usuario);

        $usuario = $usuarioService->validar_login();

        if (!empty($usuario)) {
            $_SESSION['autenticado'] = 'SIM';
            $_SESSION['nome_usuario'] = $usuario->nome_completo;
            header('Location: ../views/pesquisa_usuarios.php');
        } else {
            header('Location: ../views/login.php?erro=usuario');
        }
 
    }

}

new LoginController();

?>