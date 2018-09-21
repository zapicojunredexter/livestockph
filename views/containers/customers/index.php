<!DOCTYPE html>
<html lang="en">

<head>

    <?php
        require_once('../../components/customers_main_header.php');
        require_once('../../../utils/session_functions.php');
        require_once('../../../utils/db_conn.php');
        $suppliers = getRecords("SELECT *,(SELECT ImagePath from productimages WHERE
        SupplierId = supplier.SupplierNo LIMIT 1) AS ImagePath
        FROM livestocksuppliers supplier");
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

        <!-- Product Catagories Area Start -->
        
        <div class="products-catagories-area clearfix">
            <div style="padding:20px;">
                <h3>TOP SUPPLIERS</h3>
            </div>
            <div class="amado-pro-catagory clearfix">
                <?php
                    foreach($suppliers as $supplier){
                        ?>
                            <!-- Single Catagory -->
                            <div class="single-products-catagory clearfix">
                                <a href="supplier_details.php?id=<?php echo $supplier['SupplierNo']?>">
                                    <img src="../../../files/images/products/<?php echo $supplier['ImagePath']?>" alt="">
                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <div class="line"></div>
                                        <p></p>
                                        <h4 style="color:#777"><?php echo $supplier['SupplierName']?></h4>
                                    </div>
                                </a>
                            </div>
                        <?php
                    }
                ?>

                <!-- Single Catagory
                <div class="single-products-catagory clearfix">
                    <a href="shop.php">
                        <img src="../../../assets/img/bg-img/2.jpg" alt="">
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>From $180</p>
                            <h4>Minimalistic Plant Pot</h4>
                        </div>
                    </a>
                </div>

                <div class="single-products-catagory clearfix">
                    <a href="shop.php">
                        <img src="../../../assets/img/bg-img/3.jpg" alt="">
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>From $180</p>
                            <h4>Modern Chair</h4>
                        </div>
                    </a>
                </div>

                <div class="single-products-catagory clearfix">
                    <a href="shop.php">
                        <img src="../../../assets/img/bg-img/4.jpg" alt="">
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>From $180</p>
                            <h4>Night Stand</h4>
                        </div>
                    </a>
                </div>

                <div class="single-products-catagory clearfix">
                    <a href="shop.php">
                        <img src="../../../assets/img/bg-img/5.jpg" alt="">
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>From $18</p>
                            <h4>Plant Pot</h4>
                        </div>
                    </a>
                </div>

                <div class="single-products-catagory clearfix">
                    <a href="shop.php">
                        <img src="../../../assets/img/bg-img/6.jpg" alt="">
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>From $320</p>
                            <h4>Small Table</h4>
                        </div>
                    </a>
                </div>

                <div class="single-products-catagory clearfix">
                    <a href="shop.php">
                        <img src="../../../assets/img/bg-img/7.jpg" alt="">
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>From $318</p>
                            <h4>Metallic Chair</h4>
                        </div>
                    </a>
                </div>

                <div class="single-products-catagory clearfix">
                    <a href="shop.php">
                        <img src="../../../assets/img/bg-img/8.jpg" alt="">
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>From $318</p>
                            <h4>Modern Rocking Chair</h4>
                        </div>
                    </a>
                </div>

                <div class="single-products-catagory clearfix">
                    <a href="shop.html">
                        <img src="../../../assets/img/bg-img/9.jpg" alt="">
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>From $318</p>
                            <h4>Home Deco</h4>
                        </div>
                    </a>
                </div>
                 -->
            </div>
        </div>
        <!-- Product Catagories Area End -->
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