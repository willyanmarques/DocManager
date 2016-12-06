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
            <form action="srcDocumento.php" method="POST"> <!-- FORM -->


              <div class="col-md-3"> <!-- TIPO DE DOCUMENTOS CADASTRADOS -->
              <label>Tipo do documento:</label>
              <?php $TipoDoc = $mysqli->query("SELECT * FROM tipo_documento ORDER BY descricao"); ?>
                <div class="form-group">
                  <select name="tipoDocumento" class="form-control" style="width: 100%;">
                  <option value="">Do que se trata?</option>
                    <?php foreach ($TipoDoc as $doc) { ?>
                    <option value="<?php echo $doc['id']; ?>"><?php echo $doc['descricao'];?></option>
                     <?php } ?>
              </select>
              </div>                  
              </div> <!-- /TIPO DE DOCUMENTOS CADASTRADOS -->

              <div class="col-md-4"> <!-- DETENTOS CADASTRADOS -->
              <label>Detento:</label>
                  <?php $detento = $mysqli->query("SELECT id, prontuario, nome FROM detento ORDER BY nome"); ?>
                    <div class="form-group">
                      <select name="detento" class="form-control select2" style="width: 100%;">
                      <option value="">Selecione um Detento</option>
                        <?php foreach ($detento as $det) { ?>
                        <option value="<?php echo $det['id']; ?>"><?php echo $det['prontuario']." - ".$det['nome'];?></option>
                         <?php } ?>
                      </select>
                    </div>                  
              </div> <!-- /DETENTOS CADASTRADOS -->

              <div class="col-md-5"> <!-- INSTITUICOES CADASTRADAS -->
              <label>Instituição:</label>
              <?php $instituicao = $mysqli->query("SELECT id, tipo, nome FROM instituicao ORDER BY tipo"); ?>
                <div class="form-group">
                  <select name="instituicao" class="form-control select2" style="width: 100%;">
                  <option>Selecione a instituição</option>
                    <?php foreach ($instituicao as $inst) { ?>
                    <option value="<?php echo $inst['id']; ?>"><?php echo $inst['tipo']." - ".$inst['nome'];?></option>
                     <?php } ?>
                </select>
              </div>                  
              </div> <!-- /INSTITUICOES CADASTRADAS -->

       
      <!-- INSTITUICOES DE ORIGEM -->
            <div class="col-md-5"> 
              <label>Origem:</label>
              <?php $instituicao = $mysqli->query("SELECT id, tipo, nome, cidade, uf FROM instituicao ORDER BY tipo"); ?>
                <div class="form-group">
                  <select name="origem" class="form-control select2" style="width: 100%;">
                  <option selected>Selecione a instituição de origem do documento</option>
                    <?php foreach ($instituicao as $inst) { ?>
                    <option value="<?php echo $inst['id']; ?>"><?php echo $inst['tipo']." - ".$inst['nome']." (".$inst['cidade']."/".$inst['uf'].")";?></option>
                     <?php } ?>
                </select>
              </div>                  
              </div> <!-- /INSTITUICOES DE ORIGEM -->

              <div class="col-md-2">
              <label>Assunto:</label>
                <input type="text" class="form-control" name="assunto" placeholder="Assunto do documento" autocomplete="off">
              </div>

              <!-- <div class="col-md-3">
              <div class="form-group">
                <label>Período:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="periodo" class="form-control pull-right" id="reservation">
                </div>
              </div>
              </div> -->

              <div class="col-md-2">
                <label>de:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="dataDe" placeholder="dd/mm/aaaa" class="form-control pull-right" id="dataDe" autocomplete="off" required >
                </div>
              </div>

              <div class="col-md-2">
                <label>até:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="dataAte" placeholder="dd/mm/aaaa" class="form-control pull-right" id="dataAte" autocomplete="off" required >
                </div>
              </div>

              <div class="col-md-1">
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
          </div>
      </div> <!-- /ROW -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- IMPORTANDO MASCARA -->
<?php require 'dist/js/mascaras.html' ?>
<?php require 'footer.php'; ?>