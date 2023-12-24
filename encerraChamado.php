<?php 
	include 'include/banco.php';

	/* RECEBE IDCHAMADO */
	if(isset($_POST['idchamado'])){		
		$idchamado = $_POST['idchamado'];
        date_default_timezone_set('America/Sao_Paulo');
		$data = date("Y-m-d H:i:s");

		/* ATUALIZA O STATUS NA TABELA 'CHAMADOS' PARA 'RESOLVIDO'*/
		$query = "update chamados set status = 'Resolvido', data_resolvido = '$data' where idchamado = $idchamado";
        mysqli_query($con,$query);

		
            if($_COOKIE['usuario']){
				header("Location:homeusuario.php?mensagem=encerrado");
            }else if($_COOKIE['operador']){
                header("Location:hometech.php?mensagem=encerrado"); 
            }else{
				header("Location:home.php?mensagem=encerrado"); 
			}
        
       
	}else{
        header("Location:index.php");
	} 
 ?>