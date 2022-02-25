<?php require_once '../../../config.php'; ?>

<?php 
    $query = "SELECT * FROM items ORDER BY id DESC";
    $result = mysqli_query($con, $query);
    checkError($query);
?>

<?php include_once '../layout/header.php' ?>


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Items</h1>
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
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($item = mysqli_fetch_assoc( $result)): ?>
                                                <tr>
                                                	<td><?= $item['id']; ?></td>
                                                	<td><?= $item['name']; ?></td>
                                                	<td><?= $item['price']; ?></td>
                                                    <td>
                                                        <img style="width: 50px; height: 50px;" src="<?= ROOT . '/assets/items/' . $item['image']; ?>">
                                                    </td>
                                                    <td>
                                                        <a href="<?= ROOT ?>/dashboard/admin/items/edit.php?id=<?= $item['id'] ?>">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        &nbsp;
                                                        <a href="<?= ROOT ?>/dashboard/admin/items/delete.php?id=<?= $item['id'] ?>" class="text-danger">
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