<?php require_once '../../config.php'; ?>
<?php include_once '../../layout/header.php' ?>
<link href="../assets/landing/css/style.css" rel="stylesheet" />
<body>
    <!--============= Dashboard Section Starts Here =============-->
    <section class="dashboard-section padding-bottom mt--240 mt-lg--440 pos-rel profileee">
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
                                <a href="../profile/index.php" class="active"><i class="flaticon-dashboard"></i>Dashboard</a>
                            </li>
                            <li>
                                <a href="./profile.php"><i class="flaticon-settings"></i>Personal Profile </a>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="dash-pro-item mb-30 dashboard-widget">
                                <div class="header">
                                    <h4 class="title">Personal Details</h4>
                                    <a href="edit.php"><span class="edit"><i class="far fa-edit"></i> Edit</span></a>
                                </div>
                                <ul class="dash-pro-body">
                                    <li>
                                        <div class="info-name">Name</div>
                                        <div class="info-value"><?= $auth['name'] ?></div>
                                    </li>
                                    <li>
                                        <div class="info-name">Email</div>
                                        <div class="info-value"><?= $auth['email'] ?></div>
                                    </li>
                                    <li>
                                        <div class="info-name">Mobile</div>
                                        <div class="info-value"><?= $auth['mobile'] ?></div>
                                    </li>
                                    <li>
                                        <div class="info-name">Address</div>
                                        <div class="info-value"><?= $auth['address'] ?></div>
                                    </li>
                                </ul>
                            </div>
                        </div>                     
                        
                        <div class="col-12">
                            <div class="dash-pro-item dashboard-widget">
                                <div class="header">
                                    <h4 class="title">Security</h4>
                                </div>
                                <ul class="dash-pro-body">
                                    <li>
                                        <div class="info-name">Password</div>
                                        <div class="info-value"><a href="password.php"><span class="edit"><i class="fas fa-key"></i> Edit Passworrd</span></a></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============= Dashboard Section Ends Here =============-->

<?php include_once '../../layout/footer.php'; ?>





