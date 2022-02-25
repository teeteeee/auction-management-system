<?php
	require_once '../config.php';

	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		
		$email = $_POST['email'];
		$password = $_POST['password'];

		$query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

		$result = mysqli_query($con, $query);

		checkError($query);

		if (mysqli_num_rows($result) === 1){
			$user = mysqli_fetch_assoc($result);

			if(password_verify($password, $user['password'])) {
				$_SESSION['id'] = $user['id'];

				header("location: " . ROOT . "/dashboard/" . $user['role'] . "/index.php");
				exit();
			}
		}

		echo '<script type="text/javascript">
            alert("Wrong Details");
        </script> ';
	}
?>

<?php include_once '../layout/header.php'; ?>

<div  class="contactbody">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="text-center">LOGIN</h1>
			</div>
		</div>
		<div class="row mt-5">
			<form action="<?= ROOT ?>/auth/login.php" method="post" class="col-md-6 offset-md-3">
				<div class="form-group">
					<label for="email"><i class="fas fa-envelope"></i> Email address</label>
					<input type="email" class="form-control" id="email" name="email" required>
				</div>
				<div class="form-group">
					<label for="password"><i class="fas fa-key"></i> Password</label>
					<input type="password" class="form-control" id="password" name="password" required>
				</div>
				<a href="<?= ROOT ?>/auth/forgot-password.php">Forgot password?</a>
				<div class="form-group text-center">
					<button type="submit" class="btn custom-button">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php include_once '../layout/footer.php'; ?>