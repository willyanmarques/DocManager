<?php
	  require 'config.php';
	  require 'connection.php';
   	  require 'database.php';

   	  	$link = DB_Connect();
   	    $id_advogado = $_POST['advogado'];
  		$id_instituicao = $_POST['instituicao'];


  		 date_default_timezone_set('America/Recife'); //Configurando TimeZone
 		 $NOW = date("Y-m-d H:i:s"); // Configurando Formatacao da Data/Hora 

 		 $advogado_instituicao  = array( 'instituicao_id'      => $id_instituicao,
                     					'advogado_id'     => $id_advogado,
          				    			'dataVinculo'     => $NOW);

 		 $grava = DB_Create('advogado_instituicao', $advogado_instituicao);
	
		   if($grava) {
		  
		    echo "<form action=\"../vinInstituicao.php\" method='POST' name='formNotificacao'>

		    <input type='hidden' name='validaNotificacao' value='sucesso'/>
		    
		    <script type'text\javascript'> document.formNotificacao.submit(); </script>
		    
		      </form>";
		    
			echo "<script>window.location.replace(\"../vinInstituicao.php\")</script>";


		   }
		  else {
		    
		  echo "<form action=\"../vinInstituicao.php\" method='POST' name='formNotificacao'>

		    <input type='hidden' name='validaNotificacao' value='erro'/>
		    
		    <script type'text\javascript'> document.formNotificacao.submit(); </script>
		    
		      </form>";
		    
			echo "<script>window.location.replace(\"../vinInstituicao.php\")</script>";

		  
		  }
?>