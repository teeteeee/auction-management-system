<?php
	require_once '../config.php';

	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$address = $_POST['address'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

		$query = "INSERT INTO users (email, password, name, mobile, address) VALUES ('$email', '$password', '$name' , '$mobile', '$address')";

		mysqli_query($con, $query);

		checkError($query);

		$_SESSION['id'] = mysqli_insert_id($con);

		header("location: " . ROOT . "/index.php");
	}
?>

<?php include_once '../layout/header.php'; ?>

<div  class="contactbody">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="text-center">REGISTER</h1>
			</div>
		</div>
		<div class="row mt-5">
			<form action="<?= ROOT ?>/auth/register.php" method="post" class="col-md-6 offset-md-3">
				<div class="form-group">
					<label for="name"><i class="fas fa-user-alt"></i> Name</label>
					<input type="text" class="form-control" id="name" name="name" required>
				</div>
				<div class="form-group">
					<label for="email"><i class="fas fa-envelope"></i> Email address</label>
					<input type="email" class="form-control" id="email" name="email" required>
				</div>
				<div class="form-group">
					<label for="mobile"><i class="fas fa-phone"></i> Phone Number</label>
					<input type="tel" class="form-control" id="mobile" name="mobile" required>
				</div>
				<div class="form-group">
					<label for="address"><i class="fas fa-home"></i> Address</label>
					<input type="text" class="form-control" id="address" name="address" required>
				</div>
				<div class="form-group">
					<label for="password"><i class="fas fa-key"></i> Password</label>
					<input type="password" class="form-control" id="password" name="password" required>
				</div>
				<a href="<?= ROOT ?>/auth/login.php">Already a member?</a>
				<div class="form-group text-center">
					<button type="submit" class="btn custom-button">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php include_once '../layout/footer.php'; ?>