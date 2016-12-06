<?php
	  require 'config.php';
	  require 'connection.php';
    require 'database.php';

    $tipo = $_POST['tipo'];
    $nome = $_POST['nome'];
    $sigla = $_POST['sigla'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];
    $status = $_POST['status'];


  date_default_timezone_set('America/Recife'); //Configurando TimeZone
  $NOW = date("Y-m-d H:i:s"); // Configurando Formatacao da Data/Hora 

  $instituicao  = array( 'tipo'     => $tipo,
                         'nome'           => $nome,
                         'sigla'       => $sigla,
                         'email' => $email,
                         'cep' => $cep,
                         'endereco' => $endereco,
                         'bairro'         => $bairro,
                         'cidade' => $cidade,
                         'uf' => $uf,
                         'status' => $status,
                         'dataCadastro' => $NOW);
  					

  $grava = DB_Create('instituicao', $instituicao);
	
   if($grava) {
  
    echo "<form action=\"../instituicoes.php\" method='POST' name='formNotificacao'>

    <input type='hidden' name='validaNotificacao' value='sucesso'/>
    
    <script type'text\javascript'> document.formNotificacao.submit(); </script>
    
      </form>";
    
echo "<script>window.location.replace(\"../instituicoes.php\")</script>";


   }
  else {
    
  echo "<form action=\"../instituicoes.php\" method='POST' name='formNotificacao'>

    <input type='hidden' name='validaNotificacao' value='erro'/>
    
    <script type'text\javascript'> document.formNotificacao.submit(); </script>
    
      </form>";
    
echo "<script>window.location.replace(\"../instituicoes.php\")</script>";

  
  }
  

  ?>