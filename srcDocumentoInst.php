     <?php
     require'head.php';
     require 'config/conexao.php';
     ?>

     <!-- AJAX ENVIAR O FORMULARIO EMAIL DOCUMENTO -->
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
              <script type="text/javascript">
                jQuery(document).ready(function(){
                  jQuery('.formEmail').submit(function(){
                    var dados = jQuery( this ).serialize();

                    jQuery.ajax({
                      type: "POST",
                      url: "config/enviarDocInst.php",
                      data: dados,
                      success: function( data )
                      {

                         alert('Documento Enviando com Sucesso!')

                            $('.formEmail').each (function(){
                            this.reset();
                        });

                      } // success

                    });
                    
                  return false;

                  });
                 });
            </script>
       <!-- /AJAX ENVIAR O FORMULARIO EMAIL DOCUMENTO -->

       <!-- AJAX ENVIAR O FORMULARIO EDITAR DOCUMENTO -->
              <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
                <script type="text/javascript">
                  jQuery(document).ready(function(){
                    jQuery('.formEditar').submit(function(){
                      var dados = jQuery( this ).serialize();

                      jQuery.ajax({
                        type: "POST",
                        url: "config/editDocInst.php",
                        data: dados,
                        success: function( data )
                        {

                           alert('Documento Editado com Sucesso!')

                           location.reload(); // Recarrega a pagina

                        } // success

                      });
                      
                    return false;

                    });
                   });
              </script>
         <!-- /AJAX ENVIAR O FORMULARIO EDITAR DOCUMENTO -->

     <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Lista de Documentos<small></small></h1>
        </section>

        <!-- Main content -->
        <section class="content">

        <?php 

              $nome = @$_POST['nomeRemetente'];
              $tipoDocumento = @$_POST['tipoDocumento'];
              $instituicao = @$_POST['instituicao'];
              $origem = @$_POST['origem'];
              $assunto = @$_POST['assunto'];

              $dataDe = @$_POST['dataDe'];

              $dataDe = DateTime::createFromFormat('d/m/Y', $dataDe); // Forcando conversao da data

              $dataAte = @$_POST['dataAte'];

              $dataAte = DateTime::createFromFormat('d/m/Y', $dataAte); // Forcando conversao da data

              $dataResposta = @$_POST['dataResposta'];

              $dataResposta = DateTime::createFromFormat('d/m/Y', $dataResposta); // Forcando conversao da data

               //$dataDe2 = DateTime::createFromFormat('Y-m-d', $dataDe);
               $dataDe2 = $dataDe->format('Y-m-d'); //Convertendo padrao americano
               //$dataAte2 = DateTime::createFromFormat('Y-m-d', $dataAte);
               $dataAte2 = $dataAte->format('Y-m-d'); //Convertendo padrao americano
               //$dataResposta2 = $dataResposta->format('Y-m-d'); //Convertendo padrao americano


            $sql_code = "SELECT doc.id AS id_documento, doc.arquivo, doc.dataDocumento, doc.dataResposta, doc.tipo_documento_id, doc.assunto, doc.observacao, doc.cod_validacao AS chaveDoc, doc.dataCadastro, doc.nomeRemetente, doc.emailRemetente, doc.instRemetente, doc.status, doc.instituicao_origem_id, tpdoc.id, tpdoc.descricao, inst.id AS instID, inst.tipo AS tipoInstituicao, inst.nome AS nomeInstituicao, inst.cidade, inst.uf FROM documento_instituicao doc, tipo_documento tpdoc, instituicao inst WHERE doc.tipo_documento_id = tpdoc.id AND doc.instituicao_origem_id = inst.id AND doc.nomeRemetente = '$nome' AND (doc.dataDocumento BETWEEN '$dataDe2' AND '$dataAte2') AND doc.assunto LIKE '%$assunto%' AND doc.tipo_documento_id LIKE '%$tipoDocumento%' ORDER BY tpdoc.descricao";


            $execute  = $mysqli  -> query($sql_code) or die ($mysqli->error);                                                                                
            $docInst  = $execute -> fetch_assoc();
            $num      = $execute -> num_rows;

            $dataInicio = date("d/m/Y", strtotime($dataDe2));
            $dataFim = date("d/m/Y", strtotime($dataAte2));
            ?>                                                                                                      

                <div class="panel panel-default">
                <div class="panel-heading"><h4><b>Exibindo documentos do remetente: </b> <?php echo $docInst['nomeRemetente'];?> <b>no período de:</b> <?php echo $dataInicio." à ".$dataFim;?></h4>
                </div>
                  <div class="panel-body">
                    <div class="row">

                    <?php 
                            if ($num > 0) { 

                                do { ?>

                        <div class="col-md-3">
                        <div class="box box-primary">
                          <div class="box-body box-profile">
                            <div class="caixa_corte"> 
                           <img id="imgCorte" class="img-responsive img-thumbnail" width="380px" src="upload/documentos/instituicao/<?php echo $docInst['arquivo'];?>">
                           </div>
                           <!-- <h3 class="profile-username text-center">Nina Mcintire</h3>

                            <p class="text-muted text-center">Software Engineer</p> -->

                            <ul class="list-group list-group-unbordered">
                              <li class="list-group-item">
                                <b>Tipo:</b> <span><?php echo $docInst['descricao']; ?></span>
                              </li>
                              <li class="list-group-item">
                                <b>Assunto:</b> <span><?php echo $docInst['assunto']; ?></span> 
                              </li>
                              <li class="list-group-item">

                                <?php 
                                $data = $docInst['dataDocumento'];
                                $novaData = date("d/m/Y", strtotime($data));
                                ?>

                                <b>Cadastrado em:</b> <span><?php echo $novaData; ?></span> 

                              </li>

                              <li class="list-group-item">

                                <?php 
                                $dataAtual = date('Y-m-d');
                                ?>

                                <b>Data de resposta:</b> 
                                <?php if ($docInst['dataResposta'] <= $dataAtual && $docInst['status'] == 0) {

                                  echo "<span style=\"color: #f20909\">".date("d/m/Y", strtotime($docInst['dataResposta']))."</span>"; 
                                } else {

                                  echo "<span>".date("d/m/Y", strtotime($docInst['dataResposta']))."</span>"; 

                                  }?> 

                              </li>
                            </ul>

                            <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#view_doc_<?php echo $docInst['id_documento'];?>">Visualizar documento</a>
                          </div>
                          <!-- /.box-body -->
                        </div>
                        </div>


                        <!-- Modal Exibir Documento -->

                        <div class="modal fade" tabindex="-1" role="dialog" id="view_doc_<?php echo $docInst['id_documento'];?>">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Visualização do documento</h4>
                              </div>
                              <div class="modal-body">

                              <img class="img-responsive img-thumbnail" src="upload/documentos/instituicao/<?php echo $docInst['arquivo'];?>">

                              </div>
                             <div class="modal-footer">
                               <a href="#" class="btn btn-success" data-toggle="modal" data-target="#docEmail_<?php echo $docInst['id_documento'];?>">Enviar por E-mail</b></a>
                               <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#docEditar_<?php echo $docInst['id_documento'];?>">Editar</b></a>
                               <!--<button type="submit" class="btn btn-danger">Excluir</button>-->
                               <button type="submit" class="btn btn-warning">Imprimir</button>
                               <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                             </div>
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <!-- /Modal Exibir Documento -->  

                        <!-- Modal Envio Documento -->

                        <div class="modal fade" tabindex="-1" role="dialog" id="docEmail_<?php echo $docInst['id_documento'];?>">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Dados de Envio</h4>
                              </div>
                              <div class="modal-body">
                              <form class="formEmail" action="" method="POST" enctype="multipart/form-data"> <!-- FORM -->

                            <?php 
                            $idLogSessao = $_SESSION['instituicao_id'];
                            $query = "SELECT i.tipo, i.nome FROM instituicao i, usuario u WHERE i.id = $idLogSessao";
                            $instituicaoLogado  = $mysqli  -> query($query) or die ($mysqli->error);
                            $instLog  = $instituicaoLogado -> fetch_assoc();

                             ?>

                              <div class="row">
                              <div class="form-group">
                              <div class="col-md-12">
                              <label>Remetente:</label>
                                <input type="text" class="form-control" name="nome" value="<?php echo $_SESSION['nome']." ".$_SESSION['sobrenome']." (".$instLog['tipo']." ".$instLog['nome'].")" ?>" required="required" readonly>
                              </div>
                              </div>
                              </div> <!-- /row -->

                              <div class="row" style="padding-top: 15px;">
                              <div class="col-md-12"> <!-- DESTINATARIO -->
                              <label>Unidade:</label>
                              <?php $destinatario = $mysqli->query("SELECT * FROM instituicao WHERE status = '1' ORDER BY nome"); ?>
                                <div class="form-group">
                                  <select name="emailUnidade" class="form-control" style="width: 100%;" required="required">
                                  <option value="">Selecione uma unidade</option>
                                    <?php foreach ($destinatario as $dest) { ?>
                                    <option value="<?php echo $dest['email']; ?>"> <?php echo $dest['tipo']." - ".$dest['nome']." (".$dest['cidade']."/".$dest['uf'].")";?> </option>
                                     <?php } ?>
                              </select>
                              </div>                  
                              </div> <!-- /DESTINATARIO -->
                              </div> <!-- /row -->

                              <div class="row">
                              <div class="form-group">
                              <div class="col-md-12">
                              <label>Título:</label>
                                <input type="text" class="form-control" name="tituloEmail" placeholder="Título" required="required">
                              </div>
                              </div>
                              </div> <!-- /row -->

                              <div class="row" style="padding-top: 15px;">
                              <div class="form-group">
                              <div class="col-md-12">
                              <label>Mensagem:</label>
                                <textarea class="form-control" rows="4" name="mensagem" placeholder="Escreva aqui..." required="required" style="resize: none;"></textarea>
                              </div>
                              </div>
                              </div> <!-- /row -->

                              <br>
                              <div class="row">
                              <div class="form-group">
                              <div class="col-md-12">
                              <label>Chave de autenticação:</label>
                                <input type="text" class="form-control" name="chaveDoc" value="<?php echo $docInst['chaveDoc']; ?>" required="required" readonly>
                              </div>
                              </div>
                              </div> <!-- /row -->

                              <input type="hidden" name="arquivo" value="<?php echo $docInst['arquivo']; ?>">
                              
                              </div> <!-- /modal-body-->
                             <div class="modal-footer">
                             <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                               <button type="submit" class="btn btn-success">Enviar</button>
                             </div>
                             </form> <!-- /FORM -->
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        
                        <!-- /Modal Envio Documento -->  

                        <!-- Modal Editar Documento -->

                        <div class="modal fade" tabindex="-1" role="dialog" id="docEditar_<?php echo $docInst['id_documento'];?>">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edição do Documento</h4>
                              </div>
                              <div class="modal-body">
                              <form class="formEditar" action="config/editDocInst.php" method="POST" enctype="multipart/form-data"> <!-- FORM -->

                              <input type="hidden" name="id_documento" value="<?php echo $docInst['id_documento'];?>">

                              <div class="row">
                              <div class="form-group">
                              <div class="col-md-6">
                              <label>Remetente:</label>
                                <input type="text" class="form-control" name="nomeRemetente" value="<?php echo $docInst['nomeRemetente'] ?>" required="required" readonly>
                              </div>
                              

                              <div class="col-md-6">
                              <label>E-mail do remetente:</label>
                                <input type="text" class="form-control" name="emailRemetente" value="<?php echo $docInst['emailRemetente'] ?>" required="required" readonly>
                              </div>
                              </div>
                              </div> <!-- /row -->

                              <div class="row"><br>
                              <div class="form-group">
                              <div class="col-md-6">
                              <label>Assunto:</label>
                                <input type="text" class="form-control" name="assunto" value="<?php echo $docInst['assunto'] ?>" required="required">
                              </div>
                              

                              <div class="col-md-6"> <!-- TIPO DE DOCUMENTOS CADASTRADOS -->
                              <label>Tipo do documento:</label>
                              <?php $TipoDoc = $mysqli->query("SELECT * FROM tipo_documento ORDER BY descricao"); ?>
                                <div class="form-group">
                                  <select name="tipoDocumento" class="form-control" style="width: 100%;">
                                  <option style="font-weight: bold;" value="<?php echo $docInst['tipo_documento_id']?>"><?php echo $docInst['descricao']; ?></option>

                                    <?php foreach ($TipoDoc as $doc) { ?>
                                    <option value="<?php echo $doc['id']; ?>"><?php echo $doc['descricao'];?></option>
                                     <?php } ?>
                              </select>
                              </div>                  
                              </div> <!-- /TIPO DE DOCUMENTOS CADASTRADOS -->
                              </div>
                              </div> <!-- /row -->

                              <div class="row">
                              <div class="col-md-6">
                                <label>Data de resposta:</label>
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" name="dataResposta" value="<?php echo date('d/m/Y', strtotime($docInst['dataResposta'])); ?>" placeholder="dd/mm/aaaa" class="form-control pull-right data" required>
                                </div>
                              </div>

                              <div class="col-md-6">
                                <label>Data de emissão:</label>
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" name="dataDocumento" value="<?php echo date('d/m/Y', strtotime($docInst['dataDocumento'])); ?>" placeholder="dd/mm/aaaa" class="form-control pull-right data" required>
                                </div>
                              </div>
                              </div><!-- /row -->

                              <div class="row" style="padding-top: 15px;">
                              <div class="col-md-12"> <!-- INSTITUICOES DE ORIGEM -->
                                <label>Origem:</label>
                                <?php $instituicao = $mysqli->query("SELECT id, tipo, nome, cidade, uf FROM instituicao ORDER BY tipo"); ?>
                                  <div class="form-group">
                                    <select name="origem" class="form-control select2" style="width: 100%;">

                                    <option style="font-weight: bold;" value="<?php echo $docInst['instID']?>"><?php echo $docInst['tipoInstituicao']." - ".$docInst['nomeInstituicao']." (".$docInst['cidade']."/".$docInst['uf'].")";?></option>

                                      <?php foreach ($instituicao as $inst) { ?>
                                      <option value="<?php echo $inst['id']; ?>"><?php echo $inst['tipo']." - ".$inst['nome']." (".$inst['cidade']."/".$inst['uf'].")";?></option>
                                       <?php } ?>
                                  </select>
                                </div>                  
                                </div> <!-- /INSTITUICOES DE ORIGEM -->
                              </div> <!-- /row -->

                              <div class="row">
                              <div class="form-group">
                              <div class="col-md-12">
                              <label>Observações:</label>
                                <textarea class="form-control" rows="4" name="observacao" placeholder="Escreva aqui..." required="required" style="resize: none;"><?php echo $docInst['observacao']; ?></textarea>
                              </div>
                              </div>
                              </div> <!-- /row -->

                              <br>
                              <div class="row">
                              <div class="form-group">
                              <div class="col-md-6">
                              <label>Chave de autenticação:</label>
                                <input type="text" class="form-control" name="chaveDoc" value="<?php echo $docInst['chaveDoc']; ?>" required="required" readonly>
                              </div>
                              
                              <!-- Escolha do status -->
                                <?php 

                                $pendente = "";
                                $enviado = "";

                              if ($docInst['status'] == "1") {

                                  $enviado = "checked";

                                } if ($docInst['status'] == "0") {
                                  
                                  $pendente = "checked";

                                }

                              ?>
                            
                              <label>Status do documento:</label><br>
                                <label>
                                  <input type="radio" value="1" name="status" class="minimal" <?php echo $enviado; ?>>
                                  Enviado
                                </label>&emsp;&emsp;  
                                <label>
                                  <input type="radio" value="0" name="status" class="minimal" <?php echo $pendente; ?>>
                                  Pendente
                                </label>
                             </div>
                              </div> <!-- /row -->
                              
                              </div> <!-- /modal-body-->
                             <div class="modal-footer">
                             <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                               <button type="submit" class="btn btn-primary">Salvar alterações</button>
                             </div>
                             </form> <!-- /FORM -->
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        
                        <!-- /Modal Editar Documento -->  


             <?php   }  while ($docInst = $execute ->fetch_assoc()); ?>

                    </div>
                    </div>
                </div>              

                <?php  } 

                else {echo "<div class=\"content\"><h4>Desculpe, nenhum registro encontrado aos filtros aplicados!</h4></div>";}

                ?>

            </section>
            <!-- /Main content -->
            </div>
            <!-- /Content Wrapper -->

    <!-- Style Cortar o a imagem do doc -->

            <style type="text/css">

                .caixa_corte {
                height: 250px;
                overflow:hidden;
                }

                .caixa_corte #imgCorte {
                width: auto;
                position: relative;
                }

            </style>
    <!-- Style Cortar o a imagem do doc -->

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
            
            echo "<script>setTimeout(function(){ window.location.replace(\"srcDocumentoInst.php\"); }, 3000);</script>";
          
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

    <?php require 'footer.php' ?>

