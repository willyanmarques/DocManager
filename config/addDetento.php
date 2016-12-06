<?php
	  require 'config.php';
	  require 'connection.php';
    require 'database.php';

  $prontuario = $_POST['prontuario'];
  $nome = $_POST['nome'];
  $nome_mae = $_POST['nome_mae'];
  $unidade_prisional = $_POST['instituicao'];
  $regime = $_POST['regime'];
  $sexo = $_POST['sexo'];
  $status = $_POST['status'];


  date_default_timezone_set('America/Recife'); //Configurando TimeZone
  $NOW = date("Y-m-d H:i:s"); // Configurando Formatacao da Data/Hora 

  $detento  = array( 'prontuario'      => $prontuario,
                     'nome'           => $nome,
          				   'nome_mae'       => $nome_mae,
          				   'sexo'           => $sexo,
          				   'regime'         => $regime,
                     'instituicao_id' => $unidade_prisional,
          				   'status' => $status,
          				   'dataCadastro'   => $NOW);
  					

  $grava = DB_Create('detento', $detento);
	
   if($grava) {
  
    echo "<form action=\"../detentos.php\" method='POST' name='formNotificacao'>

    <input type='hidden' name='validaNotificacao' value='sucesso'/>
    
    <script type'text\javascript'> document.formNotificacao.submit(); </script>
    
      </form>";
    
echo "<script>window.location.replace(\"../detentos.php\")</script>";


   }
  else {
    
  echo "<form action=\"../detentos.php\" method='POST' name='formNotificacao'>

    <input type='hidden' name='validaNotificacao' value='erro'/>
    
    <script type'text\javascript'> document.formNotificacao.submit(); </script>
    
      </form>";
    
echo "<script>window.location.replace(\"../detentos.php\")</script>";

  
  }
  

  ?>