<?php require'head.php';
      include'config/conexao.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Cadastro de Novos Tipos de Documento<small>apenas descrições</small></h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Conteudo aqui -->

        <div class="row">
          <div class="col-md-2">
            <button type="button" class="btn btn-block btn-success btn-novo" data-toggle="modal" data-target="#modalCadastro">Novo</button>  
          </div>
      </div>

      <div class="row">

                <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="">

                  <div class="nav-tabs-custom">

              <?php 

               //Pega os tipos de documento do banco de dados
               $sql_code = "SELECT * FROM tipo_documento ORDER BY descricao";

               $execute  = $mysqli  -> query($sql_code) or die ($mysqli->error);
               $tipo_doc  = $execute -> fetch_assoc();
               $num      = $execute -> num_rows;

              ?>

            <div class="row">
            <div class="col-md-12">
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

              <!-- Modal Edição -->      
                  <div class="modal fade bs-example-modal-sm" id="editar_tipoDoc_<?php echo $tipo_doc['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edição de descrição</h4>
                      </div>
                      <div class="modal-body"> <!-- box-body -->
                          <!-- Form Excluir -->
                          <form role="form" id="formExcluir" action="config/editTipoDoc.php" method="POST" enctype="multipart/form-data">
                            <div class="box-body">

                                  <div class="col-md-12">
                                    <label>Descrição</label>
                                    <input type="text" name="descricao" class="form-control" value="<?php echo $tipo_doc['descricao']; ?>" placeholder="Descrição do tipo de documento" required="">
                                    </div>
                                    <input type="hidden" name="id_tipoDoc" value="<?php echo $tipo_doc['id']?>" />
                                    
                              </div>
                            <!-- /.box-body -->
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar alterações</button>
                      </div>
                      </form>
                      <!-- /Form Excluir -->
                    </div>
                  </div>
                  </div>
              <!-- /Modal Edição -->

              <!-- Modal Excluir -->      
                  <div class="modal fade bs-example-modal-sm" id="excluir_tipoDoc_<?php echo $tipo_doc['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Exclusão de descrição</h4>
                      </div>
                      <div class="modal-body"> <!-- box-body -->
                          <!-- Form Excluir -->
                          <form role="form" action="config/excluirTipoDoc.php" method="POST" enctype="multipart/form-data">
                            <div class="box-body">

                                    <p>Deseja realmente excluir o tipo de documento?</p> 
                                    <h4><?php echo $tipo_doc['descricao'];?></h4>
                                    <input type="hidden" name="id_tipoDoc" value="<?php echo $tipo_doc['id']?>" />
                                    
                              </div>
                            <!-- /.box-body -->
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Excluir</button>
                      </div>
                      </form>
                      <!-- /Form Excluir -->
                    </div>
                  </div>
                  </div>
              <!-- /Modal Excluir -->

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
 


      <!-- Modal Cadastro -->      
          <div class="modal fade bs-example-modal-sm" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Novo Tipo de Documento</h4>
              </div>
              <div class="modal-body"> <!-- box-body -->
                  <!-- Form Excluir -->
                  <form role="form" action="config/addTipoDoc.php" method="POST" enctype="multipart/form-data">
                    <div class="box-body">

                          <div class="col-md-12">
                            <label>Descrição</label>
                            <input type="text" name="descricao" class="form-control" placeholder="Descreva o tipo de documento" required="" autofocus>
                            </div>   
                      </div>
                    <!-- /.box-body -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
              </div>
              </form>
              <!-- /Form Excluir -->
            </div>
          </div>
          </div>
      <!-- /Modal Cadastro -->

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
        
        echo "<script>setTimeout(function(){ window.location.replace(\"tiposDocumento.php\"); }, 3000);</script>";
      
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