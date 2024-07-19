<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Senai</title>

  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

  <!-- CSS  -->
  <link rel="stylesheet" type="text/css" href="./plugins/bootstrap/css/bootstrap.css" media="screen">
  <link rel="stylesheet" type="text/css" href="./css/styles.css" media="screen">

  <!-- FAVICON -->
  <link rel="icon" sizes="192x192" href="./img/favicon.jpg" type="image/x-icon">
</head>
<body>

  <?php
  //INSIRO A CLASSE USUARIO
  include_once 'classes/Usuario.php';

  $erro       = false;
  $cadastrado = false;
  $mensagem   = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //VALIDEI SE ESTA TUDO VAZIO OU ALGUM VAZIO
    if(empty($_POST['nome']) OR empty($_POST['usuario']) OR empty($_POST['senha']) OR empty($_POST['confirmarSenha'])){
      $erro     = true;
      $mensagem = 'Preencha os campos obrigatórios';
    }elseif($_POST['senha']  !=  $_POST['confirmarSenha']){
      //VALIDEI SENHAS DIFERENTES
      $erro     = true;
      $mensagem = 'Senha são diferentes!';
    }else{

      //BUSCO OS DADOS DE USUARIO
      $condicao = 'usuario = "'.$_POST['usuario'].'"';
      $obUsuario = new Usuario;
      $retornoUsuario = $obUsuario->getUsuario($condicao);

      //SE O RETORNO NÃO FOR UM OBJETO SIGNIFICA QUE ELE NÃO ENCONTROU NO BANCO DE DADOS
      if(!is_object($retornoUsuario)){
        $dados = [ 'nome'=>$_POST['nome'], 'usuario'=>$_POST['usuario'], 'senha'=>md5($_POST['senha'])];

        $obUsuario->setUsuario($dados);

        $cadastrado = true;
        $mensagem   = 'Usuário cadastrado com sucesso';
      }else{
        $erro     = true;
        $mensagem = 'Usuário já cadastrado';
      }
    }
  }
  ?>

  <section class="pagina-login">
    <div class="login">

      <div class="login-logo">
        <img src="./img/logo.png" height="54" alt="" class="img-fluid">
      </div>

      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-sm-12">
              <?php
              if($erro == true){
                echo '<div class="alert alert-danger">
                      '.$mensagem.'
                      </div>';
              }elseif($cadastrado == true){
                echo '<div class="alert alert-success">
                      '.$mensagem.'
                      </div>';
              }
              ?>
            </div>
          </div>

          <p class="login-titulo">Cadastre-se:</p>

          <form method="post">
            <div class="input-group mb-3">
              <input name="nome" type="text" class="form-control" placeholder="Nome">
            </div>
            <div class="input-group mb-3">
              <input name="usuario" type="text" class="form-control" placeholder="Usuário">
            </div>
            <div class="input-group mb-3">
              <input name="senha" type="password" class="form-control" placeholder="Senha">
            </div>
            <div class="input-group mb-3">
              <input name="confirmarSenha" type="password" class="form-control" placeholder="Confirmar senha">
            </div>
            <div class="row">
              <div class="col-12">
                <button name="btnEnviar" type="submit" class="btn btn-primary btn-block">Cadastrar</button>
              </div>
            </div>
          </form>

          <p class="mt-3 mb-1">
            <a href="./login">Faça o login</a>
          </p>
        </div>

      </div>
    </div>
  </div>


  <!-- SCRIPTS -->
  <script src="./plugins/jquery/jquery-3.2.1.min.js"></script>
</body>
</html>
