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

  <!-- AJAX ENVIAR O FORMULARIO DOC INSTITUICAO -->
       <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
            <script type="text/javascript">
              jQuery(document).ready(function(){
                jQuery('#docDetento').submit(function(){
                  var dados = jQuery( this ).serialize();

                  jQuery.ajax({
                    type: "POST",
                    url: "config/addDocInstituicao.php",
                    data: dados,
                    success: function( data )
                    {

                      $.notify('<strong>Operação Realizada com Sucesso!</strong>', {
                              type: 'success',
                              allow_dismiss: true,
                              showProgressbar: false,
                              placement: {
                              from: 'top',
                              align: 'center',
                            }

                            });

                          $('#docDetento').each (function(){
                          this.reset();
                      });

                    } // success

                  });
                  
                return false;

                });
               });
          </script>
  <!-- /AJAX ENVIAR O FORMULARIO DOC INSTITUICAO -->

      <div class="row">
                <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Instituição</a></li>
              <li><a href="#tab_2" data-toggle="tab">Tipos de documento</a></li>
            </ul>

        <!-- TAB DOC DETENTO -->
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
              <form id="docDetento" action="config/addDocInstituicao.php" method="POST" enctype="multipart/form-data"> <!-- FORM -->
              <div class="row">
              <div class="col-md-2">
                <label>Data de emissão:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="dataDocumento" placeholder="dd/mm/aaaa" class="form-control pull-right" id="datepicker" autocomplete="off" required>
                </div>
              </div>

            <div class="col-md-5"> <!-- INSTITUICOES DE ORIGEM -->
              <label>Origem:</label>
              <?php $instituicao = $mysqli->query("SELECT id, tipo, nome, cidade, uf FROM instituicao ORDER BY tipo"); ?>
                <div class="form-group">
                  <select name="origem" class="form-control select2" style="width: 100%;">
                  <option selected>Selecione a instituição de origem do documento</option>
                    <?php foreach ($instituicao as $inst) { ?>
                    <option value="<?php echo $inst['nome']; ?>"><?php echo $inst['tipo']." - ".$inst['nome']." (".$inst['cidade']."/".$inst['uf'].")";?></option>
                     <?php } ?>
                     <input type="hidden" name="id_inst_origem" value="<?php echo $inst['id']; ?>">
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
      <!-- /TAB DOC DETENTO -->

              <div class="tab-pane" id="tab_2">
                <p>Tipos de documentos</p>
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

<?php require 'footer.php'; ?>