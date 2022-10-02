<?php
require '../db/db_connection.php';
function getCode() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < 10; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return $randomString;
}

if (isset($_POST['select_tradesman'])){
	$code = getCode();
	$id = $_POST['id'];
	$phone_number = $_POST['phone_number'];
	$stmt = $pdo->prepare("SELECT * FROM tradesmen WHERE id = ?");
	$stmt->execute([$id]);
	$tradesman = $stmt->fetch();
	$codes = explode(",", $tradesman['code']);
	array_push($codes, $code . ",");
	$stmt = $pdo->prepare("UPDATE `tradesmen` SET `code` = ? WHERE `tradesmen`.`id` = ?");
	$t_=implode("",$codes);
	$stmt->execute([$t_, $id]);
	$vals = array(
	   ':phone_number'    => $phone_number,
	   ':status' => 'in progress',
	   ':code'    => $code
	);
	$sql = "INSERT INTO jobs (phone_number, status, code) VALUES (:phone_number,:status ,:code)";
	$q = $pdo->prepare($sql);
	$q->execute($vals);
	header("Location: index.php");
}
?>