<?php require_once '../../../config.php'; ?>

<?php
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $name = $_POST['name'];
        $price = $_POST['price'];

        $sql = "SELECT * FROM items WHERE name = '$name'";
        $result = mysqli_query($con, $sql);
        checkError($sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Item name already exists!')</script>";
        } else {

            $file = $_FILES['image'];
            
            $arr = explode('.', $file['name']);
            $ext = strtolower(end($arr));

            if($file['error'] == 0){
                if ($file['size'] < 1000000000) {
                    $filename = uniqid('', true) . "." . $ext;
                    $targetDir = PROJECT . '/assets/items/' . $filename;

                    if (move_uploaded_file($file['tmp_name'], $targetDir)) {
                        $query = "INSERT INTO items (name, price, image) VALUES ('$name', '$price', '$filename')";
                        mysqli_query($con, $query);
                        checkError($query);
                        header('location: ' . ROOT . '/dashboard/admin/items/');
                    } else {
                        echo "<script>alert('Failed to upload image')</script>";
                    }
                } else {
                  echo "<script>alert('Image is too large!')</script>";
                }
            } else {
                echo "<script>alert('No image uploaded!')</script>";
            }
        }
    }

?>

<?php include_once '../layout/header.php' ?>


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
                                            <form action="<?= ROOT ?>/dashboard/admin/items/add.php" method="post" class="col-md-6 offset-md-3" enctype = "multipart/form-data">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="price">Price</label>
                                                    <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" required>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" required>
                                                    <label class="custom-file-label" for="image">Choose image</label>
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

<?php include_once '../layout/footer.php' ?>