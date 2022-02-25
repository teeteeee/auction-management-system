<?php
    require_once '../../../../config.php';

    $id = $_GET['id'];
    $auctionItemID = $_GET['auctionItemID'];
    $sql = "DELETE FROM auction_items WHERE id = '$auctionItemID'";
    mysqli_query($con, $sql);
    checkError($sql);
    header('location: ' . ROOT . '/dashboard/admin/auctions/items?id=' . $id);