<?php require_once '../services/valida_acesso.service.php'; ?>

<?php

require '../services/usuario.service.php';
require '../services/conexao.service.php';

if (!empty($_GET['editar'])) {
  $conexao = new Conexao();

  $usuario = new Usuario();
  $usuario->setId($_GET['editar']);

  $usuarioService = new UsuarioService($conexao, $usuario);

  $usuario = $usuarioService->recuperar_por_id();
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

</head>

<body>
  <script src="../static/js/jquery.js"></script>
  <div>
    <div id="lista_usuarios" class="w3-margin">

      <h4>Cadastro de usuários</h4>

      <form action="../controllers/cadastro_controller.php" method="post">
        <div style="display: none;">
        <input type="text" class="w3-input w3-block w3-border" value="<?= isset($usuario[0]->usuario_id) ? $usuario[0]->usuario_id : '' ?>" name="id">
        </div>

        <div>
          <label>Nome</label>
          <input type="text" class="w3-input w3-block w3-border" value="<?= isset($usuario[0]->nome_completo) ? $usuario[0]->nome_completo : '' ?>" name="nome">
        </div>

        <div>
          <label>Login</label>
          <input type="text"  class="w3-input w3-block w3-border" value="<?= isset($usuario[0]->login) ? $usuario[0]->login : '' ?>" name="login">
        </div>

        <div>
          <label>Senha</label>
          <input type="password"  class="w3-input w3-block w3-border" value="<?= isset($usuario[0]->senha) ? $usuario[0]->senha : '' ?>" name="senha">
        </div>

        <?php if(isset($_GET['cadastro']) && $_GET['cadastro'] == 'erro') { ?>

          <p class="text-danger">
            Ocorreu um erro ao salvar o registro.
          </p>

        <?php } ?>

        <button class="w3-button w3-theme w3-margin-top w3-margin-bottom" type="submit">Gravar</button>
        <a class="w3-button w3-margin-top w3-margin-bottom w3-right" href="pesquisa_usuarios.php">Cancelar</a>
      </form> 

    </div>
  </div>
</body>

</html>