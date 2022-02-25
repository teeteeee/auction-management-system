<?php require_once '../../../config.php'; ?>
<?php include_once '../layout/header.php' ?>

<?php 
	$query = "SELECT * FROM users WHERE role != 'admin'";
	$result = mysqli_query($con, $query);
 ?>


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow h-100 p-1">
            <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-12">
                            <div class="font-weight-bold text-dark text-uppercase mb-2">
                                Users List
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-12">
                                    <table id="dataTable" class="display">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Address</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($user = mysqli_fetch_assoc( $result)): ?>
                                                <tr>
                                                	<td><?= $user['id']; ?></td>
                                                	<td><?= $user['name']; ?></td>
                                                	<td><?= $user['email']; ?></td>
                                                	<td><?= $user['mobile']; ?></td>
                                                    <td><?= $user['address']; ?></td>
                                                	<td>
                                                        <a href="<?= ROOT ?>/dashboard/admin/users/edit.php?id=<?= $user['id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                                        &nbsp;
                                                        <a href="<?= ROOT ?>/dashboard/admin/users/delete.php?id=<?= $user['id'] ?>" class="text-danger"><i class="fas fa-trash"></i></a>
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

<?php include_once '../layout/footer.php' ?>