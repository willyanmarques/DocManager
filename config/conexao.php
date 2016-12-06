<?php

$hostname_conexao = '127.0.0.1:3306';
$database_conexao = 'docmanager_db';
$username_conexao = 'root';
$password_conexao = '001132229';

$mysqli = new mysqli($hostname_conexao, $username_conexao, $password_conexao, $database_conexao);
if ($mysqli->connect_errno){
	echo "Falha ao conectar com o MySQL: (" .$mysqli-connect_errno. ") " . $mysqli->connect_error;
}

?>
