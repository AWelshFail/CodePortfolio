<?php
require 'db/db_connection.php';
include('includes/trader_header.html');
include 'navigation.php';



if (!empty($_SESSION["id"])) {
	//session_start();
	$username=$_SESSION["username"];
	$stmt = $pdo->prepare("SELECT * FROM tradesmen WHERE username=?");
	$stmt->execute([$username]);
	$user = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Dashboard</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>

		<div class="full-width">
			<div class="row">
				<div class="qua-width" style="text-align: center;">
					<div>
						<img src="img/profile/<?php echo $user['profile_picture']?>" style="border-radius: 50%; width: 50%;">

					</div>
					<div style="padding-top: 10px;">
						<h3><?php echo $user['surname']." ".$user['firstname']." ". $user['hourly_rate'];?>/hr</h3>
					</div>
					<div style="padding-top: 10px;">Rating: <?php echo $user['review_rate'];?></div>
					<div style="padding-top: 10px;">Company Name: <?php echo $user['company_name'];?></div>
				</div>
				<div class="qua-rest" style="padding: 0 50px;">
					<div>

						<h1>No jobs found. Complete your profile to get more attention</h1>
					</div>
				</div>
			</div>
		</div>


	</body>
</html>
<?php
include ('includes/guest_footer.html');
?>
