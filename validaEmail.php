<?php 
if(isset($_GET['email'])){
   $email = $_GET['email'];

    include "include/banco.php";
        
	    $query = "select nome from usuario where email = '$email' limit 1";
	    $consulta = mysqli_query($con, $query);
	    $total = mysqli_num_rows($consulta);

        if($total > 0){ //Usuário já existe
            echo("true");
        }else{
            echo("false");
        }
    }
?>