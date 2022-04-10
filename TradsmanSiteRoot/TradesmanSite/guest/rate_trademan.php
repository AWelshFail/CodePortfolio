<?php
require '../db/db_connection.php';
if (isset($_POST['rate_trademan'])) {
	# code...
	$stmt = $pdo->prepare("SELECT * FROM tradesmen");
	$stmt->execute();
	$tradesmen = $stmt->fetchAll();
	foreach ($tradesmen as $tradesman) {
		$this_codes = explode(",", $tradesman['code']);
		foreach ($this_codes as $code) {
			if($code == $_POST['code']){
				$current_rate=(float) $_POST['rate_to_give'];
				$t_id = $tradesman['id'];
				$old_review=$tradesman['review_rate'];
				$old_review_count = $tradesman['review_rate'];
				$new_review_count= $tradesman['review_rate'] + 1;
				$new_rate= ((float)$old_review + (float)$current_rate) / (float)$new_review_count;
				$stmt = $pdo->prepare("UPDATE `tradesmen` SET `review_rate` = ? , `review_count` = ? WHERE `tradesmen`.`id` = ?");
				$stmt->execute([number_format((float)$new_rate, 2, '.', ''), $new_review_count, $t_id]);
			}
		}
	}
}
include('guest_header.html');
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
	</head>
	<body>
		<div style="text-align: center; padding-top: 20px;">
			<h1>Let us know how well you were satisfied</h1>
		</div>
		<div class="full-width" style="text-align: center;">
			<div>
				<form action="" method="POST">
					<div style="padding-top: 30px;"><input style="padding: 15px 10px; width: 20%;" placeholder="Job Code" type="text" name="code"></div>
					<div style="padding-top: 30px;"><input style="padding: 15px 10px; width: 20%;"placeholder="Rate on a scale of 1-5" type="text" name="rate_to_give"></div>
					<div style="padding-top: 30px;"><input style="padding: 15px 10px; width: 20%;" type="submit" name="rate_trademan" value="Rate"></div>
					<div style="padding-top: 30px; color: red;">
						*  Please note that the rate is on a scale of 1-5 with 1 being extremly bad and 5 being extremly good
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
<?php
include ('guest_footer.html');
?>
