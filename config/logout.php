<?php 

session_start();  
session_destroy();
unset(

	$_SESSION['id'],			 
	$_SESSION['nome'] ,				
	$_SESSION['sobrenome']	 	,	
	$_SESSION['arquivo']	,      
	$_SESSION['perfil'],      		
	$_SESSION['email'] ,				
	$_SESSION['instituicao_id']
);    
$_SESSION['logindeslogado'] = "Deslogado com sucesso";
//redirecionar o usuario para a página de login
header("Location: ../index.php");


?>