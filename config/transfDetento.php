<?php
require 'config.php';
require 'connection.php';
require 'database.php';
  
  $id = $_POST['ID-DETENTO'];
  $novaInstituicao = $_POST['instituicao'];

  $detento  = array( 'instituicao_id'     => $novaInstituicao);


$update = DB_Update('detento', $detento, 'id =' . "$id");
  
 if($update) {
	
  	echo "<form action=\"../detentos.php\" method='POST' name='formNotificacao'>

		<input type='hidden' name='validaNotificacao' value='sucesso'/>
		
		<script type'text\javascript'> document.formNotificacao.submit(); </script>
		
      </form>";
	  
echo "<script>window.location.replace(\"../detentos.php\")</script>";

 }              
		
 else 
		echo "<form action=\"../detentos.php\" method='POST' name='formNotificacao'>

		<input type='hidden' name='validaNotificacao' value='erro'/>
		
		<script type'text\javascript'> document.formNotificacao.submit(); </script>
		
      </form>";
	  
echo "<script>window.location.replace(\"../detentos.php\")</script>";

?>