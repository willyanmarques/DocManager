<?php require'head.php';
      include'config/conexao.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Cadastro de Documento Instituição<small>sem vínculo com detentos</small></h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Conteudo aqui -->

      <div class="row">
                <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">

        <!-- TAB DOC INST -->
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
              <form id="docDetento" action="config/addDocInstituicao.php" method="POST" enctype="multipart/form-data"> <!-- FORM -->

              <div class="row">

              <legend class="col-md-12" style="font-size: 18px;">Dados do remetente</legend>
              <div class="col-md-3">
                <label>Nome:</label>
                  <input type="text" class="form-control" name="nomeRemetente" value="<?php echo $_SESSION['nome']." ".$_SESSION['sobrenome']?>" autocomplete="off" required readonly>
                </div>

                <div class="col-md-3">
                <label>E-mail:</label>
                  <input type="text" class="form-control" name="emailRemetente" value="<?php echo $_SESSION['email']?>" autocomplete="off" required readonly>
                </div>

                <?php 
                $idLogSessao = $_SESSION['instituicao_id'];
                $query = "SELECT i.tipo, i.nome FROM instituicao i, usuario u WHERE i.id = $idLogSessao";
                $instituicaoLogado  = $mysqli  -> query($query) or die ($mysqli->error);
                $instLog  = $instituicaoLogado -> fetch_assoc();

                 ?>

                <div class="col-md-4">
                <label>Instituição:</label>
                  <input type="text" class="form-control" name="instRemetente" value="<?php echo $instLog['tipo']." - ".$instLog['nome']?>" autocomplete="off" required readonly>
                </div>


              </div> <!--/.row -->

              <div class="row">
              <br>
              <legend class="col-md-12" style="font-size: 18px;">Dados do documento</legend>
              <div class="col-md-2">
                <label>Data de resposta:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="dataResposta" placeholder="dd/mm/aaaa" class="form-control pull-right data" required>
                </div>
              </div>

              <div class="col-md-2">
                <label>Data de emissão:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="dataDocumento" placeholder="dd/mm/aaaa" class="form-control pull-right data" required>
                </div>
              </div> 

              <div class="col-md-6"> <!-- INSTITUICOES DE ORIGEM -->
                <label>Origem:</label>
                <?php $instituicao = $mysqli->query("SELECT id, tipo, nome, cidade, uf FROM instituicao ORDER BY tipo"); ?>
                  <div class="form-group">
                    <select name="origem" class="form-control select2" style="width: 100%;">
                    <option selected>Selecione a instituição de origem do documento</option>
                      <?php foreach ($instituicao as $inst) { ?>
                      <option value="<?php echo $inst['id']; ?>"><?php echo $inst['tipo']." - ".$inst['nome']." (".$inst['cidade']."/".$inst['uf'].")";?></option>
                       <?php } ?>
                  </select>
                </div>                  
                </div> <!-- /INSTITUICOES DE ORIGEM -->

              <div class="col-md-2"> <!-- TIPO DE DOCUMENTOS CADASTRADOS -->
              <label>Tipo do documento:</label>
              <?php $TipoDoc = $mysqli->query("SELECT * FROM tipo_documento ORDER BY descricao"); ?>
                <div class="form-group">
                  <select name="tipoDocumento" class="form-control" style="width: 100%;">
                  <option>Do que se trata?</option>
                    <?php foreach ($TipoDoc as $doc) { ?>
                    <option value="<?php echo $doc['id']; ?>"><?php echo $doc['descricao'];?></option>
                     <?php } ?>
              </select>
              </div>                  
              </div> <!-- /TIPO DE DOCUMENTOS CADASTRADOS -->

              </div> <!-- /row -->

              <div class="row">
              <div class="col-md-4">
              <label>Assunto:</label>
                <input type="text" class="form-control" name="assunto" placeholder="Assunto do documento" autocomplete="off" required>
              </div>

              <?php // ESSA CHAVE SERVE PARA AS DUAS ABAS DE INCLUSAO DE DOCUMENTOS

                function uniqueAlfa($length=20) {
                 $salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                 $len = strlen($salt);
                 $pass = '';
                 mt_srand(10000000*(double)microtime());
                 for ($i = 0; $i < $length; $i++)
                 {
                   $pass .= $salt[mt_rand(0,$len - 1)];
                 }
                 return $pass;
                }

                //gerando alfa de 20 caracteres - padrao da function
                $key = uniqueAlfa();
                $chave = implode('-', str_split($key, 5));
                ?>

                <div class="col-md-3">
                <label>Chave de segurança:</label>
              <div class="input-group">
              <input style="cursor: not-allowed;" type="text" class="form-control" name="chave" value="<?php echo $chave; ?>" readonly>
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
              </div>
              </div>

              </div> <!--/row -->

              <div class="row">
              <br>
              <div class="col-md-12">
              <label>Observações:</label>
                <textarea class="form-control" rows="4" name="observacoes" placeholder="Informações complementares sobre o documento." style="resize: none;"></textarea>
                </div>
              </div> <!-- /row -->
              <br>
              <div class="row">
                <div class="col-md-12">
                      <label>Selecione o documento escaneado:</label>
                      <input type="file" name="arquivo" id="InputFile">
                      <p class="help-block">Imagens no formato (JPG, JPEG, PNG)</p>
                    </div>
              </div> <!-- row -->
              <div class="row">
                <div class="container-fluid pull-right">
                  <button type="submit" class="btn btn-primary">Inserir documento</button>
                </div>
              </div>
              </form> <!-- /FORM -->

              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>    


      <!-- /Conteudo aqui -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- CHAMA A NOTIFICACAO -->
    <?php 

    $var = "BOL";
    if(isset($_POST['validaNotificacao']) && !($_POST['validaNotificacao'] == null)){
      $var = $_POST['validaNotificacao'];
    }

    if ($var == 'sucesso') {
      
        echo "<script>
                  $.notify('<strong>Operação Realizada com Sucesso!</strong>', {
                  type: 'success',
                  icon: 'fa fa-check',
                  allow_dismiss: true,
                  showProgressbar: false,
                  placement: {
                  from: 'top',
                  align: 'center',
                }

                });
            </script>";
        
        unset($_POST['validaNotificacao']);
        
        echo "<script>setTimeout(function(){ window.location.replace(\"novoDocumentoInst.php\"); }, 3000);</script>";
      
    } if ($var == 'erro'){
      
        echo "<script>
                  $.notify('<strong>Erro ao Realizar Operação!</strong>', {
                  type: 'danger',
                  icon: 'fa fa-check',
                  allow_dismiss: true,
                  showProgressbar: false,
                  placement: {
                  from: 'top',
                  align: 'center',
                }

                });
            </script>";
        
        unset($_POST['validaNotificacao']);
        
       // echo "<script>setTimeout(function(){ window.location.replace(\"usuarios.php\"); }, 2000);</script>";
      
    }


    ?>
<!-- /CHAMA A NOTIFICACAO -->

<!-- IMPORTANDO MASCARA -->
<?php require 'dist/js/mascaras.html' ?>

<?php require 'footer.php'; ?>