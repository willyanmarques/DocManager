<?php 

//Deletar Registros

function DB_Drop($tabela, $where = null){

$where = ($where) ? " WHERE {$where}" : null;
	

$query = "DELETE  FROM {$tabela} {$where}  ";
	
return DB_Execute($query);


}


//Altera Registros

function DB_Update ($tabela, array $dados, $where = null){
	
	foreach ($dados as $key => $value) {
	
		$campos[] = "{$key} = '{$value}'";
	}
	
	$campos  = implode(', ', $campos);

	$where = ($where) ? " WHERE {$where}" : null;
	
	$query = "UPDATE {$tabela} SET {$campos}{$where} ";
	
	return DB_Execute($query);
}

// Ler Registros

function DB_Read ($tabela, $campos = '*', $parametros = null){
	$parametros = ($parametros) ? " {$parametros}" : null;
	$query  = "SELECT {$campos} FROM {$tabela}{$parametros}";
	$result = DB_Execute($query); 
	
	if(!mysqli_num_rows($result))
	return false;
	else {
		while ($res = mysqli_fetch_assoc($result)) {
			
			$dados[] = $res;
			
		}
		
		return $dados;
	}
}

// Insere Imagem

function DB_Image ($arquivo, $diretorio){
	
if (isset($_FILES['arquivo'])) {

$extensao = strtolower(substr($_FILES['arquivo']['name'], -4)); // pega a extensao do arquivo
$novo_nome = md5(time()) . $extensao; //define o nome do arquivo
//$diretorio = "../upload/imagem_perfil/"; //define o diretorios para onde enviar o arquivo

move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);

//mysqli_query($sql_code) or die('Erro ao capturar a imagem. '.mysqli_error());
	
	return $novo_nome;

	}
}


// Insere Registros

function DB_Create ($tabela, array $dados){
	
	$dados   = DB_Escape($dados);
	$campos  = implode(', ', array_keys($dados));
	$valores = "'".implode("', '", $dados)."'";
	
	$query = "INSERT INTO {$tabela} ({$campos}) VALUES ({$valores});";
	
	return DB_Execute($query);
}

//Executa Querys

function DB_Execute($query) {

$link = DB_Connect();

$result = mysqli_query($link, $query) or die('Erro ao realizar operecao no Banco de Dados.<br>'.mysqli_error($link)."<br>Codigo do erro: <b>".mysqli_errno($link)."</b>");

DB_Close($link);
return $result;

}



?>