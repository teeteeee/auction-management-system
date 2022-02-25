<?php
	require_once '../../../config.php';

	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		$password = $_POST['password'];
		$confirmPassword = $_POST['confirmPassword'];
		$id = $_SESSION['id'];

		if ($password === $confirmPassword){
			$password = password_hash($password, PASSWORD_DEFAULT);
			$query = "UPDATE users SET password = '$password' WHERE id = '$id'"; 

			$result = mysqli_query($con, $query) or die(mysqli_error($con));
		}

		
		

		header("location: " . ROOT . "/dashboard/user/profile/index.php");                   
        echo '<script type="text/javascript">
            alert("Successfully Updated");
        </script> ';
	}
?>


<?php include_once '../../../layout/header.php' ?>

<div class="col-12">
    <div class="dash-pro-item mb-30 mt-50 dashboard-widget">
        <div class="header">
            <h4 class="title">Security</h4>
        </div>
        <div class="row mt-5">
			<form action="<?= ROOT ?>/dashboard/user/profile/change-password.php" method="post" class="col-md-6 offset-md-3">
				<div class="form-group">
					<label for="password"> Password</label>
					<input type="password" class="form-control" id="password" name="password" required>
				</div>
				<div class="form-group">
					<label for="confirmPassword">Confirm Password</label>
					<input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
				</div>
				<div class="form-group text-center">
					<button type="submit" class="btn custom-button">Submit</button>
				</div>
			</form>
		</div>
    </div>
</div>



<?php include_once '../../../layout/footer.php'; ?>
