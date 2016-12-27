<?php
require 'config.php';
require 'connection.php';
require 'database.php';
  
  $id_documento = $_POST['id_documento'];
  $assunto = $_POST['assunto'];
  $tipoDocumento = $_POST['tipoDocumento'];
  $dataResposta = $_POST['dataResposta'];
  $dataDocumento = $_POST['dataDocumento'];
  echo $origem = $_POST['origem'];
  $observacao = $_POST['observacao'];
  $status = $_POST['status'];

  date_default_timezone_set('America/Recife'); //Configurando TimeZone
  $dataDoc = DateTime::createFromFormat('d/m/Y', $dataDocumento) ->format('Y-m-d');
  $dataDocResp = DateTime::createFromFormat('d/m/Y', $dataResposta) ->format('Y-m-d');

  $docInst = array( 'dataDocumento'     => $dataDoc,
                   'dataResposta'           => $dataDocResp,
      				  	 'assunto'       => $assunto,
      				  	 'observacao'         => $observacao,
                   'status'         => $status,
                   'tipo_documento_id'         => $tipoDocumento,
      				  	 'instituicao_origem_id'         => $origem);


$update = DB_Update('documento_instituicao', $docInst, 'id =' . "$id_documento");
  
 if($update) {
	
  	echo "<form action=\"../srcDocumentoInst.php\" method='POST' name='formNotificacao'>

		<input type='hidden' name='validaNotificacao' value='sucesso'/>
		
		<script type'text\javascript'> document.formNotificacao.submit(); </script>
		
      </form>";
	  
echo "<script>window.location.replace(\"../srcDocumentoInst.php\")</script>";

 }              
		
 else 
		echo "<form action=\"../srcDocumentoInst.php\" method='POST' name='formNotificacao'>

		<input type='hidden' name='validaNotificacao' value='erro'/>
		
		<script type'text\javascript'> document.formNotificacao.submit(); </script>
		
      </form>";
	  
echo "<script>window.location.replace(\"../srcDocumentoInst.php\")</script>";

?>