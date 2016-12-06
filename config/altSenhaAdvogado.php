<?php
require 'config.php';
require 'connection.php';
require 'database.php';
 
$id = $_POST['ID-USER'];
$novaSenha = $_POST['novaSenha']; 
  
  
$advogado  = array('senha' => $novaSenha  );



$update = DB_Update('advogado', $advogado, 'id =' . "$id");
  
 if($update) {
	
echo "<form action=\"../advogados.php\" method='POST' name='formNotificacao'>

		<input type='hidden' name='validaNotificacao' value='sucesso'/>
		
		<script type'text\javascript'> document.formNotificacao.submit(); </script>
		
      </form>";
	  

echo "<script>window.location.replace(\"../advogados.php\")</script>";
    
 }              
		
 else 
		echo "<form action=\"../advogados.php\" method='POST' name='formNotificacao'>

		<input type='hidden' name='validaNotificacao' value='erro'/>
		
		<script type'text\javascript'> document.formNotificacao.submit(); </script>
		
     		 </form>";
	  
        echo "<script>window.location.replace(\"../advogados.php\")</script>";
 
  
 
 
 
 ?>