<?php 
// informações que o usuario passa atravez do homeusuario.php e support.php. 
	include "include/banco.php";


	$unidade = $_POST['unidade'];
	$status = "Ativo";

	$conferir = "select unidade from unidades where unidade = '$unidade' limit 1";
		$cons = mysqli_query($con,$conferir);
		$row = mysqli_num_rows($cons);
			if ($row > 0){
				
				header("Location:unidade.php?mensagem=unidadeExiste");
			}else{
				$query2 = "insert into unidades(unidade, status) values('$unidade','$status')";
				mysqli_query($con,$query2);
				header("Location:unidade.php?mensagem=cadastro_realizado");
		    }
    
	

 ?>