<?php

session_start();

if(!isset($_SESSION['usuario'])) header("Location: index.php?erro=1");

require_once('bd.class.php');

$id_usuario = $_SESSION['id_usuario'];

$objDB = new bd();
$objDB->connection_mysql();

$sql = " SELECT t.id_tweet, t.id_usuario, t.tweet, DATE_FORMAT(t.data_inclusao, '%d %b %Y %T') AS data_inclusao_formatada, u.usuario FROM tweet AS t JOIN usuarios AS u ON (t.id_usuario = u.id) WHERE id_usuario = $id_usuario OR id_usuario IN (SELECT seguindo_id_usuario FROM usuarios_seguidores WHERE id_usuario = $id_usuario) ORDER BY data_inclusao DESC ";

$resultado_consulta = mysql_query($sql);

if($resultado_consulta){

	while($tweet = mysql_fetch_array($resultado_consulta)){

		echo '<a href="#" class="list-group-item">';
		echo '<h4 class="list-group-item-heading"> '.$tweet['usuario'].' <small> - '.$tweet['data_inclusao_formatada'].'</small></h4>';
		echo '<p class="list-group-item-text">'.$tweet['tweet'].'</p>';
		echo '</a>';

	}

}else{
	echo 'Erro na execução da consulta';
}

?>