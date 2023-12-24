<?php 
// informações que o usuario passa atravez do homeusuario.php e support.php. 
	include "include/banco.php";

	
	$target_file = $target_dir . basename($_FILES["anexoChamado"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Check if image file is a actual image or fake image
if(isset($_FILES["anexoChamado"]) and is_uploaded_file($_FILES["anexoChamado"]['tmp_name'])) {
$fileTmpPath = $_FILES['anexoChamado']['tmp_name'];
$fileName = $_FILES['anexoChamado']['name'];
$fileSize = $_FILES['anexoChamado']['size'];
$fileType = $_FILES['anexoChamado']['type'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));

$newFileName = md5(time() . $fileName) . '.' . $fileExtension;


$uploadFileDir = "uploads/";
$dest_path = $uploadFileDir . $newFileName;
if(move_uploaded_file($fileTmpPath, $dest_path))
{
  $message ='File is successfully uploaded.';
}
else
{
  $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
}
	}


	$problema = $_POST['problema'];
	$descricao = $_POST['descricao'];
    $idusuario = $_POST['idusuario'];
	$email = $_POST['usuario2'];

	if(isset($_POST['usuario2'])){
		$query = "select unidade, nome from usuario where email = '$email' limit 1";
	}else{
		$query = "select unidade, nome from usuario where idusuario = '$idusuario' limit 1";
	}
	$consulta = mysqli_query($con, $query);
	
	if($usuario = mysqli_fetch_assoc($consulta)){
        $unidade = $usuario['unidade'];
        $nome = $usuario['nome'];
        date_default_timezone_set('America/Sao_Paulo');
		$data = date("Y-m-d H:i:s");
    }
    
	$query2 = "insert into chamados(idusuario, data, unidade, usuario, descricao, problema, status, anexo) values('$idusuario','$data','$unidade','$nome','$descricao','$problema','Pendente', '$dest_path')";
    mysqli_query($con, $query2);
	if(isset($_COOKIE['usuario'])){
    header("Location:homeusuario.php?mensagem=chamado_sucesso");
 }
 if(isset($_COOKIE['operador'])){
    header("Location:hometech.php?mensagem=chamado_sucesso");
 }
 if(isset($_COOKIE['admin'])){
    header("Location:home.php?mensagem=chamado_sucesso");
 }

 ?>