<?php
require 'config.php';
require 'connection.php';
require 'database.php';
  
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $cpf = $_POST['cpf'];
  $sobrenome = $_POST['sobrenome'];
  $email = $_POST['email'];
  $instituicao = $_POST['instituicao'];
  $perfil = $_POST['tp_perfil'];
  $status = $_POST['status'];
  $arquivo = $_FILES['arquivo'];
  

  
  if(empty($_FILES['arquivo']['name'])) {
	
  $imgAtual = DB_Read('usuario', 'arquivo', 'WHERE id =' . "$id");
	
  foreach ($imgAtual as $img) {
		
		$img['arquivo']; 
		
		}

 $usuario  = array('nome'         => $nome,
  				   'cpf'        => $cpf,
  				   'sobrenome'   => $sobrenome,
  				   'email'       => $email,
  				   'instituicao_id' => $instituicao,
  				   'perfil' => $perfil,
  				   'status' => $status,
  				   'arquivo' => $img['arquivo']
  				   );



$update = DB_Update('usuario', $usuario, 'id =' . "$id");
  
 if($update) {
	
  	echo "<form action=\"../usuarios.php\" method='POST' name='formNotificacao'>

		<input type='hidden' name='validaNotificacao' value='sucesso'/>
		
		<script type'text\javascript'> document.formNotificacao.submit(); </script>
		
      </form>";
	  
echo "<script>window.location.replace(\"../usuarios.php\")</script>";

 }              
		
 else 
		echo "<form action=\"../usuarios.php\" method='POST' name='formNotificacao'>

		<input type='hidden' name='validaNotificacao' value='erro'/>
		
		<script type'text\javascript'> document.formNotificacao.submit(); </script>
		
      </form>";
	  
echo "<script>window.location.replace(\"../usuarios.php\")</script>";

 
  }
  
  else {
  	
	$imgAtual = DB_Read('usuario', 'arquivo', 'WHERE id =' . "$id");
	
	foreach ($imgAtual as $img) {
		
	$img['arquivo']; 
		
	@unlink("../upload/imagem_perfil/usuario/".$img['arquivo']);
		
		}
	
$diretorio = "../upload/imagem_perfil/usuario/"; 

$imagemPerfil = DB_Image($arquivo, $diretorio);

$usuario  = array('nome'         => $nome,
  				   'cpf'        => $cpf,
  				   'sobrenome'   => $sobrenome,
  				   'email'       => $email,
  				   'instituicao_id' => $instituicao,
  				   'perfil' => $perfil,
  				   'status' => $status,
  				   'arquivo' => $imagemPerfil
  				   );



$update = DB_Update('usuario', $usuario, 'id =' . "$id");
	
 if($update) {
 	
	echo "<form action=\"../usuarios.php\" method='POST' name='formNotificacao'>

		<input type='hidden' name='validaNotificacao' value='sucesso'/>
		
		<script type'text\javascript'> document.formNotificacao.submit(); </script>
		
      </form>";
	  
echo "<script>window.location.replace(\"../usuarios.php\")</script>";

   
 }
		
 else {
	
	echo "<form action=\"../usuarios.php\" method='POST' name='formNotificacao'>

		<input type='hidden' name='validaNotificacao' value='erro'/>
		
		<script type'text\javascript'> document.formNotificacao.submit(); </script>
		
      </form>";
	  
echo "<script>window.location.replace(\"../usuarios.php\")</script>";
	
 
	
 }
  
  }

?>