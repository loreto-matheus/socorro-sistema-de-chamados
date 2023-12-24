<?php 
    require_once "include/banco.php";

	$id = $_POST['idusuario'];
	$nome = $_POST['nome'];
	$unidade = $_POST['unidade'];
	$email = $_POST['email'];
	$tp_usuario = $_POST['tp_usuario'];
	$selectAtivo = $_POST['selectAtivo'];
	$opcao = $_POST['opcao'];
	echo "<script>console.log('$_POST')</script>";

	if (($nome == "" or $unidade == "" or $email == "" or $tp_usuario == "") and $opcao == "alterar" ){ header("Location:usuarios.php?mensagem=branco"); die();}
	 

	/* SE CLICAR NO ÍCONE (ALTERAR) SEGUE ESTE FLUXO */
	if ($opcao == "alterar") {
		$conferir = "select idusuario from usuario where idusuario = $id limit 1";
		$cons = mysqli_query($con,$conferir);
		$row = mysqli_num_rows($cons);
			if ($row < 1){
				
				header("Location:usuarios.php?mensagem=senhaExiste");
			}else{
				$query = "update usuario set nome = '$nome', email = '$email', unidade = '$unidade', tp_usuario = '$tp_usuario', dados_status = '$selectAtivo' where idusuario = $id ";
				mysqli_query($con,$query);
				header("Location:usuarios.php?mensagem=cadastro_alterado");
		    }
	}	 /* FIM ----------- FIM */
 ?>