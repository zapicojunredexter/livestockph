<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php
        require_once('../../components/customers_main_header.php');
        require_once('../../../utils/session_functions.php');
        require_once('../../../utils/db_conn.php');

        $cartItems = isset($_SESSION['cart_items'])?$_SESSION['cart_items']:null;
        $batchItemsFromCart = [];
        if($cartItems){
            $batchIds = array_column($cartItems, 'BatchId');
            $companyId = $_SESSION['cart_company'];
            $batchItemsFromCart = getRecords("SELECT *
            FROM categories category, breeds breed, ownerbreeds obreed, livestocksuppliers supplier,
            obbatches batch WHERE category.CategoryId = breed.CategoryId AND breed.BreedId = obreed.BreedId
            AND obreed.SupplierNo = supplier.SupplierNo AND obreed.OwnerBreedId = batch.OwnerBreedId AND
            batch.BatchId IN (".implode(',', array_map('intval', $batchIds)).")");

            $companyDetails = getRecord("SELECT * FROM livestocksuppliers WHERE SupplierNo = $companyId");
            print_r($companyDetails);

        }
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

        <div class="cart-table-area section-padding-100">
            <!-- start cart div-->
        
            <ul id="progressbar">
                <li id="cartLis" class="active" onclick="changePage(0)">Cart</li>
                <li id="detailsLis" onclick="changePage(1)">Order Details</li>
                <li id="checkoutLis" onclick="changePage(2)">Checkout</li>
            </ul>
            <script>
                var divs = ['cartDiv','detailsDiv','checkoutDiv'];
                var lis = ['cartLis','detailsLis','checkoutLis'];
                var currentPage = 0;
                function changePage(page){
                    if(page == 2 && currentPage == 0){
                        return;
                    }
                    for(var index = 0;index<3;index++){
                        if(index == page){
                            $(`#${divs[index]}`).show();
                        }else{
                            $(`#${divs[index]}`).hide();
                        }
                        if(index <= page){
                            $(`#${lis[index]}`).addClass('active');
                        }else{
                            $(`#${lis[index]}`).removeClass('active');
                        }
                    }
                    currentPage++;
                }
            </script>
            <div class="container-fluid" id="cartDiv" style="float:left;display:block;">
                <div class="row">
                    <div class="col-12 col-lg-9">
                        <div class="cart-title mt-50">
                            <h2>Shopping Cart</h2>
                        </div>
                        <script>
                            function clearCart(){
                                var confirmClear = confirm("Are you sure you want to clear session items?");
                                if(confirmClear){
                                    $.ajax({
                                        method: 'post',
                                        url: "../../../controllers/customers/empty_cart.php",
                                        success: function(result){
                                            addCartToSession(
                                                BatchId,
                                                Stock,
                                                SupplierNo,
                                                Quantity
                                            );
                                        },
                                        fail: function(result){
                                            console.log(result);
                                        }
                                    });
                                }
                            }
                        </script>
                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($batchItemsFromCart)){
                                            foreach($batchItemsFromCart as $product){
                                                ?>    
                                                    <tr>
                                                        <td class="cart_product_img">
                                                            <a href="#"><img src="../../../assets/img/bg-img/cart1.jpg" alt="Product"></a>
                                                        </td>
                                                        <td class="cart_product_desc">
                                                            <h5><?php echo $product['CategoryDescription']." - ".$product['BreedDescription']; ?></h5>
                                                        </td>
                                                        <td class="price">
                                                            <span>PHP<?php echo $product['PricePerKilo']?></span>
                                                        </td>
                                                        <td class="qty">
                                                            <div class="qty-btn d-flex">
                                                                <p>Qty</p>
                                                                <div class="quantity">
                                                                    <input type="number" class="qty-text" id="qty" step="1" min="1" max="3" name="quantity" value="1">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="cart-btn mt-50">
                            <button style="background-color:red;margin-bottom:10px;" onclick="clearCart()" class="btn amado-btn w-100">CLEAR CART</button>
                            <button onclick="toggleCartCheckout()" class="btn amado-btn w-100">Checkout</button>
                        </div>
                        <div class="cart-summary" style="margin-top:50px;">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> <span>$140.00</span></li>
                                <li><span>delivery:</span> <span>0</span></li>
                                <li><span>total:</span> <span>$140.00</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end cart div -->
            <script>
                function toggleCartCheckout(){
                    $('#cartDiv').toggle();
                    $('#detailsDiv').toggle();
                }
            </script>
            <!-- start checkout div-->
            <div class="container-fluid" id="detailsDiv" style="display:none;">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Order/ Supplier Details</h2>
                            </div>

                            <form action="#" method="post">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" disabled value="<?php echo $companyDetails['SupplierName']?>">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" disabled value="<?php echo $companyDetails['Street']?>">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" disabled value="<?php echo $companyDetails['Province']?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" disabled value="<?php echo $companyDetails['ZipCode']?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="number" class="form-control" disabled value="<?php echo $companyDetails['ContactNo']?>">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <textarea name="comment" class="form-control w-100" id="comment" cols="30" rows="10" placeholder="Leave a comment about your order"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> <span>$140.00</span></li>
                                <li><span>delivery:</span> <span>Free</span></li>
                                <li><span>total:</span> <span>$140.00</span></li>
                            </ul>

                            <div class="payment-method">
                                <!-- Cash on delivery -->
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="cod" checked>
                                    <label class="custom-control-label" for="cod">Pay Delivery fee?</label>
                                </div>
                            </div>

                            <div class="cart-btn mt-100">
                                <a href="#" class="btn amado-btn w-100">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end checkout div -->
            <div id="checkoutDiv" style="display:none;">CHECKOUT NAA</div>
        </div>
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