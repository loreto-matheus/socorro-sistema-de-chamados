<?php
    include "include/banco.php";
    
    $senha = $_POST['senha'];
    $senha = md5($senha); 
    $id = $_POST['idusuario'];
    
    $query = "update usuario set senha = '$senha', primeira_vez = '1' where idusuario = '$id' ";
    mysqli_query($con, $query);
    
    if(isset($_COOKIE['admin'])){
        header("Location: usuarios.php?mensagem=altera");
    }
?>