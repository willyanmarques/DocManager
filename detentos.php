 <?php
 require'head.php';
 require 'config/conexao.php';
 ?>

<!-- Dados para a paginacao -->
  <?php 

  //Pega os usuarios do banco de dados
   $sql_code = "SELECT d.id, d.prontuario, d.nome as nomeDetento, d.nome_mae, d.regime, d.instituicao_id, d.status, i.sigla, i.nome as nomeUnidade, d.dataCadastro FROM detento d, instituicao i WHERE d.instituicao_id = i.id ORDER BY nomeDetento";

   $execute  = $mysqli  -> query($sql_code) or die ($mysqli->error);
   $detento  = $execute -> fetch_assoc();
   $num      = $execute -> num_rows;

  ?>
<!-- /Dados para a paginacao -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Controle de Detentos<small></small></h1>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-2">
        <button type="button" class="btn btn-block btn-success btn-novo" data-toggle="modal" data-target="#modalCadastro">Novo detento</button>  
      </div>
    </div>

        <div class="nav-tabs-custom">
            <!-- /.box-header -->
            <div class="box-body">
            <?php if ($num > 0) { ?>
            <table id="example1" class="table table-bordered table-hover table-condensed">
            <thead>
              <tr style="font-weight: bold;">
                <th>Prontuário</th>
                <th>Nome</th>
                <th>Nome da Mãe</th>
                <th>Unidade Prisional</th>
                <th>Regime</th>
                <th>Status</th>
                <th>Data do Cadastro</th>
                <th style="text-align: center;">Ações</th>
              </tr>
            </thead>
            <tbody>
            <?php do{ ?>
              <tr>
                <td><?php echo $detento['prontuario']; ?></td>
                <td><?php echo $detento['nomeDetento']; ?></td>
                <td><?php echo $detento['nome_mae']; ?></td>
                <td><?php echo $detento['nomeUnidade']; ?></td>
                <td><?php if($detento['regime'] == 'aberto') {echo '<span class="label label-success">Aberto</span>';} if($detento['regime'] == 's_aberto') {echo '<span class="label label-warning">Semiaberto</span>';} if($detento['regime'] == 'fechado') { echo '<span class="label label-danger">Fechado</span>'; }?>
                </td>
                <td>
                <?php if ($detento['status']==1) { echo "<span class=\"label label-success\">Ativo</span>";}
                      else { echo "<span class=\"label label-danger\">Inativo</span>"; }
                ?>
                </td>
                <td><?php echo $detento['dataCadastro']; ?></td>
                <td>
                  <div class="btn-acoes">
                  <div class="col-md-6">
                  <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#editar_detento_<?php echo $detento['id'];?>"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Editar"></i></button>  
                  </div>
                  <div class="col-md-6">
                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#transferir_detento_<?php echo $detento['id'];?>"><i class="fa fa-exchange" data-toggle="tooltip" data-placement="top" title="Transferir"></i></button>
                 </div>
                 </div>
                </td>
              </tr>

          <!-- Modal Edição -->      
              <div class="modal fade" id="editar_detento_<?php echo $detento['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edição do Detento(a), <?php echo $detento['nomeDetento']; ?></h4>
                      </div>
                      <div class="modal-body">
                        <!-- general form elements -->
                          <!-- Form Edicao -->
                          <form role="form" id="formEditar" action="config/editDetento.php" method="POST" enctype="multipart/form-data">
                            <!-- ESSE INPUT CAPTURA O ID DO USUARIO -->
                            <input name='id' type='hidden' value="<?php echo $detento['id']; ?>"/>
                            <!-- INPUT PARA DEFINIR O TAMANHO MAXIMO DE UPLOAD -->
                            <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
                            <div class="box-body">


                            <div class="form-group">
                              <label for="InputPront">Prontuário</label>
                              <input type="text" name="prontuario"  value="<?php echo $detento['prontuario']; ?>" class="form-control" id="InputPront" maxlength="8"  placeholder="Número do Prontuário" required autofocus>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Nome</label>
                              <input type="text" name="nome"  value="<?php echo $detento['nomeDetento']; ?>" class="form-control" id="InputNome" placeholder="Nome completo" required>
                            </div>                
                            <div class="form-group">
                              <label for="exampleInputEmail1">Nome da Mãe</label>
                              <input type="text" name="nome_mae"  value="<?php echo $detento['nome_mae']; ?>" class="form-control" id="InputNome" placeholder="Nome completo da mãe" required="">
                            </div>

                              <div class="form-group">
                                <label>Regime</label>
                                <select name="regime" class="form-control select2" required style="width: 100%;">
                                  <option value="aberto">Aberto</option>
                                  <option value="fechado">Fechado</option>
                                  <option value="s_aberto">Semiaberto</option>
                                </select>
                              </div>

                              <!-- Escolha do status -->
                                <?php 

                                $ativo = "";
                                $inativo = "";

                              if ($detento['status'] == "1") {

                                  $ativo = "checked";

                                } if ($detento['status'] == "0") {
                                  
                                  $inativo = "checked";

                                }

                              ?>
                              <div class="ls-label">
                                <p>Selecione o status do detento(a):</p>
                                <label class="ls-label-text">
                                  <input type="radio" name="status" value="1" class="ls-field-radio" <?php echo $ativo ?>>
                                  Ativo
                                </label>
                                <label class="ls-label-text">
                                  <input type="radio" name="status" value="0" class="ls-field-radio"  <?php echo $inativo ?>>
                                  Inativo
                                </label>
                              </div>
                            <!-- /.box-body -->
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="fecharModalEditar" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar alterações</button>
                      </div>
                      </form>
                      <!-- /Form Cadastro -->
                    </div>
                  </div>
              </div>
              </div>
          <!-- /Modal Edição -->

          <!-- Modal Excluir -->
              <div class="modal fade bs-example-modal-sm" id="excluir_detento_<?php echo $detento['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Exclusão de Detento(a)</h4>
                  </div>
                  <div class="modal-body"> <!-- box-body -->
                      <!-- Form Excluir -->
                      <form role="form" id="formExcluir" action="config/excluirDetento.php" method="POST" enctype="multipart/form-data">
                        <div class="box-body">

                        <p>Deseja realmente excluir o detento(a)?</p> 
                        <h4><b><?php echo $detento['nomeDetento']; ?></b></h4>
                        <input type="hidden" name="ID-DETENTO" value="<?php echo $detento['id']?>" />

                        </div>
                        <!-- /.box-body -->
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="fecharModalExcluir" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Excluir</button>
                  </div>
                  </form>
                  <!-- /Form Excluir -->
                </div>
              </div>
              </div>
          <!-- /Modal Excluir -->    

          <!-- Modal Transferir Detento -->
              <div class="modal fade bs-example-modal-sm" id="transferir_detento_<?php echo $detento['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Transferência de Detentos</h4>
                    </div>
                    <div class="modal-body">
                    <form role="form" action="config/transfDetento.php" method="POST" enctype="multipart/form-data"> <!-- Form tranferir detento-->
                      <div class="box-body"> <!-- box-body -->

                      <p>O detento(a),<br> <?php echo "<b>".$detento['nomeDetento']."</b>."; ?>
                      <br>Atualmente encontra-se na Unidade Prisional: <?php echo "<b>".$detento['nomeUnidade']."</b>."; ?></p>

                      <?php
                      include'config/conexao.php'; 
                      $query = ("SELECT id, tipo, nome FROM instituicao WHERE tipo = 'Unidade Prisional' AND status = '1' ");
                      $executeQuery  = $mysqli  -> query($query) or die ($mysqli->error);
                      ?>

                      <div class="form-group">
                        <label>Transferir para:</label>
                        <select name="instituicao" class="form-control select2" required style="width: 100%;">
                          <option value="">Selecione uma Unidade Prisional</option>
                          <?php while($dados = mysqli_fetch_array($executeQuery)){ ?>
                          <option value="<?php echo $dados['id']; ?>"><?php echo $dados['tipo']." ".$dados['nome']; ?></option>
                          <?php }?>
                        </select>
                      </div>

                        <input type="hidden" name="ID-DETENTO" value="<?php echo $detento['id']?>" />
                      </div> <!-- /.box-body -->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" id="fecharModalExcluir" data-dismiss="modal">Fechar</button>
                      <button type="submit" class="btn btn-primary">Transferir</button>
                    </div>
                    </form> <!-- /Form transferir detento -->
                  </div>
                </div>
              </div>
          <!-- /Modal Transferir Detento -->

              <?php } while ($detento = $execute ->fetch_assoc()); ?>
            </tbody>
              </table>
            <?php } ?>
            </div>
            <!-- /.box-body -->

          </div>
          <!-- /.box -->

        </section>
        <!-- /Main content -->
        </div>
        <!-- /Content Wrapper -->


<!-- Modal Cadastro -->
      <div class="modal fade" data-toggle="validator" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Cadastro de Detento</h4>
            </div>
            <div class="modal-body">
              <!-- general form elements -->
                <!-- Form Cadastro -->
                <form role="form" id="formCadastro" action="config/addDetento.php" method="POST" enctype="multipart/form-data">
                  <div class="box-body">

                    <div class="form-group">
                      <label for="InputPront">Prontuário</label>
                      <input type="text" name="prontuario" class="form-control" maxlength="8"  placeholder="Número do Prontuário" required autofocus>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Nome</label>
                      <input type="text" name="nome" class="form-control" placeholder="Nome completo" required>
                    </div>                
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nome da Mãe</label>
                      <input type="text" name="nome_mae" class="form-control" placeholder="Nome completo da mãe" required="">
                    </div>

                      <div class="form-group">
                        <label>Regime</label>
                        <select name="regime" class="form-control select2" required style="width: 100%;">
                          <option value="aberto">Aberto</option>
                          <option value="fechado">Fechado</option>
                          <option value="s_aberto">Semiaberto</option>
                        </select>
                      </div>

                    <?php 
                                        
                    require 'config/config.php';
                    require 'config/connection.php';
                    require 'config/database.php';
                    $link = DB_Connect();
                    $instituicao = DB_Read('instituicao', 'id, tipo, nome', "WHERE tipo = 'Unidade Prisional' AND status = '1'");                 
              
                    ?> 

                    <div class="form-group">
                     <label>Unidade Prisional</label>
                      <select name="instituicao" class="form-control select2" required style="width: 100%;">
                        <option selected="selected">Selecione uma Unidade Prisional</option>
                        <?php foreach ($instituicao as $inst) { ?>
                        <option value="<?php echo $inst['id'] ?>"><?php echo $inst['tipo']." - ".$inst['nome'] ?></option>
                        <?php echo $inst['id'];}?>
                      </select>
                      <?php DB_Close($link); ?>
                    </div>

                    <!-- Escolha do sexo -->
                     <div class="form-group">
                        <div class="ls-label">
                          <p>Selecione o sexo do novo detento(a):</p>
                          <label class="ls-label-text">
                            <input type="radio" name="sexo" value="1" class="ls-field-radio btn-radio" checked>
                            Masculino
                          </label>
                          <label class="ls-label-text">
                            <input type="radio" name="sexo" value="2" class="ls-field-radio btn-radio ">
                            Feminino
                          </label>
                        </div>
                        </div>
                        <!-- /Escolha do sexo -->

                        <div class="ls-label">
                          <p>Selecione o status do detento(a):</p>
                          <label class="ls-label-text">
                            <input type="radio" name="status" value="1" class="ls-field-radio" checked="checked">
                            Ativo
                          </label>
                          <label class="ls-label-text">
                            <input type="radio" name="status" value="0" class="ls-field-radio">
                            Inativo
                          </label>
                        </div>
                    </div>
                  <!-- /.box-body -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" id="fecharModalCadastro" data-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-primary">Cadastrar detento</button>
            </div>
            </form>
            <!-- /Form Cadastro -->
          </div>
        </div>
      </div>
<!-- /Modal Cadastro -->

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
        
        echo "<script>setTimeout(function(){ window.location.replace(\"detentos.php\"); }, 3000);</script>";
      
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



