<?php

session_start();

if(!isset($_SESSION['usuario'])) header("Location: index.php?erro=1");

require_once('bd.class.php');

$id_usuario = $_SESSION['id_usuario'];
$nome = $_POST['txt_nome'];

$objDB = new bd();
$objDB->connection_mysql();

$sql = " SELECT u.*, us.id_usuario_seguidor FROM usuarios AS u LEFT JOIN usuarios_seguidores AS us ON (u.id = us.seguindo_id_usuario AND us.id_usuario = $id_usuario) WHERE u.usuario like '%$nome%' AND u.id <> $id_usuario ";

$resultado_consulta = mysql_query($sql);

if($resultado_consulta){

	while($pessoa = mysql_fetch_array($resultado_consulta)){

		$esta_seguindo_sn = isset($pessoa['id_usuario_seguidor']) && !empty($pessoa['id_usuario_seguidor']) ? 'S' : 'N' ;

		echo '<a href="#" class="list-group-item">';
		echo '<strong>'.$pessoa['usuario'].'</strong> <small> - '.$pessoa['email'].'</small>';
		echo '<p class="list-group-item-text pull-right">';

			$btn_seguir = 'block';
			$btn_deixar_seguir = 'block';

			if($esta_seguindo_sn == 'N'){
				$btn_deixar_seguir = 'none';
			}else{
				$btn_seguir = 'none';
			}

		echo '<button type="button" class="btn btn-default btn_seguir" id="seguir_'.$pessoa['id'].'" data-id_usuario="'.$pessoa['id'].'" style="display: '.$btn_seguir.';">Seguir</button>';
		echo '<button type="button" class="btn btn-primary btn_deixar_seguir" id="deixar_seguir_'.$pessoa['id'].'" data-id_usuario="'.$pessoa['id'].'" style="display: '.$btn_deixar_seguir.';">Deixar de Seguir</button>';
		echo '</p>';
		echo '<div class="clearfix"></div>';
		echo '</a>';

	}

}else{
	echo 'Erro na execução da consulta';
}

?>