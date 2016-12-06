<?php
	  require 'config.php';
	  require 'connection.php';
    require 'database.php';

  $nome = $_POST['nome'];
  $cpf = $_POST['cpf'];
  $sobrenome = $_POST['sobrenome'];
  $email = $_POST['email'];
  $instituicao = $_POST['instituicao'];
  $senha = $_POST['senha'];
  $sexo = $_POST['sexo'];
  $perfil = $_POST['tp_perfil'];
  $status = $_POST['status'];
  $arquivo = $_FILES['arquivo'];


date_default_timezone_set('America/Recife'); //Configurando TimeZone
$NOW = date("Y-m-d H:i:s"); // Configurando Formatacao da Data/Hora 
  
$diretorio = "../upload/imagem_perfil/usuario/"; //Caminho onde a imagem vai ser salva

$imagemPerfil = DB_Image($arquivo, $diretorio);

$usuario  = array('nome'         => $nome,
      				   'cpf'        => $cpf,
      				   'sobrenome'   => $sobrenome,
      				   'email'       => $email,
      				   'instituicao_id'       => $instituicao,
      				   'senha'        => $senha,
      				   'sexo'      => $sexo,
      				   'perfil' => $perfil,
      				   'status' => $status,
      				   'arquivo'     => $imagemPerfil,
      				   'dataCadastro'=> $NOW);
					

$grava = DB_Create('usuario', $usuario);
  
   if($grava) {
  
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
  

  ?>