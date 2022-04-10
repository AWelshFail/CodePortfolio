<?php
require '../db/db_connection.php';
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$stmt = $pdo->prepare("DELETE FROM admin WHERE id=?");
	$stmt->execute([$id]); 
	header("Location: dashboard.php");
}
?>