<?php require_once '../../config.php'; ?>
<?php include_once '../../layout/header.php' ?>
<link href="../assets/landing/css/style.css" rel="stylesheet" />

<!--============= Dashboard Section Starts Here =============-->
    <section class="dashboard-section padding-bottom mt--240 mt-lg--325 pos-rel hmmm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-7 col-lg-4">
                    <div class="dashboard-widget mb-30 mb-lg-0">
                        <div class="user">                            
                            <div class="content">
                                <h3 class="title"><a href="#0"><?= $auth['name'] ?></a></h3>
                                <span class="username"><?= $auth['email'] ?></span>
                            </div>
                        </div>
                        <ul class="dashboard-menu">
                            <li>
                                <a href="./index.php" class="active"><i class="flaticon-dashboard"></i>Dashboard</a>
                            </li>
                            <li>
                                <a href="./profile/index.php"><i class="flaticon-settings"></i>Personal Profile </a>
                            </li>                          
                            

                            <li>
                                <a href="#"><i class="flaticon-auction"></i>My Bids</a>
                            </li>                           
                            
                            <li>
                                <a href="#"><i class="flaticon-best-seller"></i>Winning Bids</a>
                            </li>                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="dashboard-widget mb-40">
                        <div class="dashboard-title mb-30">
                            <h5 class="firtitle">My Activity</h5>
                        </div>
                        <div class="row justify-content-center mb-30-none">
                            <div class="col-md-4 col-sm-6">
                                <div class="dashboard-item">
                                    <div class="thumb">
                                        <img src="<?= ROOT ?>/assets/landing/images/dash1.png" alt="dashboard">
                                    </div>
                                    <div class="content">
                                        <h2 class="dashtitle"><span class="counter">80</span></h2>
                                        <h6 class="info">Active Bids</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="dashboard-item">
                                    <div class="thumb">
                                        <img src="<?= ROOT ?>/assets/landing/images/dash2.png" alt="dashboard">
                                    </div>
                                    <div class="content">
                                        <h2 class="dashtitle"><span class="counter">15</span></h2>
                                        <h6 class="info">Items Won</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="dashboard-item">
                                    <div class="thumb">
                                        <img src="<?= ROOT ?>/assets/landing/images/dash3.png" alt="dashboard">
                                    </div>
                                    <div class="content">
                                        <h2 class="dashtitle"><span class="counter">115</span></h2>
                                        <h6 class="info">Favorites</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!--============= Dashboard Section Ends Here =============-->

<?php include_once '../../layout/footer.php'; ?>



