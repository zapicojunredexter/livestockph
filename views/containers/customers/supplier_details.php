<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php
        require_once('../../components/customers_main_header.php');
        require_once('../../../utils/db_conn.php');
        require_once('../../../utils/session_functions.php');
        $companyId = $_GET['id'];
        $company = getRecord("SELECT * FROM livestocksuppliers WHERE SupplierNo = $companyId");
       

        $products = getRecords("SELECT *,(SELECT ImagePath from productimages WHERE BatchId = batch.BatchId LIMIT 1)
        AS Photo FROM categories category,breeds breed, ownerbreeds obreed,
        obbatches batch WHERE category.CategoryId = breed.CategoryId AND breed.BreedId = obreed.BreedId
        AND obreed.OwnerBreedId = batch.OwnerBreedId");

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
                
                    <div class="col-lg-5">



                        <div id="slideshow">
                            <?php
                                foreach($products as $product){
                                    if($product['Photo']){
                                    ?>
                                        <div>
                                        <img src="<?php echo "../../../files/images/products/".$product['Photo']?>">
                                        </div>
                                    <?php
                                    }
                                }
                            ?>
                        </div>




                    </div>








                    <div class="col-lg-7 card">
                        <div class="single_product_desc content">
                            <div class="row" style="margin-top:10px;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input disabled style="background-color:white!important;border:none;" type="text" class="form-control" value="<?php echo $company['SupplierName']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Delivery</label>
                                        <input disabled style="background-color:white!important;border:none;" type="text" class="form-control" value="<?php echo $company['DeliveryFee']?"Yes":"-"; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label></label>
                                        <input disabled style="background-color:white!important;border:none;" type="text" class="form-control" value="<?php echo $company['DeliveryFee']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label></label>
                                        <input disabled style="background-color:white!important;border:none;" type="text" class="form-control" value="<?php echo $company['DeliveryDays']?$company['DeliveryDays']." Days":$company['DeliveryDays']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Street</label>
                                        <input disabled style="background-color:white!important;border:none;" type="text" class="form-control" value="<?php echo $company['Street']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Province</label>
                                        <input disabled style="background-color:white!important;border:none;" type="text" class="form-control" value="<?php echo $company['Province']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input disabled style="background-color:white!important;border:none;" type="text" class="form-control" value="<?php echo $company['City']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Zip Code</label>
                                        <input style="background-color:white!important;border:none;" type="number" class="form-control" value="<?php echo $company['ZipCode']; ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- Add to Cart Form -->

                        </div>
                    </div>




                    <div class="col-sm-12" style="margin-top:100px;">
                        <div class="row">
                            <?php
                                foreach($products as $batch){
                                    ?>
                                    <div class="col-sm-3" style="padding:20px;">
                                   
                                        <a href="product_details.php?id=<?php echo $batch['BatchId']?>">
                                            <img src="<?php
                                                echo $batch['Photo']?
                                                    "../../../files/images/products/".$batch['Photo']
                                                    :"../../../assets/img/defaults/no_image.jpg"?>"
                                                    alt="<?php echo $batch['Photo']?>"
                                                    style="width:100%;">
                                            <div class="hover-content">
                                                <div class="line"></div>
                                                <p>PHP <?php echo $batch['PricePerKilo']?></p>
                                                <h5><?php echo $batch['CategoryDescription']." - ".$batch['BreedDescription']?></h5>
                                            </div>
                                        </a>
                                        
                                        <div class="ratings-cart text-right">
                                            <div class="cart">
                                                <a onclick="addToCart(<?php echo $batch['BatchId']?>,<?php echo $batch['Stock']?>,<?php echo $batch['SupplierNo']?>)" data-toggle="tooltip" data-placement="left" title="Add to Cart"><img src="../../../assets/img/core-img/cart.png" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
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
                        alert(BatchId);
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

<script>
$("#slideshow > div:gt(0)").hide();

setInterval(function() { 
  $('#slideshow > div:first')
    .fadeOut(1000)
    .next()
    .fadeIn(1000)
    .end()
    .appendTo('#slideshow');
},  3000);
</script>
</html>