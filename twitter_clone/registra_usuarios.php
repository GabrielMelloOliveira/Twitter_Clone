<?php

require_once('bd.class.php');

$usuario 	= $_POST['usuario'];
$email 		= $_POST['email'];
$senha 		= md5($_POST['senha']);

$objDB = new bd();
$objDB->connection_mysql();

$usuario_existe = false;
$email_existe = false;

$sql = " SELECT * FROM usuarios WHERE usuario = '$usuario' ";

if($resultado_consulta = mysql_query($sql)){
	
	$dados = mysql_fetch_array($resultado_consulta);

	if(isset($dados['usuario'])){
		echo 'Usuário já cadastrado!';
		$usuario_existe = true;
	}

}else{
	echo "Erro ao tentar localizar o registro de usuário no banco de dados";
}
 
$sql = " SELECT * FROM usuarios WHERE email = '$email' ";

if($resultado_consulta = mysql_query($sql)){
	
	$dados = mysql_fetch_array($resultado_consulta);

	if(isset($dados['email'])){
		echo 'Email já cadastrado!';
		$email_existe = true;
	}

}else{
	echo "Erro ao tentar localizar o registro de usuário no banco de dados";
}

if($usuario_existe || $email_existe){

	$retorno_get = '';

	if($usuario_existe){
		$retorno_get.= 'erro_usuario=1&';
	}

	if($email_existe){
		$retorno_get.= 'erro_email=1&';
	}

	header("Location: inscrevase.php?".$retorno_get);

	die();
}

$sql = " INSERT INTO usuarios (usuario, email, senha) VALUES ('$usuario', '$email', '$senha') ";

if(mysql_query($sql)){
	header("Location: index.php");
}else{
	echo "Erro ao cadastrar o usuário";
}

?>