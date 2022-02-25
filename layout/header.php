
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale =1.0">

	<title>Auction Management System</title>

	<link rel="icon" type="<?= ROOT ?>/assets/landing/images/icon.png" href="index.php">
	<link rel="shortcut icon" href="<?= ROOT ?>/assets/landing/images/icon.png" type="image/x-icon">

	<link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <link rel="stylesheet" href="<?= ROOT ?>/assets/landing/css/jquery-ui.min.css">
	<link rel="stylesheet" href="<?= ROOT ?>/assets/landing/css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body style="width: 100%">
	<header class="header">		
		<nav class="navbar navbar-expand-lg navbar-light">
			<div class="logo">
				<a class="navbar-brand text-light" href="<?= ROOT ?>/index.php">
				 <span>ONLINE </span> AUCTION
				</a>
			</div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">	
				<ul class="navbar-nav mr-auto ml-md-5">
					<li class="nav-item">
						<a href="<?= ROOT ?>/index.php" class="nav-link text-light active">HOME</a>			
					</li>
					<li class="nav-item">
						<a href="<?= ROOT ?>/about.php" class="nav-link text-light">ABOUT US</a>			
					</li>
					<li class="nav-item">
						<a href="<?= ROOT ?>/auctions.php" class="nav-link text-light">AUCTIONS</a>			
					</li>
					<li class="nav-item">
						<a href="<?= ROOT ?>/faq.php" class="nav-link text-light">FAQs</a>			
					</li>
					<li class="nav-item">
						<a href="<?= ROOT ?>/contact.php" class="nav-link text-light">CONTACT US</a>			
					</li>
				</ul>
				<ul class="navbar-nav mr-md-5">
					<?php if(isset($_SESSION['id'])): ?>
						<li class="nav-item mr-md-2">
							<a class="nav-link text-light custom-button p-3" href="<?= ROOT ?>/dashboard/user/profile/index.php">DASHBOARD</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-light p-3" href="<?= ROOT ?>/dashboard/logout.php"><i class="fas fa-sign-out-alt"></i></a>
						</li>
					<?php else: ?>
						<li class="nav-item mr-md-2">
							<a class="nav-link text-light custom-button p-3" href="<?= ROOT ?>/auth/login.php">SIGN IN</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-light custom-button p-3" href="<?= ROOT ?>/auth/register.php">REGISTER</a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</nav>
	</header>