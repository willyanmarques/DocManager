<?php

// Abre conexao com o MySQL

function DB_Connect() {

	$link = @mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die(mysqli_connect_error());
	mysqli_set_charset($link, DB_CHARSET) or die(mysqli_error($link));

	return $link;

}

// Fecha conexao com o MySQL

function DB_Close($link) {

	@mysqli_close($link) or die(mysqli_error($link));

}

// Protege contra SQL Injection

function DB_Escape($dados) {

	$link = DB_Connect();

	if (!is_array($dados))

	$dados = mysqli_real_escape_string($link, $dados);
		
	else {
		$arr = $dados;
		
		foreach ($arr as $key => $value) {
			
			$key   = mysqli_real_escape_string($link, $key);
			$value = mysqli_real_escape_string($link, $value);
			
			$dados[$key] = $value;
			
		}
		
	}

	DB_Close($link);
	return $dados;
}
?>