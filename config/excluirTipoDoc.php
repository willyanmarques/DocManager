<?php

require 'config.php';
require 'connection.php';
require 'database.php';
  
 $id = $_POST['id_tipoDoc'];

  
  $dropTipoDoc = DB_Drop('tipo_documento', 'id =' . "$id");
  
if ($dropTipoDoc) {

    echo "<form action=\"../tiposDocumento.php\" method='POST' name='formNotificacao'>

        <input type='hidden' name='validaNotificacao' value='sucesso'/>
        
        <script type'text\javascript'> document.formNotificacao.submit(); </script>
        
          </form>";
    
echo "<script>window.location.replace(\"../tiposDocumento.php\")</script>";

  }else{

echo "<form action=\"../tiposDocumento.php\" method='POST' name='formNotificacao'>

    <input type='hidden' name='validaNotificacao' value='erro'/>
    
    <script type'text\javascript'> document.formNotificacao.submit(); </script>
    
      </form>";
    
echo "<script>window.location.replace(\"../tiposDocumento.php\")</script>";

  }
  ?>