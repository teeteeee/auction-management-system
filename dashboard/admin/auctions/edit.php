<?php require_once '../../../config.php'; ?>

<?php

    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $startTime = $_POST['startTime'];
        $status = $_POST['status'];

        $sql = "SELECT * FROM auctions WHERE startTime = '$startTime' AND id != '$id'";
        $result = mysqli_query($con, $sql);
        checkError($sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('An auction already starts at this time!');</script>";
        } else {
            $sql = "UPDATE auctions SET startTime = '$startTime', status = '$status' WHERE id = '$id'";
            mysqli_query($con, $sql);
            checkError($sql);
            header('location: ' . ROOT . '/dashboard/admin/auctions');
        }
    }

    $sql = "SELECT * FROM auctions WHERE id = '$id'";
    $result = mysqli_query($con, $sql);
    checkError($sql);
    $auction = mysqli_fetch_assoc($result);

?>

<?php include_once '../layout/header.php' ?>


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        
        <h1 class="h3 mb-2 text-gray-800 text-center">Edit Auction</h1>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow h-100 p-1">
            <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-12">
                            <div class="font-weight-bold text-dark text-uppercase mb-1 text-center">
                                Edit Auctions
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-12">
                                    <div class="row mt-5">
                                        <form action="<?= ROOT ?>/dashboard/admin/auctions/edit.php?id=<?= $id ?>" method="post" class="col-md-6 offset-md-3">
                                            <div class="form-group">
                                                <label for="startTime">Start time</label>
                                                <input type="datetime-local" class="form-control" id="startTime" name="startTime" value="<?= date('Y-m-d\TH:i:s', $auction['start_time']) ?>" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select name="status" id="status" class="custom-select" required>
                                                        <option <?= $auction['status'] === 'open' ? 'selected' : '' ?>>Open</option>
                                                        <option <?= $auction['status'] === 'closed' ? 'selected' : '' ?>>Closed</option>
                                                    </select>
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