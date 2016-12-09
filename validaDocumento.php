<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Doc Manager | Validação de Documento</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins -->
  </header>

  <body class="hold-transition lockscreen">
  <!-- Automatic element centering -->
  <div class="login-box">
 <div class="login-logo">
   <a href="validaDocumento.php"><b>Doc Manager</b></a><br>
   <small style="font-size: 20px;">Gestão Eletrônica de Documentos</small>
 </div>
    <!-- User name -->
    <div class="lockscreen-name">Serviço de Verificação de Autenticidade de Documentos</div>

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
      <!-- /.lockscreen-image -->

      <!-- lockscreen credentials (contains the form) -->
      <form method="POST" action="config/autenticaDoc.php">
        <div class="input-group">
          <input type="text" class="form-control chaveDoc" name="chave" placeholder="Chave de verificação" required="require" autocomplete="off">

          <div class="input-group-btn">
            <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
          </div>
        </div>
      </form>
      <!-- /.lockscreen credentials -->
    </div>

    <div class="row">
      <div class="col-md-12 col-sm-12">
        <?php 
     

        switch (@$_POST['validaDoc']) {
        
            case 'valido' :
            echo "<div class='alert alert-success alert-dismissible'>";
            echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";

              echo "Documento validado com sucesso!";
              unset ($_POST['validaDoc']);

            echo "</div>";
                break;

            case 'invalido' :
            echo "<div class='alert alert-danger alert-dismissible'>";
            echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";

              echo "Documento não encontrado!<br>Por favor, verifique a chave e tente novamente.";
              unset ($_POST['validaDoc']);

            echo "</div>";
                break;

            default:
                $var = $_POST['validaDoc'] = NULL;
                break;
        }

        
        ?>
      </div>
    </div>

    <!-- /.lockscreen-item -->
    <div class="text-center">
      Insira a chave do documento
    </div>
    <div class="text-center">
      <a href="index.php">Ou faça login como um usuário</a>
    </div>
    <div class="lockscreen-footer text-center">
      Copyright &copy; 2016 <a href="http://www.fastsoftwarepe.com.br/codelab" target="_blank">codeLab - Software Quality</a>.</strong> Todos os direitos reservados.
    </div>
  </div>
  <!-- /.center -->

  <!-- jQuery 2.2.3 -->
  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <?php require 'dist/js/mascaras.html' ?>
  </body>
</html>
