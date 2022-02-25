<?php require_once '../../../../config.php'; ?>

<?php

    $id = $_GET['id'];
    $auctionItemID = $_GET['auctionItemID'];

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $auctionID = $_POST['auctionID'];
        $itemID = $_POST['itemID'];
        $startPrice = $_POST['startPrice'];
        $quantity = $_POST['quantity'];
        $orderNo = $_POST['orderNo'];

        $sql = "SELECT * FROM auction_items WHERE auctionID = '$auctionID' AND itemID = '$itemID' AND id != '$auctionItemID'";
        $result = mysqli_query($con, $sql);
        checkError($sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Item already belongs to this auction!')</script>";
        } else {
            $sql = "SELECT * FROM auction_items WHERE auctionID = '$auctionID' AND orderNo = '$orderNo' AND id != '$auctionItemID'";
            $result = mysqli_query($con, $sql);
            checkError($sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('An item will be auctioned at that time!')</script>";
            } else {
                $query = "UPDATE auction_items SET auctionID = '$auctionID', itemID = '$itemID', startPrice = '$startPrice', quantity = '$quantity', orderNo = '$orderNo' WHERE id = '$auctionItemID'";
                mysqli_query($con, $query);
                checkError($query);
                header('location: ' . ROOT . '/dashboard/admin/auctions/items/?id=' . $id);
            }
        }
    }

    $sql = "SELECT * FROM auction_items WHERE id = '$auctionItemID'";
    $result = mysqli_query($con, $sql);
    checkError($sql);
    $auctionItem = mysqli_fetch_assoc($result);

    $sql = "SELECT * FROM items";
    $items = mysqli_query($con, $sql);
    checkError($sql);
?>

<?php include_once '../../layout/header.php' ?>


<div class="container-fluid">
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow h-100 p-1">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-12">
                            <div class="font-weight-bold text-dark text-uppercase mb-2 text-center" >
                                Edit Item
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-12">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <form action="<?= ROOT ?>/dashboard/admin/auctions/items/edit.php?id=<?= $id ?>&auctionItemID=<?= $auctionItemID ?>" method="post" class="col-md-6 offset-md-3">
                                                <div class="form-group">
                                                    <label for="auctionID">Auction ID</label>
                                                    <input type="number" class="form-control" id="auctionID" name="auctionID" value="<?= $id ?>" readonly required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="itemID">Item</label>
                                                    <select name="itemID" id="itemID" class="custom-select" required>
                                                        <option selected>--SELECT ITEM--</option>
                                                        <?php while($item = mysqli_fetch_assoc($items)): ?>
                                                            <option <?= $item['id'] === $auctionItem['itemID'] ? 'selected' : '' ?> value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="startPrice">Start Price</label>
                                                    <input type="number" class="form-control" id="startPrice" name="startPrice" min="0" step="0.01" value="<?= $auctionItem['startPrice'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="number" class="form-control" id="quantity" name="quantity" min="0" value="<?= $auctionItem['quantity'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="orderNo">Order No.</label>
                                                    <input type="number" class="form-control" id="orderNo" name="orderNo" min="1" value="<?= $auctionItem['orderNo'] ?>" required>
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

<script>
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<?php include_once '../../layout/footer.php' ?>