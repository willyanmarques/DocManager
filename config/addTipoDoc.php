<?php
	  require 'config.php';
	  require 'connection.php';
    require 'database.php';

  $descricao = $_POST['descricao'];

  $TipoDoc  = array( 'descricao' => $descricao);
  					

  $grava = DB_Create('tipo_documento', $TipoDoc);
	
   if($grava) {
  
    echo "<form action=\"../tiposDocumento.php\" method='POST' name='formNotificacao'>

    <input type='hidden' name='validaNotificacao' value='sucesso'/>
    
    <script type'text\javascript'> document.formNotificacao.submit(); </script>
    
      </form>";
    
echo "<script>window.location.replace(\"../tiposDocumento.php\")</script>";


   }
  else {
    
  echo "<form action=\"../tiposDocumento.php\" method='POST' name='formNotificacao'>

    <input type='hidden' name='validaNotificacao' value='erro'/>
    
    <script type'text\javascript'> document.formNotificacao.submit(); </script>
    
      </form>";
    
echo "<script>window.location.replace(\"../tiposDocumento.php\")</script>";

  
  }
  

  ?>