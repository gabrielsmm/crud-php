<?php require_once '../services/valida_acesso.service.php'; ?>

<?php

require '../services/usuario.service.php';
require '../services/conexao.service.php';

$conexao = new Conexao();

$usuarioService = new UsuarioService($conexao);

if (!empty($_GET['search'])) {
  $usuarios = $usuarioService->recuperar($_GET['search']);
} else {
  $usuarios = $usuarioService->recuperar_todos();
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>santri</title>

    <link rel="stylesheet" href="../static/css/w3.css">
    <link rel="stylesheet" href="../static/css/santri.css">
    <link rel="stylesheet" href="../static/css/toastr.css">

    <link rel="stylesheet" href="../static/css-awesome/brands.css">
    <link rel="stylesheet" href="../static/css-awesome/fontawesome.css">
    <link rel="stylesheet" href="../static/css-awesome/regular.css">
    <link rel="stylesheet" href="../static/css-awesome/solid.css">
    <link rel="stylesheet" href="../static/css-awesome/svg-with-js.css">
    <link rel="stylesheet" href="../static/css-awesome/v4-shims.css">

    <style>
      table {
        border-collapse: collapse;
        width: 100%;
      }

      th, td {
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #ddd;
      }

      tr:nth-child(even) {background-color: #f2f2f2;}
    </style>

  </head>
  <body>
    <script src="../static/js/jquery.js"></script>
    <div>
      <div id="lista_usuarios" class="w3-margin">
        <input id="nome" class="w3-input w3-border w3-margin-top" type="text" placeholder="Nome" name="nome">
        <button id="buscar" class="w3-button w3-theme w3-margin-top">Buscar</button>
        <a class="w3-button w3-theme w3-margin-top w3-right" href="cadastro_usuarios.php">Cadastrar novo usuário</a>

        <?php if(empty($usuarios)){ ?>
            <h5 class="text-danger">Nenhum usuário encontrado...</h5>
        <?php } ?>

        <table>
          <thead>
            <tr>
              <th>Nome</td>
              <th>Login</td>
              <th>Ativo</td>
              <th>Opções</td>  
            </tr>
          </thead>
          <tbody>
            <?php foreach($usuarios as $usuario) { ?> 
              <tr>
                <td><?= $usuario->nome_completo ?></td>
                <td><?= $usuario->login ?></td>
                <td><?= $usuario->ativo ?></td>
                <td>
                  <button onclick="remover(<?=$usuario->usuario_id?>)" class="w3-button w3-theme w3-margin-top"><i class="fas fa-user-times"></i></button>
                  <button onclick="editar(<?=$usuario->usuario_id?>)" class="w3-button w3-theme w3-margin-top"><i class="fas fa-edit"></i></button>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
      $(function() {
        $("#buscar").click(function() {
            let pesquisa = $("#nome").val();

            window.location = 'pesquisa_usuarios.php?search='+pesquisa;
        });
      })

      function remover(usuario) {
        if (window.confirm("Realmente deseja remover este usuário?")) {
          window.location = '../services/remove_usuario.service.php?usuario='+usuario;
        }
      }

      function editar(usuario) {
        window.location = 'cadastro_usuarios.php?editar='+usuario;
      }
    </script>
  </body>
</html>