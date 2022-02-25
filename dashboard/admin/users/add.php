<?php require_once '../../../config.php'; ?>

<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $sql);
        checkError($sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email address already exists');</script>";
        } else {
            $sql = "INSERT INTO users (name, email, mobile, address, password) VALUES ('$name', '$email', '$mobile', '$address', '$password')";
            mysqli_query($con, $sql);
            checkError($sql);
            header('location: ' . ROOT . '/dashboard/admin/users');
        }
    }

?>

<?php include_once '../layout/header.php' ?>


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">       
        <h1 class="h3 mb-2 text-gray-800 text-center">Add User</h1>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow h-100 p-1">
            <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-12">
                            <div class="font-weight-bold text-dark text-uppercase mb-1 text-center">
                                Add User
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-12">
                                    <div class="row mt-5">
                                        <form action="<?= ROOT ?>/dashboard/admin/users/add.php" method="post" class="col-md-6 offset-md-3">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="mobile">Mobile Number</label>
                                                <input type="text" class="form-control" id="mobile" name="mobile">
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address:</label>
                                                <textarea class="form-control" rows="5" id="address" name="address"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" required>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once '../layout/footer.php' ?>