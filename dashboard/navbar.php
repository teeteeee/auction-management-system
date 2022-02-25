<?php require_once '../config.php'; ?>
<?php include_once '../layout/header.php' ?>
<link href="../assets/css/style.css" rel="stylesheet" />

<div class="col-sm-10 col-md-7 col-lg-4">
                    <div class="dashboard-widget mb-30 mb-lg-0">
                        <div class="user">                            
                            <div class="content">
                                <h3 class="title"><a href="#0"><?= $user['name'] ?></a></h3>
                                <span class="username"><?= $user['email'] ?></span>
                            </div>
                        </div>
                        <ul class="dashboard-menu">
                            <li>
                                <a href="./custdash.php" class="active"><i class="flaticon-dashboard"></i>Dashboard</a>
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