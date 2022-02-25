<?php require_once '../../../../config.php'; ?>

<?php 
    $id = $_GET['id'];
    $query = "SELECT *, A.id AS auction_items_id FROM items I JOIN auction_items A ON I.id = A.itemID WHERE A.auctionID = '$id' ORDER BY A.orderNo ASC";
    $result = mysqli_query($con, $query);
    checkError($query);
?>

<?php include_once '../../layout/header.php' ?>


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Auction Items</h1>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow h-100 p-1">
            <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-12">
                            <div class="font-weight-bold text-dark text-uppercase mb-2">
                                Items List
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-12">
                                    <table id="dataTable" class="display">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Auction ID</th>
                                                <th>Item</th>
                                                <th>Start Price</th>
                                                <th>Quantity</th>
                                                <th>Order</th>
                                                <th>Image</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($item = mysqli_fetch_assoc($result)): ?>
                                                <tr>
                                                	<td><?= $item['auction_items_id']; ?></td>
                                                	<td><?= $item['auctionID']; ?></td>
                                                    <td><?= $item['name']; ?></td>
                                                	<td><?= $item['startPrice']; ?></td>
                                                	<td><?= $item['quantity']; ?></td>
                                                    <td><?= $item['orderNo']; ?></td>
                                                    <td>
                                                        <img style="width: 50px; height: 50px;" src="<?= ROOT . '/assets/items/' . $item['image']; ?>">
                                                    </td>
                                                    <td>
                                                        <a href="<?= ROOT ?>/dashboard/admin/auctions/items/edit.php?id=<?= $id ?>&auctionItemID=<?= $item['auction_items_id'] ?>">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        &nbsp;
                                                        <a href="<?= ROOT ?>/dashboard/admin/auctions/items/delete.php?id=<?= $id ?>&auctionItemID=<?= $item['auction_items_id'] ?>" class="text-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
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