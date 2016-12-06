<?php

require 'config.php';
require 'connection.php';
require 'database.php';
  
 $id_detento = $_POST['id_detento'];
 $id_advogado = $_POST['id_advogado'];

  
  $dropVinculo = DB_Drop('advogado_detento','detento_id ='."$id_detento " ."AND". ' advogado_id ='."$id_advogado");
  
if ($dropVinculo) {

    echo "<form action=\"../vinDetento.php\" method='POST' name='formNotificacao'>

        <input type='hidden' name='validaNotificacao' value='sucesso'/>
        
        <script type'text\javascript'> document.formNotificacao.submit(); </script>
        
          </form>";
    
echo "<script>window.location.replace(\"../vinDetento.php\")</script>";

  }else{

echo "<form action=\"../vinDetento.php\" method='POST' name='formNotificacao'>

    <input type='hidden' name='validaNotificacao' value='erro'/>
    
    <script type'text\javascript'> document.formNotificacao.submit(); </script>
    
      </form>";
    
echo "<script>window.location.replace(\"../vinDetento.php\")</script>";

  }
  ?>