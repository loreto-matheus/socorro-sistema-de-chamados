<?php
	include "include/banco.php";
    if(isset($_COOKIE['admin']) or isset($_COOKIE['usuario']) or isset($_COOKIE['operador'])){
    if(isset($_COOKIE['admin'])){
        header("Location:home.php");
    }

    if(isset($_COOKIE['usuario'])){
        header("Location:homeusuario.php");
    }
    
    if(isset($_COOKIE['operador'])){
        header("Location:hometech.php");
    }
}else{


    $email = htmlspecialchars($_POST['emailLogin']);
    $senha = htmlspecialchars($_POST['senhaLogin']);
    $senha = md5($senha);

    $query = "select unidade, tp_usuario from usuario where email = '$email' and senha = '$senha' and dados_status = 'Ativo' limit 1";
	$cons = mysqli_query($con, $query);
	$total = mysqli_num_rows($cons);
    
    
    if($total > 0){
        if($usuario = mysqli_fetch_assoc($cons)){
            $tp_usuario = $usuario['tp_usuario'];
            $unidade = $usuario['unidade'];
            setcookie('unidade',  $unidade, (time() + (24 * 3600)));
            setcookie('view',  "kanban");
        }
        if($tp_usuario == "admin"){
            setcookie ("admin", "$email", (time() + (24 * 3600)));
            
            header("Location: home.php");
        }else if($tp_usuario == "operador"){
            setcookie ("operador", "$email", (time() +(24 * 3600)));
            header("Location: hometech.php");
        }else{
            setcookie ("usuario", "$email", (time() + (24 * 3600)));
            header("Location: homeusuario.php");
        }
    }else{
        header("Location:index.php?mensagem=login_invalido");
    }
}
 ?>