<?php require_once '../config.php'; ?>
<?php include_once '../layout/header.php' ?>
<link href="../assets/css/style.css" rel="stylesheet" />

<body>
    <!--============= Dashboard Section Starts Here =============-->
    <section class="dashboard-section padding-bottom mt--240 mt-lg--440 pos-rel profileee">
        <div class="container">
            <div class="row justify-content-center">
                <?php include_once './navbar.php' ?>
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
                                        <div class="info-value"><?= $user['name'] ?></div>
                                    </li>
                                    <li>
                                        <div class="info-name">Email</div>
                                        <div class="info-value"><?= $user['email'] ?></div>
                                    </li>
                                    <li>
                                        <div class="info-name">Mobile</div>
                                        <div class="info-value"><?= $user['mobile'] ?></div>
                                    </li>
                                    <li>
                                        <div class="info-name">Address</div>
                                        <div class="info-value"><?= $user['address'] ?></div>
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


    
<?php include_once '../layout/footer.php'; ?>