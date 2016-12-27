<?php

	$remetente 		= 	strip_tags(trim($_POST['nome']));
	$destinatario 	= 	strip_tags(trim($_POST['emailUnidade']));
	$titulo 		= 	strip_tags(trim($_POST['tituloEmail']));
	$mensagem		= 	strip_tags(trim($_POST['mensagem']));
	$chave 			= 	$_POST['chaveDoc'];
	print_r($arquivo = 	$_POST['arquivo']);


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
	} else {

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
						<strong>Chave de autenticação: </strong>{$chave}<br>";

		$email ->MsgHTML($corpoEmail); // Carrega o corpo do Email definido a cima

		$path = '/opt/lampp/htdocs/DocManager/upload/documentos/instituicao/'.$arquivo;
		$email->AddAttachment($path);

		if ($email->Send()) {

			//return true;
			echo "<script>alert('Documento Enviado com Sucesso!');</script>";

		} else { 

			//return false; 
			echo "<script>alert('Erro ao Enviar o Documento!);</script>"; 
		}
	}

