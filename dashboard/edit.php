<?php
	require_once '../config.php';

	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		$id = $_SESSION['id'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$address = $_POST['address'];

		$query = "UPDATE users SET name = '$name', email = '$email', mobile = '$mobile', address = '$address' WHERE id = '$id'";

		$result = mysqli_query($con, $query) or die(mysqli_error($con));

		header("location: " . ROOT . "/dashboard/profile.php");                   
        echo '<script type="text/javascript">
            alert("Successfully Updated");
        </script> ';
	}
?>


<?php include_once '../layout/header.php' ?>

<div class="col-12">
    <div class="dash-pro-item mb-30 mt-50 dashboard-widget">
        <div class="header">
            <h4 class="title">Personal Details</h4>
        </div>
        <div class="row mt-5">
			<form action="<?= ROOT ?>/dashboard/edit.php" method="post" class="col-md-6 offset-md-3">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>" required>
				</div>
				<div class="form-group">
					<label for="email"></i> Email address</label>
					<input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
				</div>
				<div class="form-group">
					<label for="mobile">Phone Number</label>
					<input type="tel" class="form-control" id="mobile" name="mobile" value="<?= $user['mobile'] ?>" required>
				</div>
				<div class="form-group">
					<label for="address">Address</label>
					<input type="text" class="form-control" id="address" name="address" value="<?= $user['address'] ?>" required>
				</div>
				<div class="form-group text-center">
					<button type="submit" class="btn custom-button">Submit</button>
				</div>
			</form>
		</div>
    </div>
</div>



<?php include_once '../layout/footer.php'; ?>
