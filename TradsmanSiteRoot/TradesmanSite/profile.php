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
	if(isset($_POST['save_about'])){
		$about=$_POST['about'];
		$user_id=$user['id'];
		$stmt = $pdo->prepare("UPDATE `tradesmen` SET `about` = ? WHERE `tradesmen`.`id` = ?");
		$stmt->execute([$about, $user_id]);
		header("Location: profile.php");

	}
	if(isset($_POST['add_skill'])){
		$skill=$user['skills'] . $_POST['skill'] . ",";
		$user_id=$user['id'];
		$stmt = $pdo->prepare("UPDATE `tradesmen` SET `skills` = ? WHERE `tradesmen`.`id` = ?");
		$stmt->execute([$skill, $user_id]);
		header("Location: profile.php");

	}
	if(isset($_POST['add_service'])){
		$service=$user['services'] . $_POST['service'] . ",";
		$user_id=$user['id'];
		$stmt = $pdo->prepare("UPDATE `tradesmen` SET `services` = ? WHERE `tradesmen`.`id` = ?");
		$stmt->execute([$service, $user_id]);
		header("Location: profile.php");
	}
	if(isset($_POST['change_category'])){
		$category=$_POST['category'];
		$user_id=$user['id'];
		$stmt = $pdo->prepare("UPDATE `tradesmen` SET `category` = ? WHERE `tradesmen`.`id` = ?");
		$stmt->execute([$category, $user_id]);
		header("Location: profile.php");
	}
	if(isset($_POST['add_certification'])){
		$target_dir = "img/certification/";
		$target_file = $target_dir . basename($_FILES["certification"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["certification"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
		    $uploadOk = 0;
		}
		$temp = explode(".", $_FILES["certification"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		move_uploaded_file($_FILES["certification"]["tmp_name"], "img/certification/" .$newfilename);
		$certification=$user['certifications'] . $newfilename . ",";
		$user_id=$user['id'];
		$stmt = $pdo->prepare("UPDATE `tradesmen` SET `certifications` = ? WHERE `tradesmen`.`id` = ?");
		$stmt->execute([$certification, $user_id]);
		header("Location: profile.php");
	}
	if(isset($_POST['add_hourly_rate'])){
		$rate=$_POST['hourly_rate'];
		$user_id=$user['id'];
		$stmt = $pdo->prepare("UPDATE `tradesmen` SET `hourly_rate` = ? WHERE `tradesmen`.`id` = ?");
		$stmt->execute([$rate, $user_id]);
		header("Location: profile.php");
	}
	if(isset($_POST['save_company_name'])){
		$company_name=$_POST['company_name'];
		$user_id=$user['id'];
		$stmt = $pdo->prepare("UPDATE `tradesmen` SET `company_name` = ? WHERE `tradesmen`.`id` = ?");
		$stmt->execute([$company_name, $user_id]);
		header("Location: profile.php");
	}
	if(isset($_POST['update_profile_picture'])){
		$target_dir = "img/profile/";
		$target_file = $target_dir . basename($_FILES["profile"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["profile"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
		    $uploadOk = 0;
		}
		$temp = explode(".", $_FILES["profile"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		move_uploaded_file($_FILES["profile"]["tmp_name"], "img/profile/" . $newfilename);
		//move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file);
		$profile=$newfilename;
		$user_id=$user['id'];
		$stmt = $pdo->prepare("UPDATE `tradesmen` SET `profile_picture` = ? WHERE `tradesmen`.`id` = ?");
		$stmt->execute([$profile, $user_id]);
		header("Location: profile.php");
	}

	if(isset($_POST['add_reference'])){
		$target_dir = "img/reference/";
		$target_file = $target_dir . basename($_FILES["reference"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["reference"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
		    $uploadOk = 0;
		}
		$temp = explode(".", $_FILES["reference"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		move_uploaded_file($_FILES["reference"]["tmp_name"], "img/reference/" .$newfilename);
		$reference=$user['reference'] . $newfilename . ",";
		$user_id=$user['id'];
		$stmt = $pdo->prepare("UPDATE `tradesmen` SET `reference` = ? WHERE `tradesmen`.`id` = ?");
		$stmt->execute([$reference, $user_id]);
		header("Location: profile.php");
	}


}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Profile</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<div class="full-width" style="padding: 30px 10px;">
			<div class="row">
				<div class="qua-width" style="text-align: center;">
					<div>
						<img src="img/profile/<?php echo $user['profile_picture']?>" style="border-radius: 50%; width: 50%;">

					</div>
					<div style="padding-top: 10px;">
						<h3><?php echo $user['surname']." ".$user['firstname']." ". $user['hourly_rate'];?>/hr</h3>
					</div>
					<div style="padding-top: 10px;">Rating: <?php echo $user['review_rate']?></div>
					<div style="padding-top: 10px;">Company Name:<?php echo $user['company_name']?></div>
				</div>
				<div class="qua-rest" style="padding: 0 50px;">
					<div class="full-width">
						<div class="full-width" style="padding-top:15px;">
							Update about
							<div>
								<?php $user['about']?>
							</div>
							<form action="" method="POST">
								<textarea name="about" rows="10" style="width: 80%;"><?php echo $user['about']?></textarea>
								<input type="submit" name="save_about" value="Add">
							</form>
						</div>
						<div class="full-width" style="padding-top:15px;">
							Company name
							<form action="" method="POST">
								<input type="text" name="company_name" style="width: 40%; padding: 5px 10px;" value="<?php echo $user['company_name']?>">
								<input type="submit" name="save_company_name" value="Save">
							</form>
						</div>
						<div class="full-width" style="padding-top:15px;">
							Hourly rate
							<form action="" method="POST">
								<input type="text" name="hourly_rate" style="width: 40%; padding: 5px 10px;" value="<?php echo $user['hourly_rate']?>">
								<input type="submit" name="add_hourly_rate" value="Save">
							</form>
						</div>
						<div class="full-width" style="padding-top:15px;">
							<?php
							$skills = explode(",", $user['skills']);
							foreach ($skills as $skill) {
								echo "<div>".$skill."</div>";
							}
							?>

							Add skills
							<form action="" method="POST">
								<input type="text" name="skill" style="width: 40%;padding: 5px 10px;">
								<input type="submit" name="add_skill" value="Add">
							</form>
						</div>

						<div class="full-width" style="padding-top:15px;">
							<?php
							$services = explode(",", $user['services']);
							foreach ($services as $service) {
								echo "<div>".$service."</div>";
							}
							?>
							Add services
							<form action="" method="POST">
								<select name="service" style="width: 40%; padding: 5px 10px;">
									<option value="Plumbing">Plumbing</option>
									<option value="Mechanical">Mechanical</option>
									<option value="Electrical">Electrical</option>
									<option value="Car Seller">Car Seller</option>
									<option value="Maintanace">Maintanace</option>
								</select>
								<input type="submit" name="add_service" value="Add">
							</form>
						</div>
						<div class="full-width" style="padding-top:15px;" >
							<?php
							$category = $user['category'];
							echo "<div>".$category."</div>";
							?>
							Select category
							<form action="" method="POST">
								<select name="category" style="width: 40%; padding: 5px 10px;">
									<option value="IT">IT</option>
									<option value="Education">Education</option>
								</select>
								<input type="submit" name="change_category" value="Change">
							</form>

						</div>

						<div class="full-width" style="padding-top:15px;">
							<?php
							$certifications = explode(",", $user['certifications']);
							foreach ($certifications as $certification) {
								if ($certification !== "") {
									echo "<img height=50 width=50 src=img/certification/".$certification.">";
								}
							}
							?>
							Certification
							<form action="" method="POST" enctype="multipart/form-data">
								<input type="file" name="certification"  style="width: 40%; padding: 5px 10px;">
								<input type="submit" name="add_certification" value="Add">
							</form>
						</div>

						<div class="full-width" style="padding-top:15px;">
							<?php
							$references = explode(",", $user['reference']);
							foreach ($references as $reference) {
								if ($reference !== "") {
									echo "<img height=50 width=50 src=img/reference/".$reference.">";
								}
							}
							?>
							Upload reference
							<form action="" method="POST" enctype="multipart/form-data">
								<input type="file" name="reference"  style="width: 40%; padding: 5px 10px;">
								<input type="submit" name="add_reference" value="Add">
							</form>
						</div>
						<div class="full-width" style="padding-top:15px;">
							<?php
							$picture = $user['profile_picture'];
							echo "<img height=50 width=50 src=img/profile/".$picture.">";
							?>
							Update profile picture
							<form action="" method="POST" enctype="multipart/form-data">
								<input type="file" name="profile"  style="width: 40%; padding: 5px 10px;">
								<input type="submit" name="update_profile_picture" value="Add">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>
<?php
include ('includes/guest_footer.html');
?>
