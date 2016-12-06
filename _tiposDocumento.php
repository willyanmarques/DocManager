

              <div class="tab-pane" id="tab_1">

                <div class="row">
                  <div class="col-md-2">
                    <button type="button" class="btn btn-block btn-success btn-novo" data-toggle="modal" data-target="#modalCadastro">Novo</button>  
                  </div>
              </div>

          <?php 

           //Pega os tipos de documento do banco de dados
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
                                <input type="text" name="nome" class="form-control" value="<?php echo $tipo_doc['descricao']; ?>" placeholder="Descrição do tipo de documento" required="">
                                </div>
                                <input type="hidden" name="ID-INST" value="<?php echo $tipo_doc['id']?>" />
                                
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
                      <form role="form" id="formExcluir" action="config/excluirTipoDoc.php" method="POST" enctype="multipart/form-data">
                        <div class="box-body">

                                <p>Deseja realmente excluir o tipo de documento?</p> 
                                <h4><?php echo $tipo_doc['descricao'];?></h4>
                                <input type="hidden" name="ID-INST" value="<?php echo $tipo_doc['id']?>" />
                                
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