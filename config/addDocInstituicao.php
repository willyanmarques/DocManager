<?php
    require 'config.php';
    require 'connection.php';
    require 'database.php';

  $dataDocumento = $_POST['dataDocumento'];
  $origem = $_POST['origem'];
  $destinatario = $_POST['destinatario'];
  $tipoDocumento = $_POST['tipoDocumento'];
  $assunto = $_POST['assunto'];
  $id_inst_origem =$_POST['id_inst_origem'];
  $chave = $_POST['chave'];
  $observacoes = $_POST['observacoes'];
  $arquivo = $_FILES['arquivo']; //Capturando o Input File

  date_default_timezone_set('America/Recife'); //Configurando TimeZone
  $NOW = date("Y-m-d H:i:s"); // Configurando Formatacao da Data/Hora 
    
  $diretorio = "../upload/documentos/instituicao/"; //Caminho onde a imagem vai ser salva

  $ImgDocumento = DB_Image($arquivo, $diretorio);

  $docInstituicao  = array('dataDocumento'         => $dataDocumento,
                           'origem'           => $origem,
                           'destinatario'        => $destinatario,
                           'assunto'   => $assunto,
                           'observacao'       => $observacoes,
                           'arquivo'       => $ImgDocumento,
                           'cod_validacao'        => $chave,
                           'tipo_documento_id'      => $tipoDocumento,
                           'instituicao_id'      => $id_inst_origem,
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