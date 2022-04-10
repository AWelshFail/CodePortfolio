<?php
require 'db/db_connection.php';

$error='';
if (isset($_POST['signupbtn'])){
	if (isset($_POST['surname'])){
		$vals = array(
		   ':surname'    => $_POST['surname'],
		   ':firstname' => $_POST['firstname'],
		   ':email'    => $_POST['email'],
		   ':username'    => $_POST['username'],
		   ':password'    => $_POST['password']
		);
		$username = $_POST['username'];
		$stmt = $pdo->prepare("SELECT * FROM tradesmen WHERE username=?");
		$stmt->execute([$username]);
		$user = $stmt->fetch();
		if (!$user) {
			$username = $_POST['username'];
			$stmt = $pdo->prepare("SELECT * FROM tradesmen WHERE username=?");
			$stmt->execute([$username]);
			$user = $stmt->fetch();
			if (!$user) {
				$sql = "INSERT INTO tradesmen (surname, firstname, username, email, password) VALUES (:surname,:firstname,:username,:email,:password)";
				$q = $pdo->prepare($sql);
				$q->execute($vals);
				header("Location: signin.php");
			}else{
				$error= 'Email Already Exists';
			}
		}else{
			$error='Email Already Exists';
		}
	}
}
include('includes/guest_header.html');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sign Up</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<?php
		if ($error !== ''){
		echo "<div class='full-width' style='width: 100%;'>
			<div class='' style='text-align: center;'>
				".$error."
			</div>
		</div>";
		}
		?>
		<div class="row" style="width: 100%;">
			<div class="signUpCol" style="width: 50%;">
				<h1 class="">
					Sign Up
				</h1>
				<form class="form" action="" method="POST">
					<div class="form-div">
						<input class="form-input" type="text" name="surname" placeholder="Surname" required>
					</div>

					<div  class="form-div">
						<input class="form-input" type="text" name="firstname" placeholder="Firstname" required>
					</div>

					<div  class="form-div">
						<input class="form-input" type="text" name="username" placeholder="Username" required>
					</div>

					<div  class="form-div">
						<input class="form-input" type="text" name="phonenumber" placeholder="Phone Number">
					</div>

					<div  class="form-div">
						<input class="form-input" type="email" name="email" placeholder="Email Address" required>
					</div>

					<div  class="form-div">
						<input class="form-input" type="password" name="password" placeholder="Password" required>
					</div>

					<!--<div  class="form-div">
						<input class="form-input" type="password" name="confirmpassword" placeholder="Confirm Password">
					</div>-->

					<div  class="form-div">
						<input class="form-input" type="submit" name="signupbtn" placeholder="Sign Up">
					</div>
				</form>
				<div>
					Already have an account? <a href="signin.php">Sign in</a>
				</div>
			</div>

			<div class="" style="height: 100vh; width: 50%; background-color: #00A2BF; background-size: cover;"><img src="img/siteImages/vanMan.jpg" alt="Tradesman outside van" style="padding-top: 100px;"></div>

		</div>
	</body>
</html>
<?php
include ('includes/guest_footer.html');
?>
