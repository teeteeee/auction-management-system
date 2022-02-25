<?php
	require_once '../config.php';

	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(isset($email)){
			$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";

			$result = mysqli_query($con, $query);

			if (mysqli_num_rows($result) === 1){
				$_SESSION['email'] = $email;
				header("location: " . ROOT . "/dashboard/custdash.php");
			} else {
				echo "wrong details";
			}	
		}	
	}
?>

<?php include_once '../layout/header.php'; ?>

<div class="contactbody">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="text-center">VERIFY EMAIL</h1>
			</div>
		</div>
		<div class="row mt-5 pb-5">
			<form action="<?= ROOT ?>/auth/login.php" method="post" class="col-md-6 offset-md-3">
            <div class="form-group">
					<label for="email"><i class="fas fa-envelope"></i> Email address</label>
					<input type="email" class="form-control" id="email" name="email" required>
				</div>
				<a href="<?= ROOT ?>/auth/login.php">Back to login</a>
				<div class="form-group text-center">
					<button type="submit" class="btn custom-button">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php include_once '../layout/footer.php'; ?>