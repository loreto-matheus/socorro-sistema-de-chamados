<?php 
if(isset($_GET['email'])){
   $email = $_GET['email'];

    include "include/banco.php";
        
	    $query = "select nome, unidade, idusuario from usuario where email = '$email' limit 1";
	    $consulta = mysqli_query($con, $query);
	    $total = mysqli_num_rows($consulta);

        if($usuario = mysqli_fetch_array($consulta)){ //Usuário já existe
            $unidade = $usuario['unidade'];
            $idusuario = $usuario['idusuario'];

            $resposta = [
                'unidade' => $unidade,
                'idusuario' => $idusuario
            ];
           echo json_encode($resposta);
        }else{
            echo("Usuário não está relacionado a nenhuma unidade");
        }
    }
?>