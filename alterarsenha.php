<?php
    include "include/banco.php";
    
    $senha = $_POST['senha'];
    $senha = md5($senha); 
    $id = $_POST['idusuario'];
    
    $query = "update usuario set senha = '$senha', primeira_vez = '0' where idusuario = '$id' ";
    mysqli_query($con, $query);
    
    if(isset($_COOKIE['usuario'])){
        header("Location: homeusuario.php?mensagem=altera");
    }else if(isset($_COOKIE['operador'])){
        header("Location: hometech.php?mensagem=altera");
    }
?>