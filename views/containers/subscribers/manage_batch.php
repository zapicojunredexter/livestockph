<!doctype html>
<html lang="en">
<head>

    <?php
        require_once('../../components/subscribers_main_header.php');
        require_once('../../../utils/db_conn.php');
        require_once('../../../utils/session_functions.php');

        $companyId = $_SESSION['account_company'];
        $batchId = $_GET['id'];

        $product = getRecord("SELECT * FROM obbatches batch, ownerbreeds ownerbreed, breeds breed, categories category,
        livestocksuppliers supp WHERE category.CategoryId = breed.CategoryId AND breed.BreedId = ownerbreed.BreedId AND
        supp.SupplierNo = ownerbreed.SupplierNo AND ownerbreed.OwnerBreedId = batch.OwnerBreedId AND batch.BatchId = $batchId");
    ?>

</head>
<body>

    <div class="modal" tabindex="-1" role="dialog" id="addImageModal">
        <div class="modal-dialog" role="document">
            <form target="_blank" action="../../../controllers/subscribers/add_product_image.php" method="post" enctype="multipart/form-data">
                    
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Documents</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        Select image to upload:
                        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                        <input type="hidden" name="companyId" value="<?php echo $companyId; ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="$('#addImageModal').modal('hide')" class="btn btn-primary">UPLOAD DOCUMENT</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </form>
        </div>
    </div>


    <div class="wrapper">
        
        <?php
            require_once('../../components/subscribers_main_sidebar.php');
        ?>

        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Inventory</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-dashboard"></i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-globe"></i>
                                        <b class="caret hidden-sm hidden-xs"></b>
                                        <span class="notification hidden-sm hidden-xs">5</span>
                                        <p class="hidden-lg hidden-md">
                                            5 Notifications
                                            <b class="caret"></b>
                                        </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Notification 1</a></li>
                                    <li><a href="#">Notification 2</a></li>
                                    <li><a href="#">Notification 3</a></li>
                                    <li><a href="#">Notification 4</a></li>
                                    <li><a href="#">Another notification</a></li>
                                </ul>
                            </li>
                            <li>
                            <a href="">
                                    <i class="fa fa-search"></i>
                                    <p class="hidden-lg hidden-md">Search</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                            <a href="">
                                <p>Account</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <p>
                                            Dropdown
                                            <b class="caret"></b>
                                        </p>

                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <p>Log out</p>
                                </a>
                            </li>
                            <li class="separator hidden-lg hidden-md"></li>
                        </ul>
                    </div>
                </div>
            </nav>



            <div class="content">
            <button data-toggle="modal" data-target="#addImageModal">addd</button>
            <?php
                if(isset($_GET['message']) && ($_GET['message'])=="Success"){
                    ?>
                    <div class="alert alert-success" id="successMessage">
                        <button type="button" onclick="$('#successMessage').remove()" class="close">×</button>
                        <span><b> Success - </b> This is a regular notification made with ".alert-success"</span>
                    </div>
                    <?php
                }
            ?>
                <div class="single-product-area clearfix">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-lg-7">
                                <div class="single_product_thumb">
                                    <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <a class="gallery_img" href="../../../assets/img/product-img/pro-big-1.jpg">
                                                    <img class="d-block w-100" src="../../../assets/img/product-img/pro-big-1.jpg" alt="First slide">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3" style="padding:10px;">            
                                        <a class="gallery_img">
                                            <img class="d-block w-100" src="../../../assets/img/product-img/pro-big-1.jpg" alt="First slide">
                                        </a>
                                    </div>
                                    <div class="col-sm-3" style="padding:10px;">            
                                        <a class="gallery_img">
                                            <img class="d-block w-100" src="../../../assets/img/product-img/pro-big-1.jpg" alt="First slide">
                                        </a>
                                    </div>
                                    <div class="col-sm-3" style="padding:10px;">            
                                        <a class="gallery_img">
                                            <img class="d-block w-100" src="../../../assets/img/product-img/pro-big-1.jpg" alt="First slide">
                                        </a>
                                    </div>
                                    <div class="col-sm-3" style="padding:10px;">            
                                        <a class="gallery_img">
                                            <img class="d-block w-100" src="../../../assets/img/product-img/pro-big-1.jpg" alt="First slide">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-5">
                                <div class="single_product_desc">
                                    <!-- Product Meta Data -->
                                    <div class="product-meta-data">
                                        <div class="line"></div>
                                        <h3><?php echo $product['CategoryDescription']." - ".$product['BreedDescription']; ?></h3>
                                        <!-- Avaiable -->
                                        <p class="avaibility"><i class="fa fa-circle" style="color:<?php echo $product['Stock'] > 0 ? "green":"red"; ?>;"></i> In Stock</p>
                                    </div>
                                    <form action="../../../controllers/subscribers/edit_batch_product.php" method="post">
                                        <input type="hidden" value="<?php echo $batchId; ?>" name="BatchId">
                                        <div class="short_overview my-5">
                                            <textarea name="Description" style="height:100px;" class="form-control"><?php echo $product['Description']; ?></textarea>
                                        </div>

                                        <div class="row" style="margin-top:10px;">
                                            <div class="col-sm-3">Stock</div>
                                            <div class="col-sm-9">
                                                <input name="Stock" type="number" value="<?php echo $product['Stock']; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px;">
                                            <div class="col-sm-3">Ave. Weight</div>
                                            <div class="col-sm-9">
                                                <input name="AverageWeight" type="number" value="<?php echo $product['AverageWeight']; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px;">
                                            <div class="col-sm-3">Price (kg)</div>
                                            <div class="col-sm-9">
                                                <input name="PricePerKilo" type="number" value="<?php echo $product['PricePerKilo']; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px;">
                                            <div class="col-sm-3">Date of Birth</div>
                                            <div class="col-sm-9">
                                                <input name="DOB" type="date" value="<?php echo $product['DOB']; ?>" class="form-control">
                                            </div>
                                        </div>
                                            <br>
                                            <button type="submit" name="addtocart" value="5" class="btn amado-btn">EDIT</button>
                                    
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <?php
                require_once('../../components/subscribers_main_footer.php');
            ?>

        </div>
    </div>



            <!--   Core JS Files   -->
    <script src="../../../assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="../../../assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../assets/js/chartist.min.js"></script>
    <script src="../../../assets/js/bootstrap-notify.js"></script>
    <script src="../../../assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
    <script src="../../../assets/js/demo.js"></script>

</body>
</html>
