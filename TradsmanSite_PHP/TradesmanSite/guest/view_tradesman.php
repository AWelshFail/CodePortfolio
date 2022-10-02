<?php
require '../db/db_connection.php';
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$stmt = $pdo->prepare("SELECT * FROM tradesmen WHERE id=?");
	$stmt->execute([$id]);
	$user = $stmt->fetch();
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
		<div class="full-width" style="padding-top: 30px; padding-bottom: 30px;">
			<div class="row">
				<div class="qua-width" style="text-align: center;">
					<div>
						<img src="../img/profile/<?php echo $user['profile_picture']?>" style="border-radius: 50%; width: 50%;">

					</div>
					<div style="padding-top: 10px;">
						<h1><?php echo $user['surname']." ".$user['firstname']." ".$user['hourly_rate']?>/hr</h1>
					</div>
					<div style="padding-top: 10px;"><?php echo $user['review_rate']?></div>
					<div style="padding-top: 10px;"><?php echo $user['company_name']?></div>

				</div>
				<div>
					<div style="padding-top: 20px;">
						<h3><strong>Description</strong></h3>
						<div style="padding-top: 10px;">
							<?php echo $user['about']?>
						</div>
					</div>
					<div style="padding-top: 20px;">
						<h3><strong>Services</strong></h3>
						<div style="padding-top: 10px;">
							<?php echo $user['services']?>
						</div>
					</div>
					<div style="padding-top: 20px;">
						<h3><strong>Category</strong></h3>
						<div style="padding-top: 10px;">
							<?php echo $user['category']?>
						</div>
					</div>
					<div style="padding-top: 20px;">
						<h3><strong>Certifications</strong></h3>
						<div  style="padding-top: 10px;">
							<?php
							$certifications = explode(",", $user['certifications']);
							foreach ($certifications as $certification) {
								if ($certification !== "") {
									echo "<img height=150 width=150 src=../img/certification/".$certification.">";
								}
							}
							?>
						</div>
					</div>
					<div style="padding-top: 20px;">
						References
						<div  style="padding-top: 10px;">
							<?php
							$references = explode(",", $user['reference']);
							foreach ($references as $reference) {
								if ($reference !== "") {
									echo "<img height=150 width=150 src=../img/reference/".$reference.">";
								}
							}
							?>
						</div>
					</div>
					<div style="padding-top: 20px; color: red;">*Please type in your number for the trademan to contact you</div>
					<form style="padding-top: 10px;" action="select_user.php" method="POST">
						<input type="text" name="phone_number" style="padding: 10px 5px;" required>
						<input type="hidden" name="id" value=<?php echo $user['id'] ?>>
						<input type="submit" name="select_tradesman" value="Select">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
<?php
include ('guest_footer.html');
?>
