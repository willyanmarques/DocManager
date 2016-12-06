<?php
require 'config.php';
require 'connection.php';
require 'database.php';
  
  $id = $_POST['id'];
  $oab = $_POST['oab'];
  $cpf = $_POST['cpf'];
  $nome = $_POST['nome'];
  $sobrenome = $_POST['sobrenome'];
  $email = $_POST['email'];
  $status = $_POST['status'];
  $arquivo = $_FILES['arquivo'];
  

  
  if(empty($_FILES['arquivo']['name'])) {
	
  $imgAtual = DB_Read('advogado', 'arquivo', 'WHERE id =' . "$id");
	
  foreach ($imgAtual as $img) {
		
		$img['arquivo']; 
		
		}

 $advogado  = array('oab'         => $oab,
  				   'cpf'         => $cpf,
  				   'nome'        => $nome,
  				   'sobrenome'   => $sobrenome,
  				   'email'       => $email,
  				   'status'      => $status,
  				   'arquivo'     => $img['arquivo']
  				   );



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

 
  }
  
  else {
  	
	$imgAtual = DB_Read('advogado', 'arquivo', 'WHERE id =' . "$id");
	
	foreach ($imgAtual as $img) {
		
	$img['arquivo']; 
		
	@unlink("../upload/imagem_perfil/advogado/".$img['arquivo']);
		
		}
	
$diretorio = "../upload/imagem_perfil/advogado/"; 

$imagemPerfil = DB_Image($arquivo, $diretorio);

$advogado  = array('oab'         => $oab,
  				   'cpf'         => $cpf,
  				   'nome'        => $nome,
  				   'sobrenome'   => $sobrenome,
  				   'email'       => $email,
  				   'status'      => $status,
  				   'arquivo'     => $imagemPerfil
  				   );



$update = DB_Update('advogado', $advogado, 'id =' . "$id");
	
 if($update) {
 	
	echo "<form action=\"../advogados.php\" method='POST' name='formNotificacao'>

		<input type='hidden' name='validaNotificacao' value='sucesso'/>
		
		<script type'text\javascript'> document.formNotificacao.submit(); </script>
		
      </form>";
	  
echo "<script>window.location.replace(\"../advogados.php\")</script>";

   
 }
		
 else {
	
	echo "<form action=\"../advogados.php\" method='POST' name='formNotificacao'>

		<input type='hidden' name='validaNotificacao' value='erro'/>
		
		<script type'text\javascript'> document.formNotificacao.submit(); </script>
		
      </form>";
	  
echo "<script>window.location.replace(\"../advogados.php\")</script>";
	
 
	
 }
  
  }

?>