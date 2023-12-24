<?php 
	if(isset($_COOKIE['admin'])){
		setcookie("admin","admin", time()-1);
	}

	if(isset($_COOKIE['usuario'])){
		setcookie("usuario","", time()-1);
	}
    if(isset($_COOKIE['operador'])){
		setcookie("operador","", time()-1);
	}
    setcookie("unidade","", time()-1);
	setcookie("view","", time()-1);

	header("Refresh:0.9, index.php?mensagem=logoff");

 ?>