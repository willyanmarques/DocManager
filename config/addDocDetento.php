<?php
    require 'config.php';
    require 'connection.php';
    require 'database.php';

  $dataDocumento = $_POST['dataDocumento'];
  $origem = $_POST['origem'];
  $destinatario = $_POST['destinatario'];
  $tipoDocumento = $_POST['tipoDocumento'];
  $id_detento = $_POST['detento'];
  $id_inst_detento = $_POST['id_inst_detento'];
  $assunto = $_POST['assunto'];
  $chave = $_POST['chave'];
  $observacoes = $_POST['observacoes'];
  $arquivo = $_FILES['arquivo']; //Capturando o Input File

  date_default_timezone_set('America/Recife'); //Configurando TimeZone
  $NOW = date("Y-m-d H:i:s"); // Configurando Formatacao da Data/Hora 
    
  $diretorio = "../upload/documentos/detento/"; //Caminho onde a imagem vai ser salva
  
  //$dataDoc = date('Y-m-d', strtotime($dataDocumento));
  $dataDoc = DateTime::createFromFormat('d/m/Y', $dataDocumento) ->format('Y-m-d');

  $ImgDocumento = DB_Image($arquivo, $diretorio);

  $docDetento  = array('dataDocumento'         => $dataDoc,
                       'origem'         => $origem,
                       'destinatario'        => $destinatario,
                       'assunto'   => $assunto,
                       'observacao'       => $observacoes,
                       'arquivo'       => $ImgDocumento,
                       'cod_validacao'        => $chave,
                       'tipo_documento_id'      => $tipoDocumento,
                       'instituicao_id'      => $id_inst_detento,
                       'detento_id'      => $id_detento,
                       'arquivo'     => $ImgDocumento,
                       'dataCadastro'=> $NOW);
            

  $grava = DB_Create('documento_detento', $docDetento);
  
   if($grava) {
  
    echo "<form action=\"../novoDocumentoDet.php\" method='POST' name='formNotificacao'>

    <input type='hidden' name='validaNotificacao' value='sucesso'/>
    
    <script type'text\javascript'> document.formNotificacao.submit(); </script>
    
      </form>";
    
echo "<script>window.location.replace(\"../novoDocumentoDet.php\")</script>";


   }
  else {
    
  echo "<form action=\"../novoDocumentoDet.php\" method='POST' name='formNotificacao'>

    <input type='hidden' name='validaNotificacao' value='erro'/>
    
    <script type'text\javascript'> document.formNotificacao.submit(); </script>
    
      </form>";
    
echo "<script>window.location.replace(\"../novoDocumentoDet.php\")</script>";

  
  }
  

  ?>