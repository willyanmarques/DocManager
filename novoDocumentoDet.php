<?php require'head.php';
      include'config/conexao.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Cadastro de Documento<small>a caráter do detento</small></h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Conteudo aqui -->

      <div class="row">
                <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">

        <!-- TAB DOC DETENTO -->
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
              <form id="docDetento" action="config/addDocDetento.php" method="POST" enctype="multipart/form-data"> <!-- FORM -->
              <div class="row">

              <div class="col-md-2" style="">
              <div class="form-group">
                <label>Data:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="data" name="dataDocumento" placeholder="dd/mm/aaaa" required>
                </div>
                <!-- /.input group -->
              </div>
              </div>

            <div class="col-md-5"> <!-- INSTITUICOES DE ORIGEM -->
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

              <div class="col-md-5"> <!-- INSTITUICOES CADASTRADOS -->
              <label>Destinatário:</label>
              <?php $instituicao = $mysqli->query("SELECT id, tipo, nome FROM instituicao ORDER BY tipo"); ?>
                <div class="form-group">
                  <select name="destinatario" class="form-control select2" style="width: 100%;">
                  <option>Selecione a instituição de destino</option>
                    <?php foreach ($instituicao as $inst) { ?>
                    <option value="<?php echo $inst['id']; ?>"><?php echo $inst['tipo']." - ".$inst['nome'];?></option>
                     <?php } ?>
                </select>
              </div>                  
              </div> <!-- /INSTITUICOES CADASTRADOS -->

              </div> <!-- /row -->
              <div class="row">

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

                <div class="col-md-4"> <!-- DETENTOS CADASTRADOS -->
                <label>Detento:</label>
                  <?php $detento = $mysqli->query("SELECT d.id, d.prontuario, d.nome as nomeDetento, d.instituicao_id, i.tipo, i.nome as nomeUnidade FROM detento d, instituicao i WHERE d.instituicao_id = i.id ORDER BY d.nome"); ?>

                    <div class="form-group">
                      <select name="detento" class="form-control select2" style="width: 100%;">
                      <option>Selecione o detento(a)</option>
                        <?php foreach ($detento as $det) { ?>
                        <option value="<?php echo $det['id']; ?>"><?php echo $det['prontuario']." - ".$det['nomeDetento'];?></option>
                         <?php } ?>
                         <input type="hidden" name="id_inst_detento" value="<?php echo $det['instituicao_id']; ?>">
                      </select>
                    </div>                  
              </div> <!-- /DETENTOS CADASTRADOS -->

              <div class="col-md-3">
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
              </div>
              <!-- /.tab-pane -->

      <!-- TAB TIPO DE DOCUMENTO -->

      <div class="tab-pane" id="tab_2">

              <div class="row">
                <div class="col-md-1">
                  <button type="button" class="btn btn-block btn-success btn-novo" data-toggle="modal" data-target="#modalCadastro"><i class="fa fa-plus" aria-hidden="true"></i></button>  
                </div>
            </div>

        <?php 

        //Pega os usuarios do banco de dados
         $sql_code = "SELECT * FROM tipo_documento ORDER BY descricao";

         $execute  = $mysqli  -> query($sql_code) or die ($mysqli->error);
         $tipo_doc  = $execute -> fetch_assoc();
         $num      = $execute -> num_rows;

        ?>

      <div class="row">
      <div class="col-md-6">
          <div class="box-body">
          <?php if ($num > 0) { ?>
          <table id="example1" class="table table-bordered table-hover table-condensed">
          <thead>
            <tr style="font-weight: bold;">
              <th>Descrição</th>
              <th style="text-align: center;">Ações</td>
            </tr>
          </thead>
          <tbody>
          <?php do{ ?>
            <tr>
              <td><?php echo $tipo_doc['descricao']; ?></td>
              <td style="width: 170px;">
                <div class="btn-acoes">
                <div class="col-md-6">
                <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#editar_tipoDoc_<?php echo $tipo_doc['id'];?>"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Editar"></i></button>  
                </div>
               <div class="col-md-6">
                <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#excluir_tipoDoc_<?php echo $tipo_doc['id'];?>"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Excluir"></i></button>
               </div>
               </div>
              </td>
            </tr>

            <?php } while ($tipo_doc = $execute ->fetch_assoc()); ?>
          </tbody>
            </table>
          <?php } ?>
          </div>
          <!-- /.box-body -->
          </div>
        </div>
        <!-- /.row -->

            </div>
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
        
        echo "<script>setTimeout(function(){ window.location.replace(\"novoDocumentoDet.php\"); }, 3000);</script>";
      
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
        
        unset($_POST['validaNotificacao']); // Destroi o post
        
       // echo "<script>setTimeout(function(){ window.location.replace(\"usuarios.php\"); }, 2000);</script>";
      
    }


    ?>
<!-- /CHAMA A NOTIFICACAO -->

<!-- IMPORTANDO MASCARA -->
<?php require 'dist/js/mascaras.html' ?>

<?php require 'footer.php'; ?>