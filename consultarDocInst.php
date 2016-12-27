<?php require'head.php';
    include'config/conexao.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Consulta de Documentos<small></small></h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Conteudo aqui -->

    <div class="row"> <!-- ROW -->
      <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading"><b>Definição de consulta</b></div>
          <div class="panel-body">
            <form action="srcDocumentoInst.php" method="POST"> <!-- FORM -->


              <div class="col-md-6"> <!-- TIPO DE DOCUMENTOS CADASTRADOS -->
              <label>Tipo do documento:</label>
              <?php $TipoDoc = $mysqli->query("SELECT * FROM tipo_documento ORDER BY descricao"); ?>
                <div class="form-group">
                  <select name="tipoDocumento" class="form-control" style="width: 100%;">
                  <option value="">Qual tipo de documento deseja pesquisar?</option>
                    <?php foreach ($TipoDoc as $doc) { ?>
                    <option value="<?php echo $doc['id']; ?>"><?php echo $doc['descricao'];?></option>
                     <?php } ?>
              </select>
              </div>                  
              </div> <!-- /TIPO DE DOCUMENTOS CADASTRADOS -->

              <div class="col-md-6"> <!-- DETENTOS CADASTRADOS -->
              <label>Remetente:</label>
                  <?php $remetente = $mysqli->query("SELECT id, nome, sobrenome FROM usuario WHERE status = 1 ORDER BY nome"); ?>
                    <div class="form-group">
                      <select name="nomeRemetente" class="form-control select2" style="width: 100%;" required="required">
                      <option value="">Selecione um Remetente</option>
                        <?php foreach ($remetente as $rem) { ?>
                        <option value="<?php echo $rem['nome']." ".$rem['sobrenome']; ?>"><?php echo $rem['nome']." ".$rem['sobrenome'];?></option>
                         <?php } ?>
                      </select>
                    </div>                  
              </div> <!-- /DETENTOS CADASTRADOS -->

              <div class="col-md-6">
              <label>Assunto:</label>
                <input type="text" class="form-control" name="assunto" placeholder="Assunto do documento">
              </div>


             <!-- <div class="col-md-2">
                <label>Data de resposta:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="dataResposta" placeholder="dd/mm/aaaa" class="form-control pull-right" autocomplete="on">
                </div>
              </div> -->

              <div class="col-md-2">
                <label>de:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="dataDe" placeholder="dd/mm/aaaa" class="form-control pull-right data" autocomplete="on" required >
                </div>
              </div>

              <div class="col-md-2">
                <label>até:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="dataAte" placeholder="dd/mm/aaaa" class="form-control pull-right data" autocomplete="on"  required >
                </div>
              </div>

              <div class="col-md-2">
              <label>&nbsp;</label>
                  <button type="submit" class="btn btn-block btn-default" data-toggle="tooltip" data-placement="top" title="Consultar" data-toggle="modal"><i class="fa fa-search"></i></button> 
              </div>
              </div>

          <!--<div class="col-md-2">
          <input type="submit" class="btn btn-block btn-flat btn-primary" value="Consultar">
          </div> -->
          </form>
          </div>
          </div>
      </div> <!-- /ROW -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- IMPORTANDO MASCARA -->
<?php require 'dist/js/mascaras.html' ?>
<?php require 'footer.php'; ?>