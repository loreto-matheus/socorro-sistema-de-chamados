<?php
	require_once "include/banco.php";
	
    if (isset($_POST['idchamado'])){
/* RECEBE DA PÁGINA (HOME.PHP) O ID CHAMADO QUE SOLICITOU ALTERAR PARA 'RESOLVIDO '*/	
    $idchamado = $_POST['idchamado'];
    $operador = $_POST['operador'];
    $solucao = $_POST['solucao'];
    $status = $_POST['status'];
    date_default_timezone_set('America/Sao_Paulo');
		$data = date("Y-m-d H:i:s");
    
    if(empty($solucao)){
        if($_COOKIE['operador']){
            header("Location:hometech.php?mensagem=revisar");
            die();
        }else{
            header("Location:home.php?mensagem=revisar"); 
            die();
        }
    }
    $query = "select idusuario from chamados where idchamado = '$idchamado' ";
    $consulta = mysqli_query($con,$query);
    
    if ($info = mysqli_fetch_assoc($consulta)) {
        
        $idusuario = $info['idusuario'];
        //adiciona ao chamado a solução proposta e o operador responsável
        $query3 = "update chamados set status = '$status', data_atendimento = '$data', operador = '$operador', solucao = '$solucao' where idchamado = $idchamado";
        mysqli_query($con,$query3);	
        
        if($status == "Resolvido"){
            if($_COOKIE['operador']){
                header("Location:hometech.php?mensagem=encerrado");
            }else{
                header("Location:home.php?mensagem=encerrado"); 
            }
        };
        if($status == "Validação"){
            if($_COOKIE['operador']){
                header("Location:hometech.php?mensagem=solicitado");
            }else{
                    header("Location:home.php?mensagem=solicitado"); 
                }
        }
    
    }else{
        header("Location:index.php");
    }
}
 ?>