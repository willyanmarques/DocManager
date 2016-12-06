<?php

require 'config.php';
require 'connection.php';
require 'database.php';
  
 $id = $_POST['ID-USER'];
 $nomeImagem = $_POST['nomeImagem'];
  
  $dropAdvogado = DB_Drop('advogado', 'id =' . "$id");
  
if ($dropAdvogado) {

    @unlink('../upload/imagem_perfil/advogado/'."$nomeImagem");

    echo "<form action=\"../advogados.php\" method='POST' name='formNotificacao'>

        <input type='hidden' name='validaNotificacao' value='sucesso'/>
        
        <script type'text\javascript'> document.formNotificacao.submit(); </script>
        
          </form>";
    
echo "<script>window.location.replace(\"../advogados.php\")</script>";

  }else{

echo "<form action=\"../advogados.php\" method='POST' name='formNotificacao'>

    <input type='hidden' name='validaNotificacao' value='erro'/>
    
    <script type'text\javascript'> document.formNotificacao.submit(); </script>
    
      </form>";
    
echo "<script>window.location.replace(\"../advogados.php\")</script>";

  }
  ?>