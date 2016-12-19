<?php 
  
  session_start();

  if ($_SESSION['statusLogin'] != 'LOGADO') {

      header("Location: index.php"); 

    }

  if ( isset( $_SESSION["sessiontime"] ) ) { 
    if ($_SESSION["sessiontime"] < time() ) { 
      session_unset();
      $_SESSION['loginExpirado'] = "Desculpe, sua sessão expirou.";
      header("Location: index.php");
    } else {
      //Seta mais tempo 600 (10 mim) segundos
      $_SESSION["sessiontime"] = time() + 600;
    }
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DocManager | Gestão Eletronica de Documentos</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Style CSS -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- Animate CSS -->
  <link rel="stylesheet" type="text/css" href="css/animate.css">
    <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="css/ionicons.min.css">
    <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Select Dinamico Vinculos -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Theme style --> 
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
<link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

<!-- REQUISICAO JS SCRIPTS -->

<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- Bootstrap 3.3.6 -->

<!-- Nnotificacao -->
<script src="notificacao/bootstrap-notify.js"></script>

<script href="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="home.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!--<span class="logo-mini"><b>A</b>LT</span> -->
      <small class="logo-mini">DM</small>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><i class="fa fa-folder-open"></i> Doc Manager</span>

    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-success">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Você tem 0 notificações</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                   <!-- <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a> -->
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="#">Ver todas</a></li>
            </ul>
          </li>

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $_SESSION['nome']." ".$_SESSION['sobrenome']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="upload/imagem_perfil/usuario/<?php echo $_SESSION['arquivo'];?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['nome']." ".$_SESSION['sobrenome']; ?>

                  <small>
                    <?php 
                        if($_SESSION['perfil'] == 'adm') {echo "Administrador";}
                        if($_SESSION['perfil'] == 'adm_instituicao') {echo "Adm. da Instituição";} 
                        if($_SESSION['perfil'] == 'consulta') {echo "Consulta";}
                        if($_SESSION['perfil'] == 'op_documento') {echo "Operador de Documento";} 
                      ?>
                  </small>
                </p>
              </li>

              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="config/logout.php" class="btn btn-default btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="config/logout.php" title="Sair"><i class="fa fa-sign-out"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MENU DE NAVEGAÇÃO</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active "><a href="home.php"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li><a href="usuarios.php"><i class="fa fa-users"></i> <span>Usuários</span></a></li>
       <li class="treeview">
          <a href="#"><i class="fa fa-briefcase"></i> <span>Advogados</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="advogados.php"><i class="fa fa-circle-o"></i>Advogados</a></li>
            <li><a href="vinDetento.php"><i class="fa fa-circle-o"></i>Vincular Detento</a></li>
            <li><a href="vinInstituicao.php"><i class="fa fa-circle-o"></i>Vincular Instituição</a></li>
          </ul>
        </li>
        <li><a href="detentos.php"><i class="fa fa-user-times"></i> <span>Detentos</span></a></li>

          <li class="treeview">
          <a href="#"><i class="fa fa-file-text"></i> <span>Documentos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="novoDocumentoDet.php"><i class="fa fa-circle-o"></i>Novo Documento</a></li>
            <li><a href="tiposDocumento.php"><i class="fa fa-circle-o"></i>Tipos de Documento</a></li>
            <li><a href="consultarDoc.php"><i class="fa fa-circle-o"></i>Consultar Documento</a></li>
            <li><a href="validaDocumento.php" target="_blank"><i class="fa fa-circle-o"></i>Validar Documento</a></li>
            
          </ul>
        </li>

        <li><a href="instituicoes.php"><i class="fa fa-university"></i> <span>Instituições</span></a></li>
       </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>