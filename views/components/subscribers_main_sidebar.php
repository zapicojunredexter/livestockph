<div class="sidebar" style="z-index: 1000;">

    <!--<div class="sidebar" data-color="orange" data-image="../../../assets/img/sidebar-5.jpg">-->

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->
    <div class="sidebar-wrapper" style="background-color:#fbb710;">
    <?php
        include_once('../../../utils/utils.php');
    ?>
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text">
                Creative Tim
            </a>
        </div>
        <ul class="nav">
            <li class="<?php echo containsString($_SERVER['REQUEST_URI'], ["index.php"]) ? 'active':''; ?>" style="width:100%">
                <a href="index.php">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="<?php echo containsString($_SERVER['REQUEST_URI'], ["orders.php","order_details.php"]) ? 'active':''; ?>" style="width:100%">
                <a href="orders.php">
                    <i class="pe-7s-note2"></i>
                    <p>Orders</p>
                </a>
            </li>
            <li class="<?php echo containsString($_SERVER['REQUEST_URI'], ["inventory.php"]) ? 'active':''; ?>" style="width:100%">
                <a href="inventory.php">
                    <i class="pe-7s-news-paper"></i>
                    <p>Inventory</p>
                </a>
            </li>
            <li class="<?php echo containsString($_SERVER['REQUEST_URI'], ["user.php","company.php"]) ? 'active':''; ?>" style="width:100%">
                <a>
                    <i class="pe-7s-rocket"></i>
                    <p onclick="$('#profiledropdown').slideToggle();">User Profile</p>
                    <ul id="profiledropdown" style="list-style:none;padding:0px 20px 0px 20px;display:none;">
                        <li class="active-pro" style="padding:5px;">
                            <a href="user.php">Personal</a>
                        </li>
                        <li class="active-pro" style="padding:5px;">
                            <a href="company.php" style="color:white;">Company</a>
                        </li>
                    </ul>
                </a>
            </li>
			<li class="<?php echo containsString($_SERVER['REQUEST_URI'], ["upgrade.php"]) ? 'active':''; ?>" class="active-pro" style="width:100%">
                <a href="upgrade.php">
                    <i class="pe-7s-rocket"></i>
                    <p>
                        <?php
                            $accountExpiry = $_SESSION['account_expiry'];
                            $diff = abs(strtotime($accountExpiry) - strtotime(date('Y-m-d')));

                            $years = floor($diff / (365*60*60*24));
                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                            if($accountExpiry>date("Y-m-d")){

                                if($years){
                                    echo $years." Years ";
                                }
                                if($months){
                                    echo $months." Months ";
                                }
                                echo $days." Days";
                            }else{
                                echo "Needs Renewal";
                            }
                        ?>
                    </p>
                </a>
            </li>
			<li class="active-pro" style="width:100%">
                <a href="../../../controllers/generic/logout.php">
                    <i class="pe-7s-rocket"></i>
                    <p>Log out</p>
                </a>
            </li>

        </ul>
	</div>
</div>

    