<!doctype html>
<html lang="en">
<head>

    <?php
        require_once('../../components/subscribers_main_header.php');
        require_once('../../../utils/db_conn.php');
        require_once('../../../utils/session_functions.php');
    
        $companyId = $_SESSION['account_company'];
        $toBeDelivered = getRecord("SELECT COUNT(SupplierNo) AS ToBeDelivered FROM reservations
        WHERE Status = 0 AND ToBeDelivered = 1 AND SupplierNo = $companyId
        GROUP BY SupplierNo");
        $toBePickedUp = getRecord("SELECT COUNT(SupplierNo) AS ToBePickedUp FROM reservations
        WHERE Status = 0 AND ToBeDelivered = 0 AND SupplierNo = $companyId
        GROUP BY SupplierNo");
        $forPickup = $toBePickedUp['ToBePickedUp'];
        $forDelivery = $toBeDelivered['ToBeDelivered'];

        $pendingTransactions = getRecords("SELECT * FROM reservations reservation, livestockbuyers buyer
        WHERE buyer.BuyerNo = reservation.BuyerNo AND reservation.status = 0 AND reservation.SupplierNo = $companyId");

    ?>

</head>
<body>

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
                    <a class="navbar-brand" href="#">Dashboard</a>
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
                                    <b class="caret hidden-lg hidden-md"></b>
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
						<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">

                
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Tasks</h4>
                                <p class="category">Backend development</p>
                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody>
                                            <?php
                                                foreach($pendingTransactions as $transaction){
                                                    ?>
                                                        <tr class="text-<?php echo $transaction['ToBeDelivered']? "primary" : "warning"?>">
                                                            <td>
                                                            </td>
                                                            <td>
                                                            
                                                                <?php
                                                                echo $transaction['BuyerLName'].", ".$transaction['BuyerFName']."'s Order ";
                                                                if($transaction['ToBeDelivered']){
                                                                    echo "for delivery";
                                                                }else{
                                                                    echo "for pick up";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text-right">
                                                                <a href="order_details.php?id=<?php echo $transaction['ReservationNo']?>">
                                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="footer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Email Statistics</h4>
                                <p class="category">Last Campaign Performance</p>
                            </div>
                            <div class="content">
                                <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Open
                                        <i class="fa fa-circle text-danger"></i> Bounce
                                        <i class="fa fa-circle text-warning"></i> Unsubscribe
                                        <i class="fa fa-circle text-success"></i> Unsubscribe
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Users Behavior</h4>
                                <p class="category">24 Hours performance</p>
                            </div>
                            <div class="content">
                                <div id="chartHours" class="ct-chart" style="overflow:scroll"></div>
                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Open
                                        <i class="fa fa-circle text-danger"></i> Click
                                        <i class="fa fa-circle text-warning"></i> Click Second Time
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Updated 3 minutes ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">2014 Sales</h4>
                                <p class="category">All products including Taxes</p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart"></div>

                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Tesla Model S
                                        <i class="fa fa-circle text-danger"></i> BMW 5 Series
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-check"></i> Data information certified
                                    </div>
                                </div>
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


</body>

    <!--   Core JS Files   -->
    <script src="../../../assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="../../../assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="../../../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../../../assets/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="../../../assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! 
-->
    <script src="../../../assets/js/demo.js"></script>

	<script type="text/javascript">
    	$(document).ready(function(){
            var dataPreferences = {
                series: [
                    [25, 30, 20, 25]
                ]
            };

            var optionsPreferences = {
                donut: true,
                donutWidth: 40,
                startAngle: 0,
                total: 100,
                showLabel: false,
                axisX: {
                    showGrid: false
                }
            };

            Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences);

            Chartist.Pie('#chartPreferences', {
            labels: ['qwe%','qwe%','25%','hehe'],
            series: [50, 25, 12,13]
            });
        	// demo.initChartist();
            <?php
                if($forDelivery > 0) {
                    ?>
                    $.notify({
                        icon: 'pe-7s-car',
                        message: "<b><?php echo $forDelivery?> orders</b> for Delivery"
                    },{
                        type: 'danger',
                        timer: 4000
                    });
                    <?php
                }
                if($forPickup > 0){
                    ?>
                    $.notify({
                        icon: 'pe-7s-cash',
                        message: "<b><?php echo $forPickup?> orders</b> for Pickup"
        
                    },{
                        type: 'info',
                        timer: 4000
                    });
                    <?php
                    
                }
            ?>

        });
	</script>
</html>
