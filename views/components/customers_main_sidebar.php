<?php
    include_once('../../../utils/utils.php');
?>
<!-- Mobile Nav (max width 767px)-->
<div class="mobile-nav">
    <!-- Navbar Brand -->
    <div class="amado-navbar-brand">
        <a href="index.php"><img src="../../../assets/img/core-img/logo.png" alt=""></a>
    </div>
    <!-- Navbar Toggler -->
    <div class="amado-navbar-toggler">
        <span></span><span></span><span></span>
    </div>
</div>
<!-- Header Area Start -->
<header class="header-area clearfix" style="background-color:#006400 ;color:white;">
    <!-- Close Icon -->
    <div class="nav-close">
        <i class="fa fa-close" aria-hidden="true"></i>
    </div>
    <!-- Logo -->
    <div class="logo">
        <a href="index.php"><img src="../../../assets/img/core-img/logo.png" alt=""></a>
    </div>
    <!-- Amado Nav -->
    <nav class="amado-nav">
        <ul>
            <li class="<?php echo containsString($_SERVER['REQUEST_URI'], ["index.php"]) ? 'active':''; ?>"><a style="color:white;" href="index.php">Home</a></li>
            <li class="<?php echo containsString($_SERVER['REQUEST_URI'], ["shop.php"]) ? 'active':''; ?>"><a style="color:white;" href="shop.php">Shop</a></li>
            <li class="<?php echo containsString($_SERVER['REQUEST_URI'], ["cart.php"]) ? 'active':''; ?>"><a style="color:white;" href="cart.php">Cart</a></li>
        </ul>
    </nav>
    <!-- Button Group -->
    <div class="amado-btn-group mt-30 mb-100">  
    </div>
    <!-- Cart Menu -->
    <div class="cart-fav-search mb-100">
        <a href="profile.php" class="cart-nav" style="color:white;"><img src="../../../assets/img/core-img/cart.png" alt="">Profile</a>
        <a href="#" class="search-nav" style="color:white;"><img src="../../../assets/img/core-img/search.png" alt="">Search</a>
        <a href="../../../controllers/generic/logout.php" class="fav-nav" style="color:white;"><img src="../../../assets/img/core-img/favorites.png" alt=""> Logout </a>
    </div>
    <!-- Social Button -->
    <div class="social-info d-flex justify-content-between">
        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
    </div>
</header>
<!-- Header Area End -->