<?php

  require 'config.php';
  require 'connection.php';
  require 'database.php';

  $link = DB_Connect();


  $id = $_POST['ID-INST'];

  
  $dropInstituicao = DB_Drop('instituicao', 'id =' . "$id");

  if (!$dropInstituicao) {

    echo "Erro: %d\n", $mysqli->errno;

      }
  
/*if ($dropInstituicao) {

    echo "<form action=\"../instituicoes.php\" method='POST' name='formNotificacao'>

        <input type='hidden' name='validaNotificacao' value='sucesso'/>
        
        <script type'text\javascript'> document.formNotificacao.submit(); </script>
        
          </form>";
    
echo "<script>window.location.replace(\"../instituicoes.php\")</script>";

  }else{

echo "<form action=\"../instituicoes.php\" method='POST' name='formNotificacao'>
instituicoes
    <input type='hidden' name='validaNotificacao' value='erro'/>
    
    <script type'text\javascript'> document.formNotificacao.submit(); </script>
    
      </form>";
    
echo "<script>window.location.replace(\"../instituicoes.php\")</script>";

  }*/
  ?>