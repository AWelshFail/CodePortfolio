<?php
require '../db/db_connection.php';
$error = '';
if (isset($_POST['signinbtn'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$stmt = $pdo->prepare("SELECT * FROM admin WHERE username=?");
	$stmt->execute([$username]);
	$user = $stmt->fetch();
	if ($user) {
	    // the username already exists
	    if ($password === $user['password'] && $user['account_status'] === 'active' ) {
	    	# code...
	    	session_start();
		    $_SESSION["id"] = $user['id'];
		    $_SESSION["username"] = $username;
		    header("Location: dashboard.php");
	    }
	    else{
	    	$error='Password Error';
	    }

	} else {
	    // the username does not exist
	    $error='User not found';
	}
}
include('guest_header.html');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sign in</title>
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
	</head>
	<body>
		<?php
		if ($error !== ''){
		echo "<div class='full-width' style='width: 100%;'><div class='' style='text-align: center;'>".$error."</div></div>";
		}
		?>
		<div class="full-width" style="width: 100%;">
			<div class="" style="text-align: center;">
				<h1 class="signin-text">
					Admin Sign In
				</h1>
				<form class="form" action="" method="POST">
					<div class="form-div">
						<input class="form-input" type="text" name="username" placeholder="Username" style="width: 20%;" required>
					</div>

					<div  class="form-div">
						<input class="form-input" type="password" name="password" placeholder="Password"  style="width: 20%; " required>
					</div>

					<div  class="form-div">
						<input class="form-input" type="submit" name="signinbtn" placeholder="Sign In" style="width: 10%;">
					</div>
				</form>
				
			</div>

		</div>
	</body>
</html>
<?php
include ('guest_footer.html');
?>
