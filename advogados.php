 <?php
 require'head.php';
 require 'config/conexao.php';
 ?>

<!-- Dados para a paginacao -->
  <?php 

  //Pega os usuarios do banco de dados
   $sql_code  = "SELECT * FROM advogado ORDER BY nome";

   $execute   = $mysqli  -> query($sql_code) or die ($mysqli->error);
   $advogado  = $execute -> fetch_assoc();
   $num       = $execute -> num_rows;

  ?>
<!-- /Dados para a paginacao -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Controle de Advogados<small></small></h1>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-2">
        <button type="button" class="btn btn-block btn-success btn-novo" data-toggle="modal" data-target="#modalCadastro">Novo advogado</button>  
      </div>
    </div>

        <div class="nav-tabs-custom">
            <!-- /.box-header -->
            <div class="box-body">
            <?php if ($num > 0) { ?>
            <table id="example1" class="table table-bordered table-hover table-condensed">
            <thead>
              <tr style="font-weight: bold;">
                <th>OAB</th>
                <th>CPF</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Status</th>
                <th>Data do Cadastro</th>
                <th style="text-align: center;">Ações</th>
              </tr>
            </thead>
            <tbody>
            <?php do{ ?>
              <tr>
                <td><?php echo $advogado['oab']; ?></td>
                <td><?php echo $advogado['cpf']; ?></td>
                <td><?php echo $advogado['nome']. " " . $advogado['sobrenome']; ?></td>
                <td><?php echo $advogado['email']; ?></td>
                <td>
                <?php if ($advogado['status']==1) { echo "<span class=\"label label-success\">Ativo</span>";}
                      else { echo "<span class=\"label label-danger\">Inativo</span>"; }
                ?>
                </td>
                <td><?php echo $advogado['dataCadastro']; ?></td>
                <td>
                  <div class="btn-acoes">
                  <div class="col-md-4">
                  <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#editar_advogado_<?php echo $advogado['id'];?>"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Editar"></i></button>  
                  </div>
                 <div class="col-md-4">
                  <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#excluir_advogado_<?php echo $advogado['id'];?>"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Excluir"></i></button>
                 </div>
                 <div class="col-md-4">
                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#alterar_senha_<?php echo $advogado['id'];?>"><i class="fa fa-repeat" data-toggle="tooltip" data-placement="top" title="Redefinir Senha"></i></button>
                 </div>
                 </div>
                </td>
              </tr>

          <!-- Modal Edição -->      
              <div class="modal fade" id="editar_advogado_<?php echo $advogado['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edição do Advogado(a), <?php echo $advogado['nome']; ?></h4>
                      </div>
                      <div class="modal-body">
                        <!-- general form elements -->
                          <!-- Form Edicao -->
                          <form role="form" id="formEditar" action="config/editAdvogado.php" method="POST" enctype="multipart/form-data">
                            <!-- ESSE INPUT CAPTURA O ID DO USUARIO -->
                            <input name='id' type='hidden' value="<?php echo $advogado['id']; ?>"/>
                            <!-- INPUT PARA DEFINIR O TAMANHO MAXIMO DE UPLOAD -->
                            <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
                            <div class="box-body">

                            <div class="form-group">
                            <div class="row">
                            <div class="col-md-4 col-xs-4"></div>
                            <div class="col-md-4 col-xs-4">
                            <img src="upload/imagem_perfil/advogado/<?php echo $advogado['arquivo'];?>" width="150" height="150" class="img-circle">
                            <div class="col-md-4 col-xs-4"></div>
                            </div>
                            </div>
                            </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input type="text" name="nome" value="<?php echo $advogado['nome'] ?>" class="form-control" id="InputNome" placeholder="Nome" required="" autofocus="">
                              </div>                
                              <div class="form-group">
                                <label for="exampleInputEmail1">Sobrenome</label>
                                <input type="text" name="sobrenome" value="<?php echo $advogado['sobrenome'] ?>" class="form-control" id="InputNome" placeholder="Sobrenome" required="">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">E-mail</label>
                                <input type="email" name="email" value="<?php echo $advogado['email'] ?>" class="form-control" id="exampleInputEmail1" placeholder="exemplo@dominio.com" required="">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">CPF</label>
                                <input type="text" name="cpf"  value="<?php echo $advogado['cpf'] ?>" class="form-control" id="InputNome" placeholder="000.000.000-00" required="">
                              </div>
                              <div class="form-group">
                                <label for="InputOAB">OAB</label>
                                <input type="text" name="oab"  value="<?php echo $advogado['oab'] ?>" class="form-control" required>
                              </div>

                              <!-- Escolha do status -->
                                <?php 

                                $ativo = "";
                                $inativo = "";

                              if ($advogado['status'] == "1") {

                                  $ativo = "checked";

                                } if ($advogado['status'] == "0") {
                                  
                                  $inativo = "checked";

                                }

                              ?>
                              <div class="ls-label">
                                <p>Selecione o status do advogado(a):</p>
                                <label class="ls-label-text">
                                  <input type="radio" name="status" value="1" class="ls-field-radio" <?php echo $ativo ?>>
                                  Ativo
                                </label>
                                <label class="ls-label-text">
                                  <input type="radio" name="status" value="0" class="ls-field-radio"  <?php echo $inativo ?>>
                                  Inativo
                                </label>
                              </div>
                              <hr>
                            <div class="form-group">
                              <input type="file" class="text-align" name="arquivo" id="InputFileImgPerfil">
                              <p class="help-block">Alterar Foto do Perfil</p>
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
              <div class="modal fade bs-example-modal-sm" id="excluir_advogado_<?php echo $advogado['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Exclusão de Advogado(a)</h4>
                  </div>
                  <div class="modal-body"> <!-- box-body -->
                      <!-- Form Excluir -->
                      <form role="form" id="formExcluir" action="config/excluirAdvogado.php" method="POST" enctype="multipart/form-data">
                        <div class="box-body">

                                <p>Deseja realmente excluir o advogado(a)?</p> 
                                <h3><?php echo $advogado['nome']." ".$advogado['sobrenome'] ?></h3>
                                <input type="hidden" name="ID-USER" value="<?php echo $advogado['id']?>" />
                                <input type="hidden" name="nomeImagem" value="<?php echo $advogado['arquivo']?>" />
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

          <!-- Modal Alterar Senha -->
              <div class="modal fade bs-example-modal-sm" id="alterar_senha_<?php echo $advogado['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Redefinição de senha</h4>
                    </div>
                    <div class="modal-body">
                    <form role="form" id="formExcluir" action="config/altSenhaAdvogado.php" method="POST" enctype="multipart/form-data"> <!-- Form alterar senha -->
                      <div class="box-body"> <!-- box-body -->

                        <div class="form-group">
                          <label for="InputPassword">Nova senha</label>
                          <input type="password" name="novaSenha" class="form-control" placeholder="Nova Senha" data-minlength="6" maxlength="10" required>
                        <span class="help-block">Mínimo de seis (6) digitos</span>
                        
                        <input type="hidden" name="ID-USER" value="<?php echo $advogado['id']?>" />
                        </div>

                      </div> <!-- /.box-body -->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" id="fecharModalExcluir" data-dismiss="modal">Fechar</button>
                      <button type="submit" class="btn btn-primary">Redefinir</button>
                    </div>
                    </form> <!-- /Form alterar senha -->
                  </div>
                </div>
              </div>
          <!-- /Modal alterar Senha -->

              <?php } while ($advogado = $execute ->fetch_assoc()); ?>
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
              <h4 class="modal-title" id="myModalLabel">Cadastro de Advogado</h4>
            </div>
            <div class="modal-body">
              <!-- general form elements -->
                <!-- Form Cadastro -->
                <form role="form" id="formCadastro" action="config/addAdvogado.php" method="POST" enctype="multipart/form-data">
                  <div class="box-body">

                    <div class="form-group">
                      <label for="exampleInputEmail1">Nome</label>
                      <input type="text" name="nome" class="form-control" id="InputNome" placeholder="Nome" required="" autofocus="">
                    </div>                
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sobrenome</label>
                      <input type="text" name="sobrenome" class="form-control" id="InputNome" placeholder="Sobrenome" required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">E-mail</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="exemplo@dominio.com" required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">CPF</label>
                      <input type="text" name="cpf" class="form-control" id="cpf" placeholder="000.000.000-00" required>
                    </div>

                    <div class="form-group">
                      <label for="InputOAB">OAB</label>
                      <input type="text" name="oab" class="form-control" id="cpf" maxlength="6" required>
                    </div>

                    <div class="form-group">
                      <label for="eInputPassword">Senha</label>
                      <input type="password" name="senha" class="form-control" id="InputPassword" placeholder="Senha" data-minlength="6" maxlength="10" required>
                    <span class="help-block">Mínimo de seis (6) digitos</span>
                    </div>

                    <!-- Escolha do sexo -->
                     <div class="form-group">
                        <div class="ls-label">
                          <p>Selecione o sexo do novo advogado(a):</p>
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
                      
                    <hr>
                    <!-- Escolha do status -->
                    <div class="ls-label">
                      <p>Selecione o status do novo usuário(a):</p>
                      <label class="ls-label-text">
                        <input type="radio" name="status" value="1" class="ls-field-radio" checked>
                        Ativo
                      </label>
                      <label class="ls-label-text">
                        <input type="radio" name="status" value="0" class="ls-field-radio">
                        Inativo
                      </label>
                    </div>
                      <hr>
                      <div class="form-group">
                      <label for="exampleInputFile">Imagem Perfil</label>
                      <input type="file" name="arquivo" id="InputFile">
                      <p class="help-block">Upload maxímo: 2MB</p>
                    </div>
                    </div>
                  <!-- /.box-body -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" id="fecharModalCadastro" data-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-primary">Cadastrar advogado</button>
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
        
        echo "<script>setTimeout(function(){ window.location.replace(\"advogados.php\"); }, 3000);</script>";
      
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



