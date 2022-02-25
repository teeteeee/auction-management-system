<?php require_once '../../../config.php'; ?>

<?php

    $id = $_GET['id'];

    $sql = "SELECT * FROM items WHERE id = '$id'";
    $result = mysqli_query($con, $sql);
    checkError($sql);
    $item = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $name = $_POST['name'];
        $price = $_POST['price'];

        $sql = "SELECT * FROM items WHERE name = '$name' AND id != '$id'";
        $result = mysqli_query($con, $sql);
        checkError($sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Item name already exists!')</script>";
        } else {
            $filename = $item['image'];
            $file = $_FILES['image'];

            if (!!$file['name']) {
                $arr = explode('.', $file['name']);
                $ext = strtolower(end($arr));

                if($file['error'] == 0){
                    if ($file['size'] < 1000000000) {
                        $filename = uniqid('', true) . "." . $ext;
                        $targetDir = PROJECT . '/assets/items/' . $filename;

                        if (!move_uploaded_file($file['tmp_name'], $targetDir)) {
                            echo "<script>alert('Failed to upload image')</script>";
                        }
                    } else {
                        echo "<script>alert('Image is too large!')</script>";
                    }
                } else {
                    echo "<script>alert('No image uploaded!')</script>";
                }
            }


            $query = "UPDATE items SET name = '$name', price = '$price', image = '$filename' WHERE id = '$id'";
            mysqli_query($con, $query);
            checkError($query);
            header('location: ' . ROOT . '/dashboard/admin/items/');
        } 
    }
?>

<?php include_once '../layout/header.php' ?>


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
                                            <form action="<?= ROOT ?>/dashboard/admin/items/edit.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="<?= $item['name'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="price">Price</label>
                                                    <input type="number" class="form-control" id="price" name="price" value="<?= $item['price'] ?>"  required>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
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

<script>
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<?php include_once '../layout/footer.php' ?>