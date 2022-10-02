<?php
require 'db/db_connection.php';
include('includes/trader_header.html');
include 'navigation.php';
$job_ids = [];

$stmt = $pdo->prepare("SELECT * FROM jobs");
$stmt->execute();
$jobs = $stmt->fetchAll();
$u_id = $_SESSION["id"];
$stmt = $pdo->prepare("SELECT * FROM tradesmen WHERE id=?");
$stmt->execute([$u_id]);
$user = $stmt->fetch();
$user_codes=explode(",", $user['code']);
foreach ($jobs as $job) {
	$this_codes = explode(",", $job['code']);
	foreach ($this_codes as $code) {
		foreach ($user_codes as $user_code) {
			if($code === $user_code){
				array_push($job_ids, $job['id']);
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<div>
		</div>
		<div class="full-width">
			<?php
				if(!empty($job_ids)){
					foreach ($job_ids as $job_id) {
						$stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = ?");
						$stmt->execute([$job_id]);
						$job = $stmt->fetch();
						echo "<div style=' padding: 20px 10px;'><h3>Job Information </h3> <div class='row' >
						<div style='width: 25%;'>  Here is the client number:".$job['phone_number']."</div>
						<div style='width: 25%;'> Here is the job code: ".$job['code']."</div></div></div>";
					}
				}else{
					echo "<div class='row'>
						<div style='width: 100%; text-align:center; padding-top: 30; color:red;'> <h2>No Jobs available to you at the moment</h2></div>
						</div>";
				}
				?>
		</div>
	</body>
</html>
<?php
include ('includes/guest_footer.html');
?>
