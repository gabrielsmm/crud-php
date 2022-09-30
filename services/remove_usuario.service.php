<?php

require '../models/usuario.php';
require '../services/conexao.service.php';
require '../services/usuario.service.php';

if (isset($_GET['usuario']) && $_GET['usuario'] > 0) {
    $usuario = new Usuario();
    $usuario->setId($_GET['usuario']);

    $conexao = new Conexao();

    $usuarioService = new UsuarioService($conexao, $usuario);

    $usuarioService->remover();

    header('Location: ../views/pesquisa_usuarios.php');
}

?>