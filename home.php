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
                $qtdUsuarioAtivo = $row['qtd'];
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

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="fa fa-user"></i></span>

            <?php 
            $result = $mysqli->query("SELECT COUNT(*) AS qtd FROM usuario WHERE status = 1");
            $row = $result->fetch_assoc();
            $result->close();
            $qtdUsuarioInativo = $row['qtd'];
            ?>

            <div class="info-box-content">
              <span class="info-box-text">USUÁRIOS ATIVOS</span>
              <span class="info-box-number"><?php echo $row['qtd']; ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                  <?php 
                   $valor = $qtdUsuarioInativo/$qtdUsuarioAtivo;
                   echo round($valor*100)."% dos usuários ativos";
                  ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">41,410</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Events</span>
              <span class="info-box-number">41,410</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Comments</span>
              <span class="info-box-number">41,410</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
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