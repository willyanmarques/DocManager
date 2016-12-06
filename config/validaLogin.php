<?php 

	session_start();
	require('conexao.php'); 

	if ((isset($_POST['email'])) && (isset($_POST['senha']))) {   

		    $email = mysqli_real_escape_string($mysqli, $_POST['email']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
		    $senha = mysqli_real_escape_string($mysqli, $_POST['senha']);
		    //$senha = md5($senha);
		        
		    //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
		    $sql = "SELECT * FROM usuario WHERE email = '$email' && senha = '$senha' && status = 1 LIMIT 1";
		    $execute  = $mysqli  -> query($sql) or die ($mysqli->error);
		    $resultado  = $execute -> fetch_assoc();
			
		    
		   if (empty($resultado)) {

		    	$_SESSION['loginErro'] = "Usuário ou senha inválidos.";
		    	header("Location: ../index.php");

		    } if ($resultado['status'] == 0) {

		    	$_SESSION['loginErroUserOFF'] = "Usuário temporariamente desativado, contate o adminstrador de sua unidade.";
		    	header("Location: ../index.php");
		    } 

		   		elseif (isset($resultado)) {

		    	$_SESSION['statusLogin']	    = 'LOGADO';
		    	$_SESSION['id']			 		= $resultado['id'];
		    	$_SESSION['nome'] 				= $resultado['nome'];
		    	$_SESSION['sobrenome']	 		= $resultado['sobrenome'];
		    	$_SESSION['arquivo']	        = $resultado['arquivo'];
		    	$_SESSION['perfil']      		= $resultado['perfil'];
		    	$_SESSION['email'] 				= $resultado['email'];
		    	$_SESSION['instituicao_id'] 	= $resultado['instituicao_id'];

		    	header("Location: ../home.php");

		    	$_SESSION["sessiontime"] = time() + 600;

		    }  else {

				$_SESSION['loginErro'] = "Usuário ou senha inválidos.";
				header("Location: ../index.php");
		}
	}

	 else {
				$_SESSION['loginErro'] = "Usuário ou senha inválidos.";
				header("Location: ../index.php");
		}

?>	