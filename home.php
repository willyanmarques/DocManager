<?php require'head.php'; 
      require'config/conexao.php'; ?>

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
          <div class="small-box bg-blue">
            <div class="inner">

                <?php 
                $result = $mysqli->query("SELECT COUNT(*) AS qtd FROM usuario");
                $row = $result->fetch_assoc();
                $result->close();
                ?>

              <h3><?php echo $row['qtd']; ?></h3>
              <p>USUÁRIOS CADASTRADOS</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="usuarios.php" class="small-box-footer">Mais informações</a>
          </div>
        </div>

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
              <p>ADVOGADOS CADASTRADOS</p>
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
              <p>DOCUMENTOS CADASTRADOS</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-text"></i>
            </div>
            <a href="#" class="small-box-footer">Mais informações</a>
          </div>
        </div>
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
              <p>DETENTOS CADASTRADOS</p>
            </div>
            <div class="icon">
              <i class="fa fa-lock"></i>
            </div>
            <a href="detentos.php" class="small-box-footer">Mais informações</a>
          </div>
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">DETENTOS REGIME</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require 'footer.php'; ?>