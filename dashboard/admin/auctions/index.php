<?php require_once '../../../config.php'; ?>

<?php 
    $query = "SELECT A.id AS auction_id, status, A.startTime AS start_time, COUNT(I.id) AS items
     FROM auctions A LEFT JOIN auction_items I ON A.id = I.auctionID GROUP BY A.id ORDER BY A.startTime ASC ";
    $result = mysqli_query($con, $query);
    checkError($query);
?>

<?php include_once '../layout/header.php' ?>


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Auctions</h1>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow h-100 p-1">
            <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-12">
                            <div class="font-weight-bold text-dark text-uppercase mb-2">
                                Auctions List
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-12">
                                    <table id="dataTable" class="display">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Start Time</th>
                                                <th>Items</th>
                                                <th>Status</th>
                                                <th colspan="2" class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($auction = mysqli_fetch_assoc($result)): ?>
                                                <tr>
                                                    <td><?= $auction['auction_id']; ?></td>
                                                    <td><?= $auction['start_time']; ?></td>
                                                    <td><?= $auction['items']; ?></td>
                                                    <td><?= $auction['status']; ?></td>
                                                    <td class="text-center">
                                                        <a href="<?= ROOT ?>/dashboard/admin/auctions/items?id=<?= $auction['auction_id'] ?>">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        &nbsp;
                                                        <a href="<?= ROOT ?>/dashboard/admin/auctions/items/add.php?id=<?= $auction['auction_id'] ?>">
                                                            <i class="fas fa-plus"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">                                                                              
                                                        <a href="<?= ROOT ?>/dashboard/admin/auctions/edit.php?id=<?= $auction['auction_id'] ?>">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        &nbsp;
                                                        <a href="<?= ROOT ?>/dashboard/admin/auctions/delete.php?id=<?= $auction['auction_id'] ?>" class="text-danger">
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

<?php include_once '../layout/footer.php' ?>