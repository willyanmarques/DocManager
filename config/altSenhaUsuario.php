<?php
require 'config.php';
require 'connection.php';
require 'database.php';
 
 $id = $_POST['ID-USER'];
$novaSenha = $_POST['novaSenha']; 
  
  
$usuario  = array('senha' => $novaSenha  );



$update = DB_Update('usuario', $usuario, 'id =' . "$id");
  
 if($update) {
	
  	//echo "<script>alert(\"Senha redefinida com sucesso!\")</script>";
    //echo "<script>window.location = \"../usuarios.php\"</script>";
    
//echo "<script type='text/javascript'>  $.growl.notice({ message: 'The kitten is cute!' }); </script>";
echo "<form action=\"../usuarios.php\" method='POST' name='formNotificacao'>

		<input type='hidden' name='validaNotificacao' value='sucesso'/>
		
		<script type'text\javascript'> document.formNotificacao.submit(); </script>
		
      </form>";
	  
//echo "<script type'text\javascript'> document.formNotificacao.submit(); </script>";

echo "<script>window.location.replace(\"../usuarios.php\")</script>";

//require 'noty.html?sucesso=TRUE';
//echo "<script>window.location = \"../usuarios.php\"</script>";
    
 }              
		
 else 
		//echo "<script>alert(\"Erro ao redefinir a senha!\")</script>";
		echo "<form action=\"../usuarios.php\" method='POST' name='formNotificacao'>

		<input type='hidden' name='validaNotificacao' value='erro'/>
		
		<script type'text\javascript'> document.formNotificacao.submit(); </script>
		
     		 </form>";
	  
        echo "<script>window.location.replace(\"../usuarios.php\")</script>";
 
  
 
 
 
 ?>