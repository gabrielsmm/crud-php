<?php

require_once("../models/usuario.php");
require_once("../services/conexao.service.php");
require_once("../services/usuario.service.php");

class CadastroController {

    public function __construct() {
        $this->cadastrar();
    }

    private function cadastrar() {
        $usuario = new Usuario();
        $usuario->setLogin($_POST['login']);
        $usuario->setSenha($_POST['senha']);
        $usuario->setNome($_POST['nome']);

        $conexao = new Conexao();

        $usuarioService = new UsuarioService($conexao, $usuario);

        if (!empty($_POST['id'])) {
            $usuario->setId($_POST['id']);

            $this->usuario = $usuarioService->atualizar();

            if ($this->usuario >= 1) {
                header('Location: ../views/pesquisa_usuarios.php');
            } else {
                header('Location: ../views/cadastro_usuarios.php?cadastro=erro');
            }

        } else {
            $this->usuario = $usuarioService->cadastrar();

            if ($this->usuario >= 1) {
                header('Location: ../views/pesquisa_usuarios.php');
            } else {
                header('Location: ../views/cadastro_usuarios.php?cadastro=erro');
            }
        }
    }

}

new CadastroController();

?>