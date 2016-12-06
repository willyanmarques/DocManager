<?php
	//Incluir a conexão com banco de dados
	include_once('conexao.php');
	
	//Recuperar o valor da palavra
	$cursos = $_POST['palavra'];
	
	//Pesquisar no banco de dados nome do curso referente a palavra digitada pelo usuário
	$cursos = "SELECT * FROM usuario WHERE nome LIKE '%$nome%'";
	$resultado_cursos = mysqli_query($conn, $cursos);
	
	if(mysqli_num_rows($resultado_cursos) <= 0){
		echo "Nenhum curso encontrado...";
	}else{
		while($rows = mysqli_fetch_assoc($resultado_cursos)){
			echo "<li>".$rows['nome']."</li>";
		}
	}
?>
