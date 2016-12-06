<?php
require 'config.php';
require 'connection.php';
require 'database.php';
  
  $id = $_POST['id'];
  $prontuario = $_POST['prontuario'];
  $nome = $_POST['nome'];
  $nome_mae = $_POST['nome_mae'];
  $regime = $_POST['regime'];
  $status = $_POST['status'];
  


  $detento  = array( 'prontuario'     => $prontuario,
                     'nome'           => $nome,
  				  	 'nome_mae'       => $nome_mae,
  				  	 'regime'         => $regime,
  				  	 'status'         => $status);


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