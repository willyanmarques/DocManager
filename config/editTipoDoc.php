<?php
require 'config.php';
require 'connection.php';
require 'database.php';
  
  $id = $_POST['id_tipoDoc'];
  $descricao = $_POST['descricao'];


  $TipoDoc  = array( 'id' => $id, 'descricao' => $descricao);


$update = DB_Update('tipo_documento', $TipoDoc, 'id =' . "$id");
  
 if($update) {
	
  	echo "<form action=\"../tiposDocumento.php\" method='POST' name='formNotificacao'>

		<input type='hidden' name='validaNotificacao' value='sucesso'/>
		
		<script type'text\javascript'> document.formNotificacao.submit(); </script>
		
      </form>";
	  
echo "<script>window.location.replace(\"../tiposDocumento.php\")</script>";

 }              
		
 else 
		echo "<form action=\"../tiposDocumento.php\" method='POST' name='formNotificacao'>

		<input type='hidden' name='validaNotificacao' value='erro'/>
		
		<script type'text\javascript'> document.formNotificacao.submit(); </script>
		
      </form>";
	  
echo "<script>window.location.replace(\"../tiposDocumento.php\")</script>";

?>