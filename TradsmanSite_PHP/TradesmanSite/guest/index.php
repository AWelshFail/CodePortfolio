<?php
require '../db/db_connection.php';
$t_ids = [];
if (isset($_POST['search'])){
	$category = $_POST['category'];
	if ($category === "") {
		# code...
		$stmt = $pdo->prepare("SELECT * FROM tradesmen ORDER BY `certifications` DESC");
		$stmt->execute([$category]);
		$tradesmen = $stmt->fetchAll();
		foreach ($tradesmen as $tradesman) {
			$searchtext = $_POST['service'];
			$services = explode(",", $tradesman['services']);
			foreach ($services as $service) {
				if ($service === $searchtext){
					array_push($t_ids, $tradesman['id']);
				}
			}
		}
	}
	else{
		$stmt = $pdo->prepare("SELECT * FROM tradesmen WHERE category = ? ORDER BY  `certifications` DESC");
		$stmt->execute([$category]);
		$tradesmen = $stmt->fetchAll();
		foreach ($tradesmen as $tradesman) {
			$searchtext = $_POST['service'];
			$services = explode(",", $tradesman['services']);
			foreach ($services as $service) {
				if ($service === $searchtext){
					array_push($t_ids, $tradesman['id']);
				}
			}
		}
	}

}
include('guest_header.html');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
	</head>
	<body>

		<div class="full-width">
			<div class="" style="padding: 50px; text-align: center;">
				<form action="" method="POST">
					<select name="service" style="width: 40%; padding: 5px 10px;">
						<option value="Plumbing">Plumbing</option>
						<option value="Mechanical">Mechanical</option>
						<option value="Electrical">Electrical</option>
						<option value="Car Seller">Car Seller</option>
						<option value="Maintanace">Maintanace</option>
					</select>
					<select name="category" style="width:20%; padding: 5px 10px;">
						<option value="" default></option>
						<option value="IT">IT</option>
						<option value="Education">Education</option>
					</select>
					<input type="submit" name="search" value="Search" style="padding: 15px 20px;">
				</form>
			</div>
		</div>
		<div class="full-width">
			<div class="" style="padding: 50px; text-align: center;">
				<?php
				if(!empty($t_ids)){
					foreach ($t_ids as $t_id) {
						$stmt = $pdo->prepare("SELECT * FROM tradesmen WHERE id = ?");
						$stmt->execute([$t_id]);
						$man = $stmt->fetch();
						echo "<div class='row'>
						<div style='width: 25%;'> <img height=150 width=150 src='../img/profile/".$man['profile_picture']."'> </div>
						<div style='width: 25%;'> ".$man['surname']." ".$man['firstname']."</div>
						<div style='width: 25%;'> ".$man['services']."</div>
						<div style='width: 25%;'> <a href='view_tradesman.php?id=".$man['id']."'> View Profile</a> </div> </div>";
					}
				}elseif (isset($_POST['search']) && empty($t_ids)){
					echo "<div class='full-width' style='text-align=center;'><h4>Sorry, we could not find a match for you at the moment.</h4></div>";
				}else{
					echo "<div class='full-width' style='text-align=center;'><h4>Create a search.</h4></div>";
				}
				?>
			</div>
		</div>

	</body>
</html>
<?php
include ('guest_footer.html');
?>
