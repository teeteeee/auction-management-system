<?php require_once './config.php'; ?>

<?php 
	
	if (!isset($auth) || !isset($_SESSION['id'])) {
		header('location: ' . ROOT . '/auth/login.php');
		exit();
	}

	$id = $_GET['id'];
//biding section
	$sql = "SELECT *, AI.id AS auctionItemID FROM auctions A JOIN auction_items AI ON A.id = AI.auctionID JOIN items I ON AI.itemID = I.id WHERE AI.id = $id";
	$result = mysqli_query($con, $sql);
	checkError($sql);
	$auctionItem = mysqli_fetch_assoc($result);

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$amount = $_POST['amount'];
		$userID = $auth['id'];

		$sql = "SELECT * FROM bids WHERE auctionItemID = '$id' GROUP BY auctionItemID HAVING MAX(amount) ";
		$result = mysqli_query($con, $sql);
		checkError($sql);

		if (mysqli_num_rows($result) > 0) {
			$bid = mysqli_fetch_assoc($result);
			if (floatval($bid['amount']) >= floatval($amount)) {
				$_SESSION['error'] = "Your bid was not above the highest bid";
				header('location: ' . ROOT . '/bid.php?id=' . $id);
				exit();
			}
		}

		if ($auctionItem['startPrice'] > $amount) {
			$_SESSION['error'] = "Bid cannot be less than starting price";
			header('location: ' . ROOT . '/bid.php?id=' . $id);
			exit();
		}

		$sql = "INSERT INTO bids (auctionItemID, userID, amount) VALUES ('$id', '$userID', '$amount') ON DUPLICATE KEY UPDATE amount = '$amount'";
		$result = mysqli_query($con, $sql);
		checkError($sql);

		$_SESSION['true'] = true;
		header('location: ' . ROOT . '/bid.php?id=' . $id);
		exit();
	}

	$success = null;
	if (isset($_SESSION['success'])) {
		$success = "Your bid was placed successfully";
		unset($_SESSION['success']);
	}

	$error = null;
	if (isset($_SESSION['error'])) {
		$error = $_SESSION['error'];
		unset($_SESSION['error']);
	}
//checking the auction value
	$sql = "SELECT * FROM bids WHERE auctionItemID = '$id' GROUP BY auctionItemID HAVING MAX(amount) ";
	$result = mysqli_query($con, $sql);
	checkError($sql);
	$highestBidAmount = 0;
	
	if (mysqli_num_rows($result) > 0) {
		$highestBidAmount = mysqli_fetch_assoc($result)['amount'];
	}
//timing for the auction 
	$sql = "SELECT *, AI.id AS auctionItemID FROM auctions A JOIN auction_items AI ON A.id = AI.auctionID JOIN items I ON AI.itemID = I.id WHERE AI.id = $id";
	$result = mysqli_query($con, $sql);
	checkError($sql);
	$auctionItem = mysqli_fetch_assoc($result);

	$isLive = isLive($auctionItem['startTime'], $auctionItem['orderNo']);
	$isUpcoming = isUpcoming($auctionItem['startTime'], $auctionItem['orderNo']);

	function formatDate($auctionItem, $diff = 0) {
		return date('l jS \of F Y h:i:s A', (strtotime($auctionItem['startTime']) + (10 * 60 * ($auctionItem['orderNo'] - $diff))));
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

	function isLive($time, $order) {
		$time = strtotime($time);
		$now = strtotime("now");

		return $now <= ($time + (intval($order) * (10 * 60))) && $now >= ($time + ((intval($order) - 1) * (10 * 60)));
	}

	function isUpcoming($time, $order) {
		$time = strtotime($time);
		$now = strtotime("now");

		return $now < ($time + ((intval($order) - 1) * (10 * 60)));
	}

	function isCompleted($time, $order) {
		$time = strtotime($time);
		$now = strtotime("now");

		return $now > ($time + (intval($order) * (10 * 60)));
	}

 ?>

 <?php include_once './layout/header.php' ?>

 <section class="auction-section padding-bottom padding-top" id="sectionlive">
	<div class="container">
		<div class="row justify-content-center mt-3 mb-30-none">
			<?php if(isset($success)): ?>
				<div class="alert alert-success col-12 text-center"><?= $success ?>!</div>
			<?php endif; ?>
			<?php if(isset($error)): ?>
				<div class="alert alert-danger col-12 text-center"><?= $error ?>!</div>
			<?php endif; ?>
			<div class="col-md-6 col-lg-4">
				<div class="auction-item-2">
					<div class="auction-thumb">
						<a href="#">
							<img src="<?= ROOT ?>/assets/items/<?= $auctionItem['image'] ?>" style="width: 100%; height: 250px;"/>
						</a>
					</div>                    
					<div class="auction-content">
						<h6 class="title">
							<a href="#"><?= $auctionItem['name']; ?></a>
						</h6>
						<div class="bid-area">
							<div class="bid-amount">
								<div class="icon">
									<i class="flaticon-auction"></i>
								</div>
								<div class="amount-content">
									<div class="current">Current Bid</div>
									<div class="amount">$<?= number_format($highestBidAmount); ?></div>
								</div>
							</div>
							<div class="bid-amount">
								<div class="icon">
									<i class="flaticon-money"></i>
								</div>
								<div class="amount-content">
									<div class="current">Starting Price</div>
									<div class="amount">$<?= $auctionItem['startPrice']; ?></div>
								</div>
							</div>
						</div>
						<div class="countdown-area">
							<div class="countdown" id="timer">
								<div class="amount"><?= formatDate($auctionItem, 1); ?></div>
								<?php if ($isLive): ?>
									<div id="bid_counter20">
										Bid ends in: <span id="minutes-<?= $auctionItem['auctionItemID']; ?>"></span>
										m: <span id="seconds-<?= $auctionItem['auctionItemID']; ?>"></span>s 
									</div>
								<?php endif; ?>	
								<?php if ($isUpcoming): ?>
									<div id="bid_counter20">
										Bid starts in: <span id="days-<?= $auctionItem['auctionItemID']; ?>"></span>
										d : <span id="hours-<?= $auctionItem['auctionItemID']; ?>"></span>
										h : <span id="minutes-<?= $auctionItem['auctionItemID']; ?>"></span>
										m: <span id="seconds-<?= $auctionItem['auctionItemID']; ?>"></span>s 
									</div>
								<?php endif; ?> 
							</div>                            
						</div>
						<?php if ($isLive): ?>
							<form action="<?= ROOT ?>/bid.php?id=<?= $id ?>" method="post" class="col-md-6 offset-md-3">
							    <div class="form-group">
							    	<h6 class="title">
							        <label for="amount">Enter Your Bid</label>
							        </h6>
							        <input type="number" class="form-control" id="amount" name="amount" min="0" step="0.01" required>
							    </div>
							    <div class="text-center">
									<button type="submit" class="custom-button">Submit Bid</a>
								</div>
							</form>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php if ($isLive): ?>
				<?php liveCountDownTimer($auctionItem); ?>
			<?php endif; ?>
			<?php if ($isUpcoming): ?>
				<?php countDownTimer($auctionItem); ?>
			<?php endif; ?>
		</div>
	</div>
</section>


<?php include_once './layout/footer.php'; ?>
