 <?php
 require'head.php';
 require 'config/conexao.php';
 ?>

  <!-- Dados para a paginacao -->
    <?php 
    //Pega os usuarios do banco de dados
     $sql_code = "SELECT u.id, u.cpf ,u.nome AS nomeUsuario, u.sobrenome, u.email, u.arquivo, i.tipo, i.nome AS nomeInstituicao, u.perfil, u.status, u.instituicao_id, u.dataCadastro FROM usuario u, instituicao i WHERE u.instituicao_id = i.id ORDER BY nomeUsuario";

     $execute  = $mysqli  -> query($sql_code) or die ($mysqli->error);
     $usuario  = $execute -> fetch_assoc();
     $num      = $execute -> num_rows;

    ?>
  <!-- /Dados para a paginacao -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Controle de Usuários<small></small></h1>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-2">
        <button type="button" class="btn btn-block btn-success btn-novo" data-toggle="modal" data-target="#modalCadastro">Novo usuário</button>  
      </div>
    </div>

        <div class="nav-tabs-custom">
            <!-- /.box-header -->
            <div class="box-body">
            <?php if ($num > 0) { ?>
            <table id="example1" class="table table-bordered table-hover table-condensed">
            <thead>
              <tr style="font-weight: bold;">
                <th>Nome</th>
                <th>E-mail</th>
                <th>Instituição</th>
                <th>Perfil</th>
                <th>Status</th>
                <th>Data do Cadastro</th>
                <th style="text-align: center;">Ações</td>
              </tr>
            </thead>
            <tbody>
            <?php do{ ?>
              <tr>
                <td><?php echo $usuario['nomeUsuario']. " " . $usuario['sobrenome']; ?></td>
                <td><?php echo $usuario['email']; ?></td>
                <td><?php echo $usuario['nomeInstituicao']; ?></td>
                <td><?php if($usuario['perfil'] == 'adm') {echo "Administrador";}

                if($usuario['perfil'] == 'adm_instituicao') {echo "Adm. da Instituição";} 
              
                if($usuario['perfil'] == 'consulta') {echo "Consulta";}

                if($usuario['perfil'] == 'op_documento') {echo "Oper. de Documento";} ?>
                </td>
              
                <td>
                <?php if ($usuario['status']==1) { echo "<span class=\"label label-success\">Ativo</span>";}
                      else { echo "<span class=\"label label-danger\">Inativo</span>"; }
                ?>
                </td>
                <td><?php echo date('d/m/Y - H:i:s', strtotime($usuario['dataCadastro'])); ?></td>
                <td>
                  <div class="btn-acoes">
                  <div class="col-md-4">
                  <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#editar_usuario_<?php echo $usuario['id'];?>"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Editar"></i></button>  
                  </div>
                 <div class="col-md-4">
                  <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#excluir_usuario_<?php echo $usuario['id'];?>"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Excluir"></i></button>
                 </div>
                 <div class="col-md-4">
                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#alterar_senha_<?php echo $usuario['id'];?>"><i class="fa fa-repeat" data-toggle="tooltip" data-placement="top" title="Redefinir Senha"></i></button>
                 </div>
                 </div>
                </td>
              </tr>

          <!-- Modal Edição -->      
              <div class="modal fade" id="editar_usuario_<?php echo $usuario['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edição do Usuário(a), <?php echo $usuario['nomeUsuario']; ?></h4>
                      </div>
                      <div class="modal-body">
                        <!-- general form elements -->
                          <!-- Form Edicao -->
                          <form role="form" id="formEditar" action="config/editUsuario.php" method="POST" enctype="multipart/form-data">
                            <!-- ESSE INPUT CAPTURA O ID DO USUARIO -->
                            <input name='id' type='hidden' value="<?php echo $usuario['id']; ?>"/>
                            <!-- INPUT PARA DEFINIR O TAMANHO MAXIMO DE UPLOAD -->
                            <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
                            <div class="box-body">

                            <div class="form-group">
                            <div class="row">
                            <div class="col-md-4 col-xs-4"></div>
                            <div class="col-md-4 col-xs-4">
                            <img src="upload/imagem_perfil/usuario/<?php echo $usuario['arquivo'];?>" width="150" height="150" class="img-circle">
                            <div class="col-md-4 col-xs-4"></div>
                            </div>
                            </div>
                            </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input type="text" name="nome" value="<?php echo $usuario['nomeUsuario'] ?>" class="form-control" id="InputNome" placeholder="Nome" required="" autofocus="">
                              </div>                
                              <div class="form-group">
                                <label for="exampleInputEmail1">Sobrenome</label>
                                <input type="text" name="sobrenome" value="<?php echo $usuario['sobrenome'] ?>" class="form-control" id="InputNome" placeholder="Sobrenome" required="">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">E-mail</label>
                                <input type="email" name="email" value="<?php echo $usuario['email'] ?>" class="form-control" id="exampleInputEmail1" placeholder="exemplo@dominio.com" required="">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">CPF</label>
                                <input type="text" name="cpf"  value="<?php echo $usuario['cpf'] ?>" class="form-control" id="InputNome" placeholder="000.000.000-00" required="">
                              </div>

                              <?php 
                                                  
                              $instituicao = $mysqli->query("SELECT id, tipo, nome FROM instituicao WHERE tipo = 'Centro de Monitoramento' AND status = '1'");               
                              ?> 

                              <div class="form-group">
                               <label>Instituição</label>
                                <select name="instituicao" class="form-control select2" required style="width: 100%;">
                                  <option style="font-weight: bold;" value="<?php echo $usuario['instituicao_id']?>">
                                  <?php echo $usuario['tipo']." - ".$usuario['nomeInstituicao']; ?></option>

                                  <?php foreach ($instituicao as $inst) { ?>
                                  <option value="<?php echo $inst['id'] ?>"><?php echo $inst['tipo']." - ".$inst['nome'] ?></option>
                                  <?php echo $inst['id'];}?>
                                </select>
                               <?php //DB_Close($link); ?>
                              </div>

                              <!-- Escolha do tipo de perfil -->

                              <?php 

                                $adm = "";
                                $adm_inst = "";
                                $consulta = "";
                                $op_documento ="";

                              if ($usuario['perfil'] == "adm") {

                                  $adm = "checked";

                                } if ($usuario['perfil'] == "adm_instituicao") {
                                  
                                  $adm_inst = "checked";

                                } if ($usuario['perfil'] == "op_documento") {
                                  
                                  $op_documento = "checked";

                                }
                                if ($usuario['perfil'] == "consulta") {
                                  
                                  $consulta = "checked";

                                }

                              ?>


                              <div class="ls-label">
                                <p>Selecione o perfil do usuário(a):</p>
                                <label class="ls-label-text">
                                  <input type="radio" name="tp_perfil" value="adm" class="ls-field-radio" <?php echo $adm; ?>>
                                  Adminstrador
                                </label>
                                <label class="ls-label-text">
                                  <input type="radio" name="tp_perfil" value="adm_instituicao" class="ls-field-radio" <?php echo $adm_inst; ?> >
                                 Adm. da Instituição
                                </label>
                                
                                <label class="ls-label-text">
                                  <input type="radio" name="tp_perfil" value="op_documento" class="ls-field-radio" <?php echo $op_documento; ?>>
                                  Oper. de Documento
                                </label>

                                <label class="ls-label-text">
                                  <input type="radio" name="tp_perfil" value="consulta" class="ls-field-radio" <?php echo $consulta; ?>>
                                  Consulta
                                </label>
                              </div>
                              <!-- /Escolha do tipo de perfil -->
                              <hr>
                              <!-- Escolha do status -->
                                <?php 

                                $ativo = "";
                                $inativo = "";

                              if ($usuario['status'] == "1") {

                                  $ativo = "checked";

                                } if ($usuario['status'] == "0") {
                                  
                                  $inativo = "checked";

                                }

                              ?>
                              <div class="ls-label">
                                <p>Selecione o status do usuário(a):</p>
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
              <div class="modal fade bs-example-modal-sm" id="excluir_usuario_<?php echo $usuario['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Exclusão de Usuário(a)</h4>
                  </div>
                  <div class="modal-body"> <!-- box-body -->
                      <!-- Form Excluir -->
                      <form role="form" id="formExcluir" action="config/excluirUsuario.php" method="POST" enctype="multipart/form-data">
                        <div class="box-body">

                                <p>Deseja realmente excluir o usuário(a)?</p> 
                                <h3><?php echo $usuario['nomeUsuario']." ".$usuario['sobrenome'] ?></h3>
                                <input type="hidden" name="ID-USER" value="<?php echo $usuario['id']?>" />
                                <input type="hidden" name="nomeImagem" value="<?php echo $usuario['arquivo']?>" />
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
              <div class="modal fade bs-example-modal-sm" id="alterar_senha_<?php echo $usuario['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Redefinição de senha</h4>
                    </div>
                    <div class="modal-body">
                    <form role="form" id="formExcluir" action="config/altSenhaUsuario.php" method="POST" enctype="multipart/form-data"> <!-- Form alterar senha -->
                      <div class="box-body"> <!-- box-body -->

                        <div class="form-group">
                          <label for="InputPassword">Nova senha</label>
                          <input type="password" name="novaSenha" class="form-control" placeholder="Nova Senha" data-minlength="6" maxlength="10" required>
                        <span class="help-block">Mínimo de seis (6) digitos</span>
                        
                        <input type="hidden" name="ID-USER" value="<?php echo $usuario['id']?>" />
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

              <?php } while ($usuario = $execute ->fetch_assoc()); ?>
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
              <h4 class="modal-title" id="myModalLabel">Cadastro de Usuário</h4>
            </div>
            <div class="modal-body">
              <!-- general form elements -->
                <!-- Form Cadastro -->
                <form role="form" id="formCadastro" action="config/addUsuario.php" method="POST" enctype="multipart/form-data">
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

                    <?php 
                                        
                    require 'config/config.php';
                    require 'config/connection.php';
                    require 'config/database.php';
                    $link = DB_Connect();
                    $instituicao = DB_Read('instituicao', 'id, tipo, nome', "WHERE tipo = 'Centro de Monitoramento' AND status = '1'");                 
              
                    ?> 

                    <div class="form-group">
                     <label>Instituição</label>
                      <select name="instituicao" class="form-control select2" required style="width: 100%;">
                        <option selected="selected">Selecione uma instituição</option>
                        <?php foreach ($instituicao as $inst) { ?>
                        <option value="<?php echo $inst['id'] ?>"><?php echo $inst['tipo']." - ".$inst['nome'] ?></option>
                        <?php echo $inst['id'];}?>
                      </select>
                      <?php DB_Close($link); ?>
                    </div>

                    <div class="form-group">
                      <label for="eInputPassword">Senha</label>
                      <input type="password" name="senha" class="form-control" id="InputPassword" placeholder="Senha" data-minlength="6" maxlength="10" required>
                    <span class="help-block">Mínimo de seis (6) digitos</span>
                    </div>

                    <!-- Escolha do sexo -->
                     <div class="form-group">
                        <div class="ls-label">
                          <p>Selecione o sexo do novo usuário(a):</p>
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
                    <!-- Escolha do tipo de perfil -->
                    <div class="ls-label">
                      <p>Selecione o perfil do usuário(a):</p>
                      <label class="ls-label-text">
                        <input type="radio" name="tp_perfil" value="adm" class="ls-field-radio" checked>
                        Adminstrador
                      </label>
                      <label class="ls-label-text">
                        <input type="radio" name="tp_perfil" value="adm_instituicao" class="ls-field-radio">
                       Adm. da Instituição
                      </label>

                      <label class="ls-label-text">
                        <input type="radio" name="tp_perfil" value="op_documento" class="ls-field-radio">
                        Oper. de Documento
                      </label>
                      
                      <label class="ls-label-text">
                        <input type="radio" name="tp_perfil" value="consulta" class="ls-field-radio">
                        Consulta
                      </label>
                    </div>
                    <!-- /Escolha do tipo de perfil -->
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
              <button type="submit" class="btn btn-primary">Cadastrar usuário</button>
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
        
        echo "<script>setTimeout(function(){ window.location.replace(\"usuarios.php\"); }, 3000);</script>";
      
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



