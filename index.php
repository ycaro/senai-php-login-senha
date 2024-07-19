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
  //CARREGO DO USUARIO
  include_once 'classes/Usuario.php';

  $erro     = false;
  $logado   = false;
  $mensagem = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //VALIDEI SE ESTA TUDO VAZIO OU ALGUM VAZIO
    if(empty($_POST['usuario']) OR empty($_POST['senha'])){
      $erro     = true;
      $mensagem = 'Preencha os campos obrigatórios';
    }else{
      //MONTO A CONDIÇÃO PARA BUSCAR NO BANCO DE DADOS SE O USUARIO EXISTE
      $condicao = 'usuario = "'.$_POST['usuario'].'" AND senha = "'.md5($_POST['senha']).'"';
      $obUsuario      = new Usuario;
      $retornoUsuario = $obUsuario->getUsuario($condicao);

      //SE O RETORNO FOR UM OBJETO SIGNIFICA QUE ACHOU, PRECISAMOS CONFIRMAR SE A SENHA BATE COM A ENVIADA VIA POST
      if(is_object($retornoUsuario)){
        $logado    = true;
        $mensagem  = 'Logado com sucesso';
      }else{
        $erro     = true;
        $mensagem = 'Dados inválidos.';
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
        <div class="card-body login-card-body">

          <div class="row">
            <?php
            if($erro == true){
              echo '<div class="col-12 alert alert-danger">
                    '.$mensagem.'
                    </div>';
            }elseif($logado == true){
              echo '<div class="col-12 alert alert-success">
                    '.$mensagem.'
                    </div>';
            }
            ?>
          </div>
          <p class="login-msg">Faça login para iniciar sua sessão</p>

          <form method="post">
            <div class="input-group mb-3">
              <input name="usuario" type="text" class="form-control" placeholder="Usuário">
            </div>
            <div class="input-group mb-3">
              <input name="senha" type="password" class="form-control" placeholder="Senha">
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" name="btnEnviar" class="btn btn-success btn-block">Acessar</button>
              </div>
            </div>
          </form>

          <p class="mt-3">
            <a href="./cadastro">Ainda não é inscrito? Cadastre-se!</a>
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- SCRIPTS -->
  <script src="./plugins/jquery/jquery-3.2.1.min.js"></script>
</body>
</html>
