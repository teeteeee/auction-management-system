<?php require_once '../../../../config.php'; ?>

<?php
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $auctionID = $_POST['auctionID'];
        $itemID = $_POST['itemID'];
        $startPrice = $_POST['startPrice'];
        $quantity = $_POST['quantity'];
        $orderNo = $_POST['orderNo'];

        $sql = "SELECT * FROM auction_items WHERE auctionID = '$auctionID' AND itemID = '$itemID'";
        $result = mysqli_query($con, $sql);
        checkError($sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Item already belongs to this auction!')</script>";
        } else {
            $sql = "SELECT * FROM auction_items WHERE auctionID = '$auctionID' AND orderNo = '$orderNo'";
            $result = mysqli_query($con, $sql);
            checkError($sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('An item will be auctioned at that time!')</script>";
            } else {
                $query = "INSERT INTO auction_items (auctionID, itemID, startPrice, quantity, orderNo) VALUES ('$auctionID', '$itemID', '$startPrice', '$quantity', '$orderNo')";
                mysqli_query($con, $query);
                checkError($query);
                header('location: ' . ROOT . '/dashboard/admin/auctions/items/?id=' . $id);
            }
        }
    }

    $sql = "SELECT * FROM items";
    $items = mysqli_query($con, $sql);
    checkError($sql);

?>

<?php include_once '../../layout/header.php' ?>


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        
        <h1 class="h3 mb-2 text-gray-800 text-center">Add Item</h1>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow h-100 p-1">
            <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-12">
                            <div class="font-weight-bold text-dark text-uppercase mb-1 text-center">Add Item</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-12">
                                    <div class="row mt-5">
                                            <form action="<?= ROOT ?>/dashboard/admin/auctions/items/add.php?id=<?= $id ?>" method="post" class="col-md-6 offset-md-3">
                                                <div class="form-group">
                                                    <label for="auctionID">Auction ID</label>
                                                    <input type="number" class="form-control" id="auctionID" name="auctionID" value="<?= $id ?>" readonly required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="itemID">Item</label>
                                                    <select name="itemID" id="itemID" class="custom-select" required>
                                                        <option selected>--SELECT ITEM--</option>
                                                        <?php while($item = mysqli_fetch_assoc($items)): ?>
                                                            <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="startPrice">Start Price</label>
                                                    <input type="number" class="form-control" id="startPrice" name="startPrice" min="0" step="0.01" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="number" class="form-control" id="quantity" name="quantity" min="0" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="orderNo">Order No.</label>
                                                    <input type="number" class="form-control" id="orderNo" name="orderNo" min="1" required>
                                                </div>
                                                <div class="form-group text-center mt-3">
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
</div>

<?php include_once '../../layout/footer.php' ?>