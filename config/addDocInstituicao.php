<?php
    require 'config.php';
    require 'connection.php';
    require 'database.php';

  $nomeRemetente = $_POST['nomeRemetente'];
  $emailRemetente = $_POST['emailRemetente'];
  $instRemetente = $_POST['instRemetente'];
  $dataDocumento = $_POST['dataDocumento'];
  $dataResposta = $_POST['dataResposta'];
  $origem = $_POST['origem'];
  $tipoDocumento = $_POST['tipoDocumento'];
  $assunto = $_POST['assunto'];
  $chave = $_POST['chave'];
  $observacoes = $_POST['observacoes'];
  $arquivo = $_FILES['arquivo']; //Capturando o Input File

  date_default_timezone_set('America/Recife'); //Configurando TimeZone
  $NOW = date("Y-m-d H:i:s"); // Configurando Formatacao da Data/Hora 
    
  $diretorio = "../upload/documentos/instituicao/"; //Caminho onde a imagem vai ser salva

    $dataDoc = date('Y-m-d', strtotime($dataDocumento));
    $dataDocResp = date('Y-m-d', strtotime($dataResposta));


  $ImgDocumento = DB_Image($arquivo, $diretorio);

  $docInstituicao  = array('nomeRemetente' => $nomeRemetente,
                           'emailRemetente'           => $emailRemetente,
                           'instRemetente'           => $instRemetente,
                           'dataDocumento'         => $dataDoc,
                           'dataResposta'         => $dataDocResp,
                           'assunto'   => $assunto,
                           'observacao'       => $observacoes,
                           'arquivo'       => $ImgDocumento,
                           'cod_validacao'        => $chave,
                           'tipo_documento_id'      => $tipoDocumento,
                           'instituicao_origem_id'      => $origem,
                           'dataCadastro'=> $NOW);
            

  $grava = DB_Create('documento_instituicao', $docInstituicao);
  
   if($grava) {
  
    echo "<form action=\"../novoDocumentoInst.php\" method='POST' name='formNotificacao'>

    <input type='hidden' name='validaNotificacao' value='sucesso'/>
    
    <script type'text\javascript'> document.formNotificacao.submit(); </script>
    
      </form>";
    
echo "<script>window.location.replace(\"../novoDocumentoInst.php\")</script>";


   }
  else {
    
  echo "<form action=\"../novoDocumentoInst.php\" method='POST' name='formNotificacao'>

    <input type='hidden' name='validaNotificacao' value='erro'/>
    
    <script type'text\javascript'> document.formNotificacao.submit(); </script>
    
      </form>";
    
echo "<script>window.location.replace(\"../novoDocumentoInst.php\")</script>";

  
  }
  

  ?>