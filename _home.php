<?php 

      require'head.php';
      include'config/conexao.php';

      ?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Dashboard<small>Informações Complementares</small></h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Conteudo -->

            <!-- Small boxes (Stat box) -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">

                <?php 
                $result = $mysqli->query("SELECT COUNT(*) AS qtd FROM usuario");
                $row = $result->fetch_assoc();
                $result->close();
                ?>

              <h3><?php echo $row['qtd']; ?></h3>
              <p>Usuários Cadastrados</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="usuarios.php" class="small-box-footer">Mais informações</a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">

                <?php 
                $result = $mysqli->query("SELECT COUNT(*) AS qtd FROM advogado");
                $row = $result->fetch_assoc();
                $result->close();
                ?>

              <h3><?php echo $row['qtd']; ?></h3>
              <p>Advogados Cadastrados</p>
            </div>
            <div class="icon">
              <i class="fa fa-briefcase"></i>
            </div>
            <a href="advogado.php" class="small-box-footer">Mais informações</a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">

                <?php 
                $result = $mysqli->query("SELECT COUNT(*) AS qtd FROM documento_detento");
                $row = $result->fetch_assoc();
                $result->close();
                ?>

              <h3><?php echo $row['qtd']; ?></h3>
              <p>Documentos Cadastrados</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-text"></i>
            </div>
            <a href="#" class="small-box-footer">Mais informações</a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">

                <?php 
                $result = $mysqli->query("SELECT COUNT(*) AS qtd FROM detento");
                $row = $result->fetch_assoc();
                $result->close();
                ?>

              <h3><?php echo $row['qtd']; ?></h3>
              <p>Detentos Cadastrados</p>
            </div>
            <div class="icon">
              <i class="fa fa-lock"></i>
            </div>
            <a href="detentos.php" class="small-box-footer">Mais informações</a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.Conteudo -->
  </div>
  <!-- /.content-wrapper -->
<?php require 'footer.php'; ?>