<!doctype html>
<html lang="en">

<head>
	<title>LOGIN</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style2.css">

</head>

<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">

	<?php
  //session_start();
    // print_r($_SERVER);
    $conn = new mysqli('localhost', 'root', '', 'restaurant');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['user'];
        $pass = $_POST['password'];
        $sql = "SELECT id_kh FROM account WHERE taikhoan = '" . $name . "' AND password = '" . $pass . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['user'] = $row['id_kh'];
            }
        } 
        $conn->close();
       
			
    }
    echo "</pre>";

	$host = "localhost";
	$user = "root";
	$password = "";
	$db = "restaurant";
	
	$data = mysqli_connect($host, $user, $password, $db);
	if ($data === false) {
		die("Connection ERROR");
		}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = $_POST["username"];
		$password = $_POST["password"];
	
		// It seems like you're trying to check the usertype, but the query doesn't select it.
		// Assuming 'usertype' is a column in your 'account' table, you should include it in the query.
		$sql = "SELECT id_kh, usertype FROM account WHERE taikhoan = '" . $username . "' AND password = '" . $password . "'";
		$result = mysqli_query($data, $sql);
	
		if ($result) {
			$row = mysqli_fetch_array($result);
	
			if ($row["usertype"] == "user") {
				// Redirect the user to menu.php
				header('Location: menu.php');
				exit;
			} elseif ($row["usertype"] == "admin") {
				// Redirect the admin to admin.php
				header('Location: admin.php');
				exit;
			} else {
				// Handle the case where usertype is neither 'user' nor 'admin'
				echo "Unknown usertype";
			}
		} else {
			echo "Query failed";
		}

		$result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['user'] = $row['id_kh'];
            }
        } else {
            $_SESSION['user'] = '';
            //echo 'Sign up again !!!🙂🙂🙂';
        }
        $conn->close();
        if ($row["usertype"] == "user") {
			// Redirect the user to menu.php
			header('Location: menu.php');
			exit;
		} elseif ($row["usertype"] == "admin") {
			// Redirect the admin to admin.php
			header('Location: admin.php');
			exit;
		} else {
			// Handle the case where usertype is neither 'user' nor 'admin'
			echo "Unknown usertype";
		}
			
	}
   
	
	?>
	

   

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
						<h3 class="mb-4 text-center">Login</h3>
						<form action="login.php" method="post" class="signin-form">
							<div class="form-group">
								<input type="text" name="username" class="form-control" placeholder="Username" required>
							</div>
							<div class="form-group">
								<input id="password-field" type="password" name="password" class="form-control" placeholder="Password"
									required>
								<span toggle="#password-field"
									class="fa fa-fw fa-eye field-icon toggle-password"></span>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main2.js"></script>
	<script>//alert("ERROR. Sign in again 😂😂😂");</script>

</body>

</html>