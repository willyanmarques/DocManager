<?php 
      session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Doc Manager | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- AJAX RECUPERAR SENHA -->
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
           <script type="text/javascript">
             jQuery(document).ready(function(){
               jQuery('#recuperaSenha').submit(function(){
                 var dados = jQuery( this ).serialize();

                 jQuery.ajax({
                   type: "POST",
                   url: "config/recuperaSenha.php",
                   data: dados,
                   success: function( data )
                   {

                      alert('Um E-mail com os dados de acesso foi enviado. Por favor, verifique sua caixa de entrada!')

                         $('#recuperaSenha').each (function(){
                         this.reset();
                     });

                   } // success

                 });
                 
               return false;

               });
              });
         </script>
    <!-- /AJAX RECUPERAR SENHA -->

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Doc Manager</b></a><br>
    <small style="font-size: 20px;">Gestão Eletrônica de Documentos</small>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Efetue login para obter acesso.</p>

    <form action="config/validaLogin.php" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="E-mail" required="required">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="senha" class="form-control" placeholder="Senha" autocomplete="off" required="required">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4 pull-right">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->

    <a href="validaDocumento.php">Autenticar documentos</a><br>
    <a href="#" data-toggle="modal" data-target="#modalRecuperaSenha">Esqueceu sua senha?</a><br><br>

    <div class="row">
      <div class="col-md-12">
       <?php


          if  (isset($_SESSION['loginErro'])){

            echo "<div class='alert alert-danger alert-dismissible'>";
            echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";

              echo $_SESSION['loginErro'];
              unset ($_SESSION['loginErro']);

            echo "</div>";

          } if (isset($_SESSION['loginExpirado'])) {

            echo "<div class='alert alert-warning alert-dismissible'>";
            echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";

              echo $_SESSION['loginExpirado'];
              unset ($_SESSION['loginExpirado']);

            echo "</div>";

          } 

           ?> 
      </div>
    </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- Modal Recuperar Senha -->      
    <div class="modal fade bs-example-modal-md" id="modalRecuperaSenha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Recuperação de senha</h4>
        </div>
        <div class="modal-body"> <!-- box-body -->
            <!-- Form Excluir -->
            <form role="form" id="recuperaSenha" action="config/recuperaSenha.php" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                  
                    <div class="col-md-12">
                      <p>Por favor, insira seu E-mail utilizado para acessar o sistema.</p>
                      <label>E-mail</label>
                      <input type="email" name="email" class="form-control" placeholder="Seu E-mail" required="required">
                      </div>
                      
                </div>
              <!-- /.box-body -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Recuperar</button>
        </div>
        </form>
      </div>
    </div>
    </div>
<!-- /Modal Recuperar Senha -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
