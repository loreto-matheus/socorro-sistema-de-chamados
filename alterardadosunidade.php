<?php 
    require_once "include/banco.php";

	$idunidade = $_POST['idunidade'];
	$unidade = $_POST['unidade'];
	$status = $_POST['status'];

	if (($unidade == "" or $status == "")){ header("Location:unidade.php?mensagem=branco"); die();}
	 

	/* SE CLICAR NO ÍCONE (ALTERAR) SEGUE ESTE FLUXO */
    $query = "update unidades set unidade = '$unidade', status = '$status' where idunidade = $idunidade ";
    mysqli_query($con,$query);
    header("Location:unidade.php?mensagem=cadastro_alterado");
		
 ?>