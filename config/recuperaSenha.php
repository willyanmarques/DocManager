<?php
	
	require('conexao.php');

	$email 		  = strip_tags(trim($_POST['email'])); //strim_tags limpa qualquer insercoes de código html ou php dentro do post
	$destinatario = $email;
	//Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
	$sql = "SELECT * FROM usuario WHERE email = '$email' LIMIT 1";
	$execute  = $mysqli  -> query($sql) or die ($mysqli->error);
	$resultado  = $execute -> fetch_assoc();
	$titulo 		= 	'Recuperação de senha';
	$mensagem		= 	'Olá, '.$resultado['nome']." ".$resultado['sobrenome'].'!<br> 
						Este são seus dados de acesso ao sistema.<br>'.'<b>E-mail:</b> '.$resultado['email'].' | <b>Senha: </b>'.$resultado['senha'].'
						<br><br>Caso não tenha solicitado a recuperação de senha, por favor desconsidere este E-mail.';


	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
		$email ->AddAddress ($destinatario);
		$email ->Subject = 'Recuperação de Senha'; // Assunto

		$corpoEmail =  "{$mensagem}<br>";

		$email ->MsgHTML($corpoEmail); // Carrega o corpo do Email definido a cima

		if ($email->Send()) {

			//return true;
			echo "<script>alert('Um E-mail com os dados de acesso foi enviado. Por favor, verifique sua caixa de entrada!');</script>";

		} else { //return false; 
			echo "<script>alert('Erro ao recuperar a senha! Tente novamente, ou contate o administrador do sistema.);</script>"; }
	}

	?>

