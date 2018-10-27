<? php
include("./config/psql-config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

	header("location: welcome.php");
	//username and password sent from form

	$myusername = $_POST["username"];
	$mypassword = $_POST["password"];

	$query = "";

	$result = $db_trans -> prepare($query);
	$result -> execute();

	$row = pg_fetch_row($result);

	$active = $row['active'];

	$count = pg_num_rows($result);

	//If result matched $myusername and $mypassword, table row must be 1 row
	if($count == 1) {
		session_register("myusername");
		$_SESSION['login_user'] = $myusername;

		header("location: welcome.php");
	} else {
		$e = "Your login name or password is invalid";
	}
}
?>




    <title>Login</title>
	</head>

	<body>
		<?php include 'partials/nav.php'; ?>

		<div class="container">
			<div class="row">
				<? php echo $e ?>
			</div>
			<div class="row">
				<form action="login/login.php" method="post">
					<div class="col">
						<div class="form-group">
							<label for="login">Username</label>
							<input type="text" name="username" class="form-control" id="inputUsername">
							<label for="login">Password</label>
							<input type="text" name="password" class="form-control" id="inputPassword">
						</div>

						<button type="submit" class="btn btn-primary">Login</button>
					</div>
					</form>
			</div>
		</div>