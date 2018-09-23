<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php
        require_once('../../components/customers_main_header.php');
        require_once('../../../utils/db_conn.php');
        require_once('../../../utils/session_functions.php');

        $userId = $_SESSION['account_id'];
        $user = getRecord("SELECT * FROM livestockbuyers buyer, accounts account WHERE
        buyer.BuyerNo = $userId AND buyer.BuyerNo = account.OwnerId");
    ?>

</head>

<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
                            <button type="submit"><img src="../../../assets/img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">
        
        <?php
            require_once('../../components/customers_main_sidebar.php');
        ?>

        <!-- Product Details Area Start -->
        <div class="single-product-area clearfix mt-50">
            <div class="container-fluid">
                <?php
                    if(isset($_GET['message']) && ($_GET['message'])=="Success"){
                        ?>
                        <div class="alert alert-success" id="successMessage">
                            <button type="button" onclick="$('#successMessage').remove()" class="close">×</button>
                            <span><b> Success - </b> This is a regular notification made with ".alert-success"</span>
                        </div>
                        <?php
                    }else{
                        if(isset($_GET['message'])){
                            ?>
                            <div class="alert alert-danger" id="errorMessage">
                                <button type="button" onclick="$('#errorMessage').remove()" class="close">×</button>
                                <span><b> Error - </b> This is a regular notification made with ".alert-success"</span>
                            </div>
                            <?php
                        }
                    }
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="image" style="text-align:center;">
                                <img style="border-radius:50%; box-shadow: 3px 3px 3px" src="../../../assets/img/faces/face-3.jpg" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author" style="text-align:center;">
                                <br>
                                     <a href="#">
                                   
                                      <h4 class="title">
                                        <?PHP echo $user['BuyerLName'].", ".$user['BuyerFName']?>
                                      </h4>
                                    </a>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form method="post" action="../../../controllers/customers/edit_account.php">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" disabled placeholder="Username" value="<?php echo $user['Username']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Password</label>
                                                <input type="password" class="form-control" disabled placeholder="Email" value="<?php echo $user['Password']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Street</label>
                                                <input type="text" name="Street" class="form-control" placeholder="Home Address" value="<?php echo $user['Street']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Province</label>
                                                <input type="text" name="Province" class="form-control" placeholder="City" value="<?php echo $user['Province']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" name="City" class="form-control" placeholder="Country" value="<?php echo $user['City']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Zip Code</label>
                                                <input type="number" name="ZipCode" class="form-control" placeholder="ZIP Code" value="<?php echo $user['ZipCode']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name="BuyerFName" class="form-control" placeholder="Company" value="<?php echo $user['BuyerFName']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" name="BuyerLName" class="form-control" placeholder="Last Name" value="<?php echo $user['BuyerLName']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success btn-fill pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Product Details Area End -->
    </div>
    <!-- ##### Main Content Wrapper End ##### -->
    
    <?php
        include_once('../../components/customers_main_footer.php');
    ?>

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="../../../assets/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="../../../assets/js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="../../../assets/js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="../../../assets/js/plugins.js"></script>
    <!-- Active js -->
    <script src="../../../assets/js/active.js"></script>

</body>

</html>