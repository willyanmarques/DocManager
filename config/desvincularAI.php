<?php

require 'config.php';
require 'connection.php';
require 'database.php';
  
 $id_instituicao = $_POST['id_instituicao'];
 $id_advogado = $_POST['id_advogado'];

  
  $dropVinculo = DB_Drop('advogado_instituicao','instituicao_id ='."$id_instituicao " ."AND". ' advogado_id ='."$id_advogado");
  
if ($dropVinculo) {

    echo "<form action=\"../vinInstituicao.php\" method='POST' name='formNotificacao'>

        <input type='hidden' name='validaNotificacao' value='sucesso'/>
        
        <script type'text\javascript'> document.formNotificacao.submit(); </script>
        
          </form>";
    
echo "<script>window.location.replace(\"../vinInstituicao.php\")</script>";

  }else{

echo "<form action=\"../vinInstituicao.php\" method='POST' name='formNotificacao'>

    <input type='hidden' name='validaNotificacao' value='erro'/>
    
    <script type'text\javascript'> document.formNotificacao.submit(); </script>
    
      </form>";
    
echo "<script>window.location.replace(\"../vinInstituicao.php\")</script>";

  }
  ?>