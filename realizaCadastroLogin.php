<?php 
	print_r($_POST);
	if(isset($_POST['email'])){
		
		$nome = htmlspecialchars($_POST['nome']);
        $email = htmlspecialchars($_POST['email']);
		$senha = htmlspecialchars($_POST['senha']);
		$senha = md5($senha);
		$unidade = $_POST['unidade'];
		date_default_timezone_set('America/Sao_Paulo');
		$data = date("Y-m-d H:i:s");  
            
        include "include/banco.php";
        
	    $query = "select nome from usuario where email = '$email' limit 1";
	    $consulta = mysqli_query($con, $query);
	    $total = mysqli_num_rows($consulta);
	
		if($total > 0){
			header("Location:index.php?erro=cadastro_erro");
		} else {
			$query2 = "insert into usuario(nome, email, senha, unidade, datacadastro, dados_status, primeira_vez, tp_usuario) values('$nome','$email','$senha','$unidade','$data','ativo','0', 'usuario')";
			mysqli_query($con, $query2);

        

                $query = "select tp_usuario from usuario where email = '$email' and senha = '$senha' and dados_status = 'ativo' limit 1";
                $cons = mysqli_query($con, $query);
                $total = mysqli_num_rows($cons);
    
                if($usuario = mysqli_fetch_assoc($cons)){
                    $tp_usuario = $usuario['tp_usuario'];
                }
                if($total > 0){
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
                    //mensagem de erro que vai para o script no index
                    header("Location:index.php?mensagem=login_invalido");
                }

			
		}
      
	}
 ?>