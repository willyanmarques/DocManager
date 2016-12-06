<?php 

require('conexao.php');

$chave = $_POST['chave'];

$verificaChave = ("SELECT * FROM documento_detento WHERE cod_validacao = '$chave'");

$execute  = $mysqli  -> query($verificaChave) or die ($mysqli->error);
$vChave  = $execute -> fetch_assoc();
$num      = $execute -> num_rows;

if ($num > 0) {
	
	$autenticaDoc = ("SELECT doc.dataDocumento, doc.origem, doc.assunto, doc.cod_validacao, doc.tipo_documento_id, doc.detento_id, doc.dataCadastro, inst.tipo AS tipoInstituicao, inst.nome AS nomeInstituicao, det.nome AS nomeDetento FROM documento_detento doc, instituicao inst, detento det WHERE doc.cod_validacao = '$chave' LIMIT 1");

	$execute  = $mysqli  -> query($autenticaDoc) or die ($mysqli->error);
	$autDoc  = $execute -> fetch_assoc();

} else {

	echo "Documento não encontrado! Por favor, verifique a chave e tente novamente.";
}


?>