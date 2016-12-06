<?php require'head.php'; 
      include'config/conexao.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Vínculo Advogado/Detento<small></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Conteudo -->
      <div class="row"> <!-- ROW -->
      <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading"><b>Painel de criação de vínculo</b></div>
          <div class="panel-body">
            <form action="config/vincularAD.php" method="POST"> <!-- FORM -->
              <div class="col-md-5"> <!-- ADVOGADOS CADASTRADOS -->
                  <?php $advogado = $mysqli->query("SELECT id, oab, nome, sobrenome FROM advogado ORDER BY nome"); ?>
                    <div class="form-group">
                      <select name="advogado" class="form-control select2" style="width: 100%;">
                        <option>Selecione um Advogado</option>
                        <?php foreach ($advogado as $adv) { ?>
                        <option value="<?php echo $adv['id']; ?>"><?php echo $adv['oab']." - ".$adv['nome']." ". $adv['sobrenome'] ?></option>
                         <?php } ?>
                      </select>
                    </div>                  
              </div> <!-- /ADVOGADOS CADASTRADOS -->

              <div class="col-md-5"> <!-- DETENTOS CADASTRADOS -->
                  <?php $detento = $mysqli->query("SELECT id, prontuario, nome FROM detento ORDER BY nome"); ?>
                    <div class="form-group">
                      <select name="detento" class="form-control select2" style="width: 100%;">
                      <option>Selecione um Detento</option>
                        <?php foreach ($detento as $det) { ?>
                        <option value="<?php echo $det['id']; ?>"><?php echo $det['prontuario']." - ".$det['nome'];?></option>
                         <?php } ?>
                      </select>
                    </div>                  
              </div> <!-- /DETENTOS CADASTRADOS -->

          <div class="col-md-2">
          <input type="submit" class="btn btn-block btn-flat btn-success" value="Vincular">
          </div>
          </form>
          </div>
          </div>
          </div>
      </div> <!-- /ROW -->

      <div class="row"> <!-- ROW -->
        
        <div class="col-md-12"> <!-- DETENTOS CADASTRADOS -->
        <div class="panel panel-default"> <!-- PAINEL -->
        <div class="panel-heading"><b>Vínculos Realizados</b></div> <!-- CABECALHO DO PAINEL -->
        <div class="panel-body"> <!-- CONTEUDO PAINEL -->
          <table id="example1" class="table table-bordered table-hover table-condensed">
            <thead>
              <tr style="font-weight: bold;">
                <td>OAB</td>
                <td>Nome do Advogado(a)</td>
                <td style="text-align: center;">Vínculo</td>
                <td>Prontuário</td>
                <td>Nome do Detento(a)</td>
                <td style="text-align: center;">Remover vínculo</td>
              </tr>
            </thead>
            <tbody>
        <?php $vinculo = $mysqli->query("SELECT a.id as id_advogado, a.oab, a.nome as nome_advogado, a.sobrenome as sobrenome_advogado, d.id as id_detento, d.prontuario, d.nome as nome_detento FROM advogado a 
                                         JOIN advogado_detento AD ON AD.advogado_id = a.id
                                         JOIN detento d ON d.id = AD.detento_id ORDER BY nome_advogado"); ?>
            <?php foreach ($vinculo as $vin) { ?>
            <tr>
              <td><?php echo $vin['oab']; ?></td>
              <td><?php echo $vin['nome_advogado']." ".$vin['sobrenome_advogado']; ?></td>
              <td style="text-align: center;"><i class="fa fa-link" aria-hidden="true"></i></td>
              <td><?php echo $vin['prontuario']; ?></td>
              <td><?php echo $vin['nome_detento']; ?></td>
              <td style="text-align: center;"><button type="button" class="btn btn-block btn-flat btn-danger" data-toggle="modal" data-target="#excluir_vinculo_<?php echo $vin['id_advogado'].$vin['id_detento']; ?>">Remover</button></td>
            </tr>
    <!-- Modal Desvincular -->
            <div class="modal fade bs-example-modal-sm" id="excluir_vinculo_<?php echo $vin['id_advogado'].$vin['id_detento']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Remoção de vínculo</h4>
                  </div>
                  <div class="modal-body"> <!-- box-body -->
                      <!-- Form Desvincular -->
                      <form role="form" id="formExcluir" action="config/desvincularAD.php" method="POST" enctype="multipart/form-data">
                        <div class="box-body">

                                <p>Deseja realmente desvincular o Advogado(a):</p> 
                                <h4><?php echo $vin['nome_advogado']." ".$vin['sobrenome_advogado']; ?></h4>
                                <p>do Detento(a):</p>
                                <h4><?php echo $vin['nome_detento']; ?> 
                                <input type="hidden" name="id_advogado" value="<?php echo $vin['id_advogado']?>" />
                                <input type="hidden" name="id_detento" value="<?php echo $vin['id_detento']?>" />
                          </div>
                        <!-- /.box-body -->
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Excluir</button>
                  </div>
                  </form>
                  <!-- /Form Desvincular -->
                </div>
              </div>
              </div>
    <!-- /Modal Desvincular --> 
            <?php }?> 
            </tbody>
            </table>
        </div> <!-- /CONTEUDO PAINEL -->
      </div> <!-- /PAINEL --> 
      </div> <!-- /DETENTOS CADASTRADOS -->
      </div> <!-- /ROW -->
      <!-- /Conteudo -->

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
                  allow_dismiss: true,
                  showProgressbar: false,
                  placement: {
                  from: 'top',
                  align: 'center',
                }

                });
            </script>";
        
        unset($_POST['validaNotificacao']);
        
        echo "<script>setTimeout(function(){ window.location.replace(\"vinDetento.php\"); }, 3000);</script>";
      
    } if ($var == 'erro'){
      
        echo "<script>
                  $.notify('<strong>Erro ao Realizar Operação!</strong>', {
                  type: 'danger',
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