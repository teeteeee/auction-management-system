<?php
    require_once '../../../config.php';

    $id = $_GET['id'];
    $sql = "DELETE FROM items WHERE id = '$id'";
    mysqli_query($con, $sql);
    checkError($sql);
    header('location: ' . ROOT . '/dashboard/admin/items');