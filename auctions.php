<?php require_once './config.php'; ?>
<?php include_once './layout/header.php' ?>
<?php 
    $sql = "SELECT *, AI.id AS auctionItemID FROM auctions A JOIN auction_items AI ON A.id = AI.auctionID JOIN items I ON AI.itemID = I.id WHERE NOW() <= A.startTime ORDER BY A.startTime ASC, orderNo ASC";
    $upcomingAuctions = mysqli_query($con, $sql);
    checkError($sql);

    $sql = "SELECT *, AI.id AS auctionItemID FROM auctions A JOIN auction_items AI ON A.id = AI.auctionID JOIN items I ON AI.itemID = I.id WHERE NOW() BETWEEN DATE_ADD(A.startTime, INTERVAL ((AI.orderNo - 1) * 10) MINUTE) AND DATE_ADD(A.startTime, INTERVAL (AI.orderNo * 10) MINUTE) ORDER BY A.startTime ASC, orderNo ASC";
    $liveAuctions = mysqli_query($con, $sql);
    checkError($sql);

    $sql = "SELECT *, AI.id AS auctionItemID FROM auctions A JOIN auction_items AI ON A.id = AI.auctionID JOIN items I ON AI.itemID = I.id WHERE NOW() > A.startTime AND (NOW() NOT BETWEEN DATE_ADD(A.startTime, INTERVAL ((AI.orderNo - 1) * 10) MINUTE) AND DATE_ADD(A.startTime, INTERVAL (AI.orderNo * 10) MINUTE)) ORDER BY A.startTime DESC, orderNo ASC ";
    $completedAuctions = mysqli_query($con, $sql);
    checkError($sql);

    function formatDate($rows, $diff = 0) {
        return date('l jS \of F Y h:i:s A', (strtotime($rows['startTime']) + (10 * 60 * ($rows['orderNo'] - $diff))));
    }

    function countDownTimer($auctionItem) {
        $startTime = $auctionItem["startTime"];
        $id = $auctionItem["auctionItemID"];
        $order = $auctionItem['orderNo'];

        echo '
            <script>
                const interval' . $id . ' = setInterval(function() {
                  const countDownDate = new Date("' . $startTime . '").getTime();
                  const now = new Date().getTime();
                  const order = ' . $order . '
                  const startTime = countDownDate + (10 * 60 * (order - 1) * 1000);
                  const distance = startTime - now;

                  const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                  const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                  const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                  const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                  document.getElementById("days-' . $id . '").innerHTML = days;
                  document.getElementById("hours-' . $id . '").innerHTML = hours;
                  document.getElementById("minutes-' . $id . '").innerHTML = minutes;
                  document.getElementById("seconds-' . $id . '").innerHTML = seconds;

                  if(days <= 0 && hours <= 0 && minutes <= 0 && seconds <= 0) {
                    clearInterval(interval' . $id . ');
                  }
                }, 1000);
            </script>
        ';
    }

    function liveCountDownTimer($auctionItem) {
        $startTime = $auctionItem["startTime"];
        $id = $auctionItem["auctionItemID"];
        $order = $auctionItem['orderNo'];

        echo '
            <script>
                let order = ' . $order . ';
                const countDownDate' . $id . ' = new Date("' . $startTime . '").getTime() + (10 * 60 * (order - 1) * 1000) + (10 * 60 * 1000);
                const interval' . $id . ' = setInterval(function() {
                  const now = new Date().getTime();
                  const distance = countDownDate' . $id . ' - now;

                  const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                  const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                  document.getElementById("minutes-' . $id . '").innerHTML = minutes;
                  document.getElementById("seconds-' . $id . '").innerHTML = seconds;

                  if(minutes <= 0 && seconds <= 0) {
                    clearInterval(interval' . $id . ');
                  }
                }, 1000);
            </script>
        ';
    }
 ?>

<!--============= Upcoming Auction Section Starts Here =============-->
<section class="auction-section padding-bottom padding-top mt-5" id="sectionUpcoming">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h2>Upcoming Auction</h2>
                    <p><a href="./index.php" class="normal-button">Back</a></p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-3 mb-30-none">
            <?php while ($rows = mysqli_fetch_assoc($upcomingAuctions)): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="auction-item-2">
                        <div class="auction-thumb">
                            <a href="#">
                                <img src="<?= ROOT ?>/assets/items/<?= $rows['image'] ?>" style="width: 100%; height: 250px;"/>
                            </a>
                        </div>                    
                        <div class="auction-content">
                            <h6 class="title">
                                <a href="#"><?= $rows['name']; ?></a>
                            </h6>
                            <div class="bid-area">
                                <div class="bid-amount">
                                    <div class="icon">
                                        <i class="flaticon-auction"></i>
                                    </div>
                                    <div class="amount-content">
                                        <div class="current">Current Bid</div>
                                        <div class="amount">$<?= $rows['startPrice']; ?></div>
                                    </div>
                                </div>
                                <div class="bid-amount">
                                    <div class="icon">
                                        <i class="flaticon-money"></i>
                                    </div>
                                    <div class="amount-content">
                                        <div class="current">Starting Price</div>
                                        <div class="amount">$<?= $rows['startPrice']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <!--<div id="bid_counter20">Auction Starts in: 0d : 7h : 54m : 34s</div>-->
                            <div class="countdown-area">
                                <div class="countdown" id="timer">
                                    <div class="amount"><?= formatDate($rows, 1); ?></div>

                                    <div id="bid_counter20">
                                        Bid starts in: <span id="days-<?= $rows['auctionItemID']; ?>"></span>
                                        d : <span id="hours-<?= $rows['auctionItemID']; ?>"></span>
                                        h : <span id="minutes-<?= $rows['auctionItemID']; ?>"></span>
                                        m: <span id="seconds-<?= $rows['auctionItemID']; ?>"></span>s 
                                    </div>                                  
                                </div>                            
                            </div>
                            <div class="text-center">
                                <a href="./bid.php?id=<?= $rows['auctionItemID']; ?>" class="custom-button">View auction item</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php countDownTimer($rows); ?>
            <?php endwhile; ?>           
        </div>
        
    </div>
</section>


<!--============= Completed Auction Section Starts Here =============-->
<section class="auction-section padding-bottom padding-top mt-5" id="sectionUpcoming">
    <div class="container">
    <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h2>Completed Auctions</h2>
                    <p>
                        <a href="./auctions.php" class="normal-button">View All</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-3 mb-30-none">
            <?php while ($rows = mysqli_fetch_assoc($completedAuctions)): ?>
                <?php $id = $rows['id'];

    $sql = "SELECT * FROM bids WHERE auctionItemID = '$id' GROUP BY auctionItemID HAVING MAX(amount) ";
    $result = mysqli_query($con, $sql);
    checkError($sql);
    $highestBidAmount = 0;
    
    if (mysqli_num_rows($result) > 0) {
        $highestBidAmount = mysqli_fetch_assoc($result)['amount'];
    }
 ?>
                <div class="col-md-6 col-lg-4">
                    <div class="auction-item-2">
                        <div class="auction-thumb">
                            <a href="#">
                                <img src="<?= ROOT ?>/assets/items/<?= $rows['image'] ?>" style="width: 100%; height: 250px;"/>
                            </a>
                        </div>                    
                        <div class="auction-content">
                            <h6 class="title">
                                <a href="#"><?= $rows['name']; ?></a>
                            </h6>
                            <div class="bid-area">
                                <div class="bid-amount">
                                    <div class="icon">
                                        <i class="flaticon-auction"></i>
                                    </div>
                                    <div class="amount-content">
                                        <div class="current">Winning Price</div>
                                        <div class="amount">$<?= number_format($highestBidAmount); ?></div>
                                    </div>
                                </div>
                                <div class="bid-amount">
                                    <div class="icon">
                                        <i class="flaticon-money"></i>
                                    </div>
                                    <div class="amount-content">
                                        <div class="current">Starting Price</div>
                                        <div class="amount">$<?= $rows['startPrice']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <!--<div id="bid_counter20">Auction Starts in: 0d : 7h : 54m : 34s</div>-->
                            <div class="countdown-area">
                                <div class="countdown" id="timer">
                                    <div class="amount"><?= formatDate($rows); ?></div>
                                </div>                            
                            </div>
                            <div class="text-center">
                                <a href="./bid.php?id=<?= $rows['auctionItemID']; ?>" class="custom-button">View auction item</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>           
        </div>
        
    </div>
</section>
<!--============= Completed Auction Section Ends Here =============-->
