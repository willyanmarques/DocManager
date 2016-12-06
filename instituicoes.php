 <?php
 require'head.php';
 require 'config/conexao.php';
 ?>

<!-- Dados para a paginacao -->
  <?php 

  //Pega os usuarios do banco de dados
   $sql_code = "SELECT * FROM instituicao ORDER BY nome";

   $execute  = $mysqli  -> query($sql_code) or die ($mysqli->error);
   $instituicao  = $execute -> fetch_assoc();
   $num      = $execute -> num_rows;

  ?>
<!-- /Dados para a paginacao -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Controle de Instituições<small></small></h1>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-2">
        <button type="button" class="btn btn-block btn-success btn-novo" data-toggle="modal" data-target="#modalCadastro">Nova Instituição</button>  
      </div>
    </div>

        <div class="nav-tabs-custom">
            <div class="box-body">
            <?php if ($num > 0) { ?>
            <table id="example1" class="table table-bordered table-hover table-condensed">
            <thead>
              <tr style="font-weight: bold;">
                <th>Nome</th>
                <th>Endereço</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>UF</th>
                <th>Status</th>
                <th>E-mail</th>
                <th style="text-align: center;">Ações</td>
              </tr>
            </thead>
            <tbody>
            <?php do{ ?>
              <tr>
                <td><span data-toggle="tooltip" data-placement="top" title="<?php echo $instituicao['tipo']; ?>"><?php echo $instituicao['nome']; ?></span></td>
                <td><?php echo $instituicao['endereco']; ?></td>
                <td><?php echo $instituicao['bairro']; ?></td>
                <td><?php echo $instituicao['cidade']; ?></td>
                <td><?php echo $instituicao['uf']; ?></td>
                <td>
                <?php if ($instituicao['status']==1) { echo "<span class=\"label label-success\">Ativo</span>";}
                      else { echo "<span class=\"label label-danger\">Inativo</span>"; }
                ?>
                </td>
                <td><?php echo $instituicao['email']; ?></td>
                <td>
                  <div class="btn-acoes">
                  <div class="col-md-6">
                  <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#editar_instituicao_<?php echo $instituicao['id'];?>"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Editar"></i></button>  
                  </div>
                 <div class="col-md-6">
                  <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#excluir_instituicao_<?php echo $instituicao['id'];?>"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Excluir"></i></button>
                 </div>
                 </div>
                </td>
              </tr>

          <!-- Modal Edição -->      
              <div class="modal fade" id="editar_instituicao_<?php echo $instituicao['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Você está editando a(o), <?php echo $instituicao['tipo'].":<br>"." ".'<b>'.$instituicao['nome'].'</b>'; ?></h4>
                      </div>
                      <div class="modal-body">
                        <!-- general form elements -->
                          <!-- Form Edicao -->
                          <form role="form" id="formEditar" action="config/editInstituicao.php" method="POST" enctype="multipart/form-data">
                            <!-- ESSE INPUT CAPTURA O ID DA INSTITUICAO -->
                            <input name='id' type='hidden' value="<?php echo $instituicao['id']; ?>"/>

                            <div class="box-body">


                              <?php 

                                $forum = "";
                                $cm = "";
                                $up = "";

                              if ($instituicao['tipo'] == "Forum") {

                                  $forum = "selected";

                                } if ($instituicao['tipo'] == "Centro de Monitoramento") {
                                  
                                  $cm = "selected";

                                } if ($instituicao['tipo'] == "Unidade Prisional") {
                                  
                                  $up = "selected";

                                }

                              ?>


                              <div class="form-group">
                                <label>Tipo de Instituição</label>
                                <select name="tipo" class="form-control select2" required style="width: 100%;">
                                  <option value="Centro de Monitoramento" <?php echo $cm; ?>>Centro de Monitoramento</option>
                                  <option value="Forum" <?php echo $forum; ?>>Fórum</option>
                                  <option value="Unidade Prisional" <?php echo $up; ?>>Unidade Prisional</option>
                                </select>
                              </div>              
                              <div class="form-group">
                              <div class="row">
                              <div class="col-md-6">
                                <label for="exampleInputEmail1">Nome</label>
                                <input type="text" name="nome" value="<?php echo $instituicao['nome'] ?>" class="form-control" placeholder="Nome Completo" required="">
                                </div>
                                <div class="col-md-6">
                                <label for="exampleInputEmail1">Sigla</label>
                                <input type="text" name="sigla" value="<?php echo $instituicao['sigla'] ?>" class="form-control" placeholder="Nome Completo" required="">
                                </div>
                                </div> 
                              </div>
                              <div class="form-group">
                              <div class="row">
                              <div class="col-md-4">
                                <label>Bairro</label>
                                <input type="text" name="bairro" value="<?php echo $instituicao['bairro'] ?>" class="form-control" placeholder="Nome Bairro" required="">
                                </div>
                                <div class="col-md-4">
                                <label>Cidade</label>
                                <input type="text" name="cidade" value="<?php echo $instituicao['cidade'] ?>" class="form-control" placeholder="Nome da Cidade" required="">
                                </div>

                              <div class="col-md-4 form-group">
                                <label>UF</label>
                                <select name="uf" class="form-control select2" required style="width: 100%;">
                                <option value="<?php echo $instituicao['uf']; ?>"><?php echo $instituicao['uf'] ?></option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espirito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraiba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                                </select> <!-- Combo Box Estados -->
                              </div>  
                                </div> 
                              </div>
                             <div class="form-group">
                              <div class="row">
                              <div class="col-md-4">
                                <label>CEP</label>
                                <input type="text" name="cep" value="<?php echo $instituicao['cep'] ?>" class="form-control cep" placeholder="CEP da Instituição" required>
                                </div>
                                <div class="col-md-8">
                                <label>Endereço</label>
                                <input type="text" name="endereco" value="<?php echo $instituicao['endereco'] ?>" class="form-control" placeholder="Endereço Completo" required="">
                                </div>
                                </div> 
                              </div>
                              <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" name="email" value="<?php echo $instituicao['email'] ?>" class="form-control" placeholder="exemplo@dominio.com" required="">
                              </div>

                              <!-- Escolha do status -->
                                <?php 

                                $ativo = "";
                                $inativo = "";

                              if ($instituicao['status'] == "1") {

                                  $ativo = "checked";

                                } if ($instituicao['status'] == "0") {
                                  
                                  $inativo = "checked";

                                }

                              ?>
                              <div class="ls-label">
                                <p>Selecione o status do instituição:</p>
                                <label class="ls-label-text">
                                  <input type="radio" name="status" value="1" class="ls-field-radio" <?php echo $ativo ?>>
                                  Ativa
                                </label>
                                <label class="ls-label-text">
                                  <input type="radio" name="status" value="0" class="ls-field-radio"  <?php echo $inativo ?>>
                                  Inativa
                                </label>
                              </div>
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
          <!-- /Modal Edição -->

          <!-- Modal Excluir -->
              <div class="modal fade bs-example-modal-sm" id="excluir_instituicao_<?php echo $instituicao['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Exclusão de Instituição</h4>
                  </div>
                  <div class="modal-body"> <!-- box-body -->
                      <!-- Form Excluir -->
                      <form role="form" id="formExcluir" action="config/excluirInstituicao.php" method="POST" enctype="multipart/form-data">
                        <div class="box-body">

                                <p>Deseja realmente excluir a instituição?</p> 
                                <h4><?php echo $instituicao['tipo']." ".$instituicao['nome'] ?></h4>
                                <input type="hidden" name="ID-INST" value="<?php echo $instituicao['id']?>" />
                                
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

              <?php } while ($instituicao = $execute ->fetch_assoc()); ?>
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
              <h4 class="modal-title" id="myModalLabel">Cadastro de Instituição</h4>
            </div>
            <div class="modal-body">
              <!-- general form elements -->
                <!-- Form Cadastro -->
                          <form role="form" id="formEditar" action="config/addInstituicao.php" method="POST" enctype="multipart/form-data">

                            <div class="box-body">
                              <div class="form-group">
                                <label>Tipo de Instituição</label>
                                <select name="tipo" class="form-control select2" required style="width: 100%;">
                                  <option value="Centro de Monitoramento">Centro de Monitoramento</option>
                                  <option value="Forum">Fórum</option>
                                  <option value="Unidade Prisional">Unidade Prisional</option>
                                </select>
                              </div>              
                              <div class="form-group">
                              <div class="row">
                              <div class="col-md-6">
                                <label>Nome</label>
                                <input type="text" name="nome" class="form-control" placeholder="Nome Completo" required="">
                                </div>
                                <div class="col-md-6">
                                <label>Sigla</label>
                                <input type="text" name="sigla" class="form-control" placeholder="Sigla da Instituição" required="">
                                </div>
                                </div> 
                              </div>
                              <div class="form-group">
                              <div class="row">
                              <div class="col-md-4">
                                <label>Bairro</label>
                                <input type="text" name="bairro" class="form-control" placeholder="Nome do Bairro" required="">
                                </div>
                                <div class="col-md-4">
                                <label>Cidade</label>
                                <input type="text" name="cidade" class="form-control" placeholder="Nome da Cidade" required="">
                                </div>

                              <div class="col-md-4 form-group">
                                <label>UF</label>
                                <select name="uf" class="form-control select2" required style="width: 100%;">
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espirito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraiba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                                </select> <!-- Combo Box Estados -->
                              </div>  
                                </div> 
                              </div>
                             <div class="form-group">
                              <div class="row">
                              <div class="col-md-4">
                                <label>CEP</label>
                                <input type="text" name="cep" class="form-control cep" placeholder="CEP da Instituição"  maxlength="10" required>
                                </div>
                                <div class="col-md-8">
                                <label>Endereço</label>
                                <input type="text" name="endereco" class="form-control" placeholder="Endereço Completo" required="">
                                </div>
                                </div> 
                              </div>
                              <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" name="email" class="form-control" placeholder="exemplo@dominio.com" required="">
                              </div>

                              <!-- Escolha do status -->
                              <div class="ls-label">
                                <p>Selecione o status do instituição:</p>
                                <label class="ls-label-text">
                                  <input type="radio" name="status" value="1" class="ls-field-radio" checked>
                                  Ativa
                                </label>
                                <label class="ls-label-text">
                                  <input type="radio" name="status" value="0" class="ls-field-radio">
                                  Inativa
                                </label>
                              </div>
                              </div>
                            <!-- /.box-body -->
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="fecharModalEditar" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar instituição</button>
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
        
        echo "<script>setTimeout(function(){ window.location.replace(\"instituicoes.php\"); }, 3000);</script>";
      
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
<?php require 'dist/js/mascaras.html'; ?>

<?php require 'footer.php'; ?>



