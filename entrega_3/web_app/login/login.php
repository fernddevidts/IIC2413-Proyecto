<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!-- Bootstrap -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



    <!-- Stylesheet -->
    <link src="login.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,600|Lato:400,900" rel="stylesheet">



    <title>Login</title>
	</head>

	<body>
		<?php 
			ini_set('display_errors', 0);
			include '../partials/nav.php';
			include '../config/psql-config.php';
			session_start();
			$e = "";

			if($_SERVER["REQUEST_METHOD"] == "POST") {
				//username and password sent from form

				$myusername = $_POST["username"];
				$mypassword = $_POST["password"];

				$con = pg_connect("host=".HOST." dbname=".DATABASE_TRANS." user=".USER_TRANS." password=".PASSWORD_TRANS);

				$query = "SELECT id FROM Usuarios WHERE correo = '$myusername' AND clave='$mypassword'";

				$result = pg_query($con, $query);


				$row = pg_fetch_row($result);

				$active = $row['active'];

				$count = pg_num_rows($result);

				//If result matched $myusername and $mypassword, table row must be 1 row
				if($count == 1) {
					session_register("myusername");
					$_SESSION['username'] = $myusername;
					$_SESSION['id'] = $row[0];

					header("location: welcome.php");
				} else {
					$e = "Your login name or password is invalid";
				}
			}
			echo "<div class='container'><div class='row'>$e</div></div>"
			?>
			<div class='container'>
				<div class='row'>
					<form  method='post'>
						<div class='col'>
							<div class='form-group'>
								<label for='login'>Username</label>
								<input type='text' name='username' class='form-control' id='inputUsername'>
								<label for='login'>Password</label>
								<input type='text' name='password' class='form-control' id='inputPassword'>
							</div>
							<button type='submit' class='btn btn-primary'>Login</button>
						</div>
					</form>
				</div>
			</div>

</body>
</html>