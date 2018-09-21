<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php
        require_once('../../components/customers_main_header.php');
        require_once('../../../utils/db_conn.php');
        require_once('../../../utils/session_functions.php');
        $productId=$_GET['id'];
        $product = getRecord("SELECT *, FLOOR(DATEDIFF(CURDATE(),batch.DOB)/30) AS MonthsOld
        FROM categories category, breeds breed, ownerbreeds obreed, livestocksuppliers supplier,
        obbatches batch WHERE category.CategoryId = breed.CategoryId AND breed.BreedId = obreed.BreedId
        AND obreed.SupplierNo = supplier.SupplierNo AND obreed.OwnerBreedId = batch.OwnerBreedId
        AND batch.BatchId = $productId");

        $images = getRecords("SELECT * FROM productimages WHERE BatchId = $productId");
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
        <div class="single-product-area clearfix mt-100">
            <div class="container-fluid">
                <div class="row">
                
                    <div class="col-md-12 col-lg-7">
                        <div class="single_product_thumb" style="margin-bottom:0px;">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a class="gallery_img">
                                            <?php
                                                if(sizeof($images) > 0){
                                                    ?>
                                                    <img class="d-block w-100" src="../../../files/images/products/<?php echo $images[0]['ImagePath']?>" alt="First slide" />
                                                    <?php
                                                }else{
                                                    ?>
                                                    <img class="d-block w-100" src="../../../assets/img/defaults/no_image.jpg" alt="First slide" />
                                                    <?php
                                                }
                                            ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        
                            <?php
                                if(sizeof($images) > 1){
                                    for($i = 1;$i<sizeof($images);$i++){
                                    ?>     
                                        <div class="col-sm-3" style="padding:10px;">            
                                            <a class="gallery_img">
                                                <img class="d-block w-100" src="../../../files/images/products/<?php echo $images[$i]['ImagePath']?>" alt="First slide">
                                            </a>
                                        </div>
                                    <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>








                    <div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">PHP <?php echo $product['PricePerKilo']?> / kg</p>
                                <a>
                                    <h6><?php echo $product['CategoryDescription']." ".$product['BreedDescription']?></h6>
                                </a>
                                <!-- Avaiable -->
                                <p class="avaibility"><i style="color:<?php echo $product['Stock']>0?"green":"red"?>;" class="fa fa-circle"></i>
                                    <?php
                                        if($product['Stock']>0){
                                            echo $product['Stock']." left";
                                        }else{
                                            echo "Out of stock";
                                        }
                                    ?>
                                </p>
                            </div>

                            <div class="short_overview my-5">
                                <p><?php echo $product['Description']?></p>   
                            </div>

                            <!-- Add to Cart Form -->
                            <form class="cart clearfix" method="post">
                                <button onclick="addToCart(<?php echo $product['BatchId']?>,<?php echo $product['Stock']?>,<?php echo $product['SupplierNo']?>)" type="button" name="addtocart" value="5" class="btn amado-btn">Add to cart</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
            <script>
                function addToCart(BatchId, Stock, SupplierNo){
                    addCartToSession(
                        BatchId,
                        Stock,
                        SupplierNo);
                }
                function confirmChangeSupplier(
                    BatchId,
                    Stock,
                    SupplierNo){
                    var confirmClear = confirm("Are you sure you want to clear session items?");
                    if(confirmClear){
                        $.ajax({
                            method: 'post',
                            url: "../../../controllers/customers/empty_cart.php",
                            success: function(result){
                                addCartToSession(
                                    BatchId,
                                    Stock,
                                    SupplierNo
                                );
                            },
                            fail: function(result){
                                console.log(result);
                            }
                        });
                    }
                }
                function addCartToSession(
                    BatchId,
                    Stock,
                    SupplierNo){
                        $.ajax({
                            method: 'post',
                            url: "../../../controllers/customers/add_to_cart.php",
                            data: {
                                BatchId,
                                Stock,
                                SupplierNo,
                            },
                            success: function(result){
                                console.log(result);
                                var JSONResult = JSON.parse(result);
                                if(JSONResult.Message== 'Already selected Items from another supplier'){
                                    confirmChangeSupplier(
                                        BatchId,
                                        Stock,
                                        SupplierNo
                                    );
                                }else{
                                    alert(JSONResult.Message);
                                }
                            },
                            fail: function(result){
                                console.log(result);
                            }
                        });
                }
            </script>
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