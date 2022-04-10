<?php
require '../db/db_connection.php';
if(isset($_GET['id'])){
	$status='active';
	$user_id=$_GET['id'];
	$stmt = $pdo->prepare("UPDATE `tradesmen` SET `account_status` = ? WHERE `tradesmen`.`id` = ?");
	$stmt->execute([$status, $user_id]);
	header("Location: dashboard.php");
}
?>