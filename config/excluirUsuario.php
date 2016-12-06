<?php

require 'config.php';
require 'connection.php';
require 'database.php';
  
 $id = $_POST['ID-USER'];
 $nomeImagem = $_POST['nomeImagem'];
  
  $dropUsuario = DB_Drop('usuario', 'id =' . "$id");
  
if ($dropUsuario) {

    @unlink('../upload/imagem_perfil/usuario/'."$nomeImagem");

    echo "<form action=\"../usuarios.php\" method='POST' name='formNotificacao'>

        <input type='hidden' name='validaNotificacao' value='sucesso'/>
        
        <script type'text\javascript'> document.formNotificacao.submit(); </script>
        
          </form>";
    
echo "<script>window.location.replace(\"../usuarios.php\")</script>";

  }else{

echo "<form action=\"../usuarios.php\" method='POST' name='formNotificacao'>

    <input type='hidden' name='validaNotificacao' value='erro'/>
    
    <script type'text\javascript'> document.formNotificacao.submit(); </script>
    
      </form>";
    
echo "<script>window.location.replace(\"../usuarios.php\")</script>";

  }
  ?>