<?php 

	if(isset($_POST['cancelar'])){
		header("Location:usuarios.php");
	}
	
	print_r($_POST);
	if(isset($_POST['email']) and isset($_POST['cadastrar'])){
		
		$nome = htmlspecialchars($_POST['nome']);
        $email = htmlspecialchars($_POST['email']);
		$senha = htmlspecialchars($_POST['senha']);
		$senha = md5($senha);
		$unidade = $_POST['unidade'];
		$tp_usuario = $_POST['tp_usuario'];
		date_default_timezone_set('America/Sao_Paulo');
		$data = date("Y-m-d H:i:s");  

		if($nome != "" and $email != "" and $senha != "" and $unidade != "" and $tp_usuario != ""){

		
            
        include "include/banco.php";
        
	    $query = "select nome from usuario where email = '$email' limit 1";
	    $consulta = mysqli_query($con, $query);
	    $total = mysqli_num_rows($consulta);
	
		if($total > 0){
			header("Location:cadastro.php?mensagem=cadastro_erro");
		} else {
			$query2 = "insert into usuario(nome, email, senha, unidade, datacadastro, dados_status, primeira_vez, tp_usuario) values('$nome','$email','$senha','$unidade','$data','Ativo','1', '$tp_usuario')";
			mysqli_query($con, $query2);
			header("Location:usuarios.php?mensagem=cadastro_realizado");
		}

	}
      
	}
 ?>