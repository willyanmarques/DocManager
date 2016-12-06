<?php
	  require 'config.php';
	  require 'connection.php';
    require 'database.php';

  $oab = $_POST['oab'];
  $cpf = $_POST['cpf'];
  $nome = $_POST['nome'];
  $sobrenome = $_POST['sobrenome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $sexo = $_POST['sexo'];
  $status = $_POST['status'];
  $arquivo = $_FILES['arquivo']; //Capturando o Input File

date_default_timezone_set('America/Recife'); //Configurando TimeZone
$NOW = date("Y-m-d H:i:s"); // Configurando Formatacao da Data/Hora 
  
$diretorio = "../upload/imagem_perfil/advogado/"; //Caminho onde a imagem vai ser salva

$imagemPerfil = DB_Image($arquivo, $diretorio);

$advogado  = array('oab'         => $oab,
                   'cpf'         => $cpf,
        				   'nome'        => $nome,
        				   'sobrenome'   => $sobrenome,
        				   'email'       => $email,
        				   'senha'       => $senha,
        				   'sexo'        => $sexo,
        				   'status'      => $status,
        				   'arquivo'     => $imagemPerfil,
        				   'dataCadastro'=> $NOW);
					

$grava = DB_Create('advogado', $advogado);
	
   if($grava) {
  
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
  

  ?>