<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php
        require_once('../../components/customers_main_header.php');
        require_once('../../../utils/db_conn.php');
        require_once('../../../utils/session_functions.php');

        $categories = getRecords("SELECT * FROM categories");
        $categoryId = null;
        $breeds = [];
        $breedIds = [];
        if(isset($_GET['category'])){
            $categoryId = $_GET['category'];
            $breeds = getRecords("SELECT * FROM breeds WHERE CategoryId = $categoryId");
        }
        if(isset($_GET['breedIds'])){
            $breedIds=$_GET['breedIds'];
        }
        $products = getRecords("SELECT * FROM categories category, breeds breed,
        ownerbreeds obreed, livestocksuppliers supplier, obbatches batch WHERE
        category.CategoryId = breed.CategoryId AND breed.BreedId = obreed.BreedId
        AND obreed.SupplierNo = supplier.SupplierNo AND obreed.OwnerBreedId = batch.OwnerBreedId
        AND breed.BreedId IN (".implode(',', array_map('intval', $breedIds)).")");

        $minPrice = sizeof($products) > 0 ? round(min(array_column($products, 'PricePerKilo'))) : 0;
        $maxPrice = sizeof($products) > 0 ? round(max(array_column($products, 'PricePerKilo'))) : 0;

        $least = sizeof($products) > 0 ? min(array_column($products, 'DOB')) : date('Y-m-d');
        $greatest = sizeof($products) > 0 ? max(array_column($products, 'DOB')) : date('Y-m-d');
        $youngest = new DateTime($greatest);
        $oldest = new DateTime($least);
        $today = new DateTime(date('Y-m-d'));
        
        $minMonthTemp = $youngest->diff($today);
        $maxMonthTemp = $oldest->diff($today);
        
        $minMonth = (($minMonthTemp->format('%y') * 12) + $minMonthTemp->format('%m'));
        $maxMonth = (($maxMonthTemp->format('%y') * 12) + $minMonthTemp->format('%m'));
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
        <form id="filterForm" class="shop_sidebar_area" style="padding-top:20px;">
            <input type="hidden" name="category" value="<?php echo $categoryId?$categoryId:null; ?>">
            <!-- ##### Single Widget ##### -->
            <div class="widget catagory mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Categories</h6>

                <!--  Catagories  -->
                <div class="catagories-menu">
                    <ul>
                        <?php
                            foreach($categories as $category){
                                ?>
                                    <li class="<?php echo (isset($_GET['category']) && ($_GET['category']==$category['CategoryId']))?'active':'';?>"><a href="?category=<?php echo $category['CategoryId']; ?>"><?php echo $category['CategoryDescription']; ?></a></li>
                                <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>

            <!-- ##### Single Widget ##### -->
            <div class="widget brands mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Brands</h6>

                <div class="widget-desc">
                    <!-- Single Form Check -->
                    <?php
                        foreach($breeds as $breed){
                            ?>
                                <div class="form-check">
                                    <input name="breedIds[]" class="form-check-input" type="checkbox" value="<?php echo $breed['BreedId']?>">
                                    <label class="form-check-label" for="amado"><?php echo $breed['BreedDescription']?></label>
                                </div>
                            <?php
                        }
                    ?>
                </div>
            </div>

            <!-- ##### Single Widget ##### -->
            <div class="widget price mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Price</h6>

                <div class="widget-desc">
                    <div class="slider-range">
                        <div data-min="<?php echo $minPrice?>" data-max="<?php echo $maxPrice?>" data-unit="PHP" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="<?php echo $minPrice?>" data-value-max="<?php echo $maxPrice?>" data-label-result="">
                            <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                        </div>
                        <div class="range-price">PHP<?php echo $minPrice?> - PHP<?php echo $maxPrice?></div>
                    </div>
                </div>
            </div>
            <!-- ##### Single Widget ##### -->
            <div class="widget price mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Age</h6>

                <div class="widget-desc">
                    <div class="slider-range">
                        <div data-min="<?php echo $minMonth; ?>" data-max="<?php echo $maxMonth; ?>" data-unit="" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="<?php echo $minMonth; ?>" data-value-max="<?php echo $maxMonth; ?>" data-label-result="">
                            <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                        </div>
                        <div class="range-price"><?php echo $minMonth; ?> - <?php echo $maxMonth; ?></div>
                    </div>
                </div>
            </div>
            
            <button onclick="filterTags()" type="button" class="btn amado-btn">FILTER</button>
        </form>
        <script>
            function filterTags(){
                var data = $('#filterForm').serialize();
                console.log(data);
                window.location.href="shop.php?"+data;
            }
        </script>
        <div class="amado_product_area section-padding-100" style="padding-top:20px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                            <!-- Total Products -->
                            <div class="total-products">
                                <p>Showing 1-8 0f 25</p>
                            </div>
                            <!-- Sorting -->
                            <div class="product-sorting d-flex">
                                <div class="sort-by-date d-flex align-items-center mr-15">
                                    <p>Sort by</p>
                                    <form action="#" method="get">
                                        <select name="select" id="sortBydate">
                                            <option value="value">Date</option>
                                            <option value="value">Newest</option>
                                            <option value="value">Popular</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="view-product d-flex align-items-center">
                                    <form action="#" method="get">
                                        <select name="select" id="viewProduct">
                                            <option value="value">Increasing</option>
                                            <option value="value">Decreasing</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="view-product d-flex align-items-center">
                                    <button class="btn amado-btn">SORT</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Single Product Area -->
                    <?php
                        foreach($products as $product){
                            ?>
                                <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                                    <div class="single-product-wrapper">
                                        <!-- Product Image -->
                                        <div class="product-img">
                                            <img src="../../../assets/img/product-img/product1.jpg" alt="">
                                            <!-- Hover Thumb -->
                                            <img class="hover-img" src="../../../assets/img/product-img/product2.jpg" alt="">
                                        </div>

                                        <!-- Product Description -->
                                        <div class="product-description d-flex align-items-center justify-content-between">
                                            <!-- Product Meta Data -->
                                            <div class="product-meta-data">
                                                <div class="line"></div>
                                                <a href="product_details.html" class="product-price"><?php echo $product['CategoryDescription']." - ".$product['BreedDescription'];?></a>
                                                <a>
                                                    <h6>PHP<?php echo $product['PricePerKilo'];?> per kg</h6>
                                                    <h6>
                                                        <?php
                                                            $diff = abs(strtotime(date('Y-m-d')) - strtotime($product['DOB']));

                                                            $years = floor($diff / (365*60*60*24));
                                                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                                            if($years){
                                                                echo $years.(($years>1)?" Years Old": " Years Old");
                                                            }
                                                            if($months){
                                                                echo $months.(($months>1)?" Months Old": " Months Old");
                                                            }
                                                            echo $days.(($days>1)?" Days Old": " Day Old");
                                                        ?>
                                                    </h6>   
                                                </a>
                                            </div>
                                            <!-- Ratings & Cart -->
                                            <div class="ratings-cart text-right">
                                                <div class="cart">
                                                    <a href="cart.html" data-toggle="tooltip" data-placement="left" title="Add to Cart"><img src="../../../assets/img/core-img/cart.png" alt=""></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    ?>
                </div>

                <div class="row">
                    <div class="col-12">
                        <!-- Pagination -->
                        <nav aria-label="navigation">
                            <ul class="pagination justify-content-end mt-50">
                                <li class="page-item active"><a class="page-link" href="#">01.</a></li>
                                <li class="page-item"><a class="page-link" href="#">02.</a></li>
                                <li class="page-item"><a class="page-link" href="#">03.</a></li>
                                <li class="page-item"><a class="page-link" href="#">04.</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
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