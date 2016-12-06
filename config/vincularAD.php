<?php
	  require 'config.php';
	  require 'connection.php';
   	  require 'database.php';

   	  	//$link = DB_Connect();
   	    $id_advogado = $_POST['advogado'];
  		$id_detento = $_POST['detento'];


  		 date_default_timezone_set('America/Recife'); //Configurando TimeZone
 		 $NOW = date("Y-m-d H:i:s"); // Configurando Formatacao da Data/Hora 

 		 $advogado_detento  = array( 'detento_id'      => $id_detento,
                     				 'advogado_id'     => $id_advogado,
          				    		 'dataVinculo'     => $NOW);

 		 $grava = DB_Create('advogado_detento', $advogado_detento);
 		 
	
		  if($grava) {
		  
		    echo "<form action=\"../vinDetento.php\" method='POST' name='formNotificacao'>

		    <input type='hidden' name='validaNotificacao' value='sucesso'/>
		    
		    <script type'text\javascript'> document.formNotificacao.submit(); </script>
		    
		      </form>";
		    
			echo "<script>window.location.replace(\"../vinDetento.php\")</script>";


		   }
		  else {
		    
		  echo "<form action=\"../vinDetento.php\" method='POST' name='formNotificacao'>

		    <input type='hidden' name='validaNotificacao' value='erro'/>
		    
		    <script type'text\javascript'> document.formNotificacao.submit(); </script>
		    
		      </form>";
		    
			echo "<script>window.location.replace(\"../vinDetento.php\")</script>";

		  
		  }
?>