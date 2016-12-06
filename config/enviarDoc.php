<?php

	$remetente 		= 	strip_tags(trim($_POST['nome']));
	$destinatario 	= 	strip_tags(trim($_POST['emailUnidade']));
	$titulo 		= 	strip_tags(trim($_POST['tituloEmail']));
	$mensagem		= 	strip_tags(trim($_POST['mensagem']));
	$chave 			= 	$_POST['chave'];
	$arquivo 		= 	$_POST['arquivo'];
	var_dump($arquivo);

	$tamanho =	'5242880'; //Tamanho max para envio 5MB convertido em Bytes
	// Tipos de imagens validas para envio
	$tipos 	 =  array('image/jpeg' => 'image/pjpeg',
					  'image/jpeg' => 'image/jpeg',
					  'image/png' => 'image/png'); 

	if (empty($remetente)) {
		$msg = 'O nome é obrigatório!';
	} elseif (!filter_var($destinatario, FILTER_VALIDATE_EMAIL)) {
		$msg = 'Digite um E-mail válido!';
		echo $msg;
	} elseif (empty($titulo)) {
		$msg = 'O título é obrigatório!';
		echo $msg;
	} elseif (empty($mensagem)) {
		$msg = 'A mensagem é obrigatória!';
		echo $msg;
	} /*elseif (!is_uploaded_file($arquivo['tmp_name'])) {
		$msg = 'O arquivo é obrigatório!';
		echo $msg;
	} elseif ($arquivo['size'] > $tamanho) {
		$msg = 'O limite de tamanho do arquivo é de 5MB!';
		echo $msg;
	} elseif (!in_array($arquivo['type'], $tipos)) {
		$msg = 'O tipo de documento permitito é: JPG, JPEG e PNG.';
		echo $msg;
	}*/ else {

		require('PHPMailer/PHPMailerAutoload.php');
		$email = new PHPMailer(); // Nova instancia da classe
		$email->CharSet = 'UTF-8';
		$email->IsSMTP(); // Enviar via smtp
		$email->SMTPAuth = true; // sera por autenticacao
		$email->Port = 587; // Porta de envio
		$email->Host = 'mx1.hostinger.com.br';
		$email->Username = 'contato@fastsoftwarepe.com.br';
		$email->Password = 'CFUyBNi7LK';
		$email->SetFrom('contato@fastsoftwarepe.com.br', 'Sistema DocManager');
		$email -> AddAddress ($destinatario);
		$email ->Subject = 'Envio de Documento'; // Assunto

		$corpoEmail =  "<strong>Remetente: </strong>{$remetente}<br>
						<strong>Destinatario: </strong>{$destinatario}<br>
						<strong>Assunto: </strong>{$titulo}<br>
						<strong>Mensagem: </strong>{$mensagem}<br>
						<strong>Chave de Validação: </strong>{$chave}<br>";

		$email ->MsgHTML($corpoEmail); // Carrega o corpo do Email definido a cima

		$file_to_attach = '/opt/lampp/htdocs/DocManager/upload/documentos/detento/'.$arquivo;
		$email->AddAttachment( $file_to_attach );
		//$email ->AddAttachment($arquivo['tmp_name'], $arquivo['name']);

		if ($email->Send()) {

			//return true;
			echo "<script>alert('Documento Enviado com Sucesso!');</script>";

		} else { //return false; 
			echo "<script>alert('Erro ao Enviar o Documento!);</script>"; }
	}

