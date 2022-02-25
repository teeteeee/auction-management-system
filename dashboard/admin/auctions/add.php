<?php require_once '../../../config.php'; ?>

<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $startTime = $_POST['startTime'];

        $sql = "SELECT * FROM auctions WHERE startTime = '$startTime'";
        $result = mysqli_query($con, $sql);
        checkError($sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('An auction already starts at that time');</script>";
        } else {
            $sql = "INSERT INTO auctions (startTime) VALUES ('$startTime')";
            mysqli_query($con, $sql);
            checkError($sql);
            header('location: ' . ROOT . '/dashboard/admin/auctions');
        }
    }

?>

<?php include_once '../layout/header.php' ?>


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">       
        <h1 class="h3 mb-2 text-gray-800 text-center">Add Auction</h1>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow h-100 p-1">
            <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-12">
                            <div class="font-weight-bold text-dark text-uppercase mb-1 text-center">
                                Add Auction
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-12">
                                    <div class="row mt-5">
                                        <form action="<?= ROOT ?>/dashboard/admin/auctions/add.php" method="post" class="col-md-6 offset-md-3">
                                            <div class="form-group">
                                                <label for="startTime">Start time</label>
                                                <input type="datetime-local" class="form-control" id="startTime" name="startTime" required>
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