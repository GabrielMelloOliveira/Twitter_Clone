<?php

session_start();

if(!isset($_SESSION['usuario'])) header("Location: index.php?erro=1");

require_once('bd.class.php');

$id_usuario = $_SESSION['id_usuario'];
$seguir_id_usuario = $_POST['seguir_id_usuario'];

$objDB = new bd();
$objDB->connection_mysql();

$sql = " DELETE FROM usuarios_seguidores WHERE id_usuario = $id_usuario AND seguindo_id_usuario = $seguir_id_usuario ";

mysql_query($sql);

?>