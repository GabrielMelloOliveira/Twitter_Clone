<?php

session_start();

require_once('bd.class.php');

$usuario 	= $_POST['usuario'];
$senha 		= md5($_POST['senha']);

$objDB = new bd();
$objDB->connection_mysql();

$sql = "SELECT id, usuario, email FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";

$resultado_consulta = mysql_query($sql);

if($resultado_consulta){

	$dados_usuario = mysql_fetch_array($resultado_consulta);

	if(isset($dados_usuario['usuario'])){

		$_SESSION['id_usuario'] = $dados_usuario['id'];
		$_SESSION["usuario"] 	= $dados_usuario['usuario'];
		$_SESSION["email"] 		= $dados_usuario['email'];

		header("Location: home.php");
	}else{
		header("Location: index.php?erro=1");
	}

}else{
	echo "Erro ao realizar a consulta";
}

?>