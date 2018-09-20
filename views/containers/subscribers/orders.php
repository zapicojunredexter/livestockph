<!doctype html>
<html lang="en">
<head>

    <?php
        require_once('../../components/subscribers_main_header.php');
        require_once('../../../utils/db_conn.php');
        require_once('../../../utils/session_functions.php');
        $companyId = $_SESSION['account_company'];
        $orders = getRecords("SELECT * FROM reservations reservation,
        livestockbuyers buyer WHERE buyer.BuyerNo = reservation.BuyerNo
        AND reservation.SupplierNo = $companyId ORDER BY reservation.DateReserved DESC");

        $productBatches = getRecords("SELECT *, FLOOR(DATEDIFF(CURDATE(),batch.DOB)/30) AS MonthsOld FROM obbatches batch, ownerbreeds ownerbreed, breeds breed, categories category,
        livestocksuppliers supp WHERE category.CategoryId = breed.CategoryId AND breed.BreedId = ownerbreed.BreedId AND
        supp.SupplierNo = ownerbreed.SupplierNo AND ownerbreed.OwnerBreedId = batch.OwnerBreedId AND batch.Stock > 0
        AND supp.SupplierNo = $companyId");
        $testCompanies = getRecords("SELECT *,(SELECT BreedDescription FROM breeds WHERE BreedId = category.CategoryId LIMIT 10 ) AS BreedTest FROM categories category");
      
    ?>

</head>
<body>


    <div class="modal" tabindex="-1" role="dialog" id="addWalkin">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="addWalkinOrderForm">
                    <div class="modal-header">
                        <h5 class="modal-title">ADD WALKINS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                  

  
            <ul id="progressbar">
                <li id="customerLis" class="active" onclick="changePage(0)">Customer Details</li>
                <li id="checkoutLis" onclick="changePage(1)">Checkout</li>
                <li id="orderLis" onclick="changePage(2)">Order Details</li>
            </ul>
                        <div id="customerDiv">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Customer Details</h4>
                                </div>
                                <div class="content">  
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>FIRST NAME</label>
                                                <input name="BuyerFName" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>LAST NAME</label>
                                                <input name="BuyerLName" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>CONTACT NUMBER</label>
                                                <input name="ContactNo" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>STREET</label>
                                                <input name="Street" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>PROVINCE </label>
                                                <input name="Province" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>CITY </label>
                                                <input name="City" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>ZIP CODE</label>
                                                <input name="ZipCode" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="button" onclick="changePage(1)" class="btn btn-warning pull-right" style="width:100%">Next</button>
                                            
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>




                        </div>

                        
                        <div id="checkoutDiv" style="display:none;">
                        
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Cart Details</h4>
                                </div>
                                <div class="content">  
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Months Old</th>
                                                <th>Price Per Kilo</th>
                                                <th>Average Weight</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($productBatches as $product){
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $product['CategoryDescription']." - ".$product['BreedDescription']?></td>
                                                            <td><?php echo $product['MonthsOld']?></td>
                                                            <td><?php echo $product['PricePerKilo']?></td>
                                                            <td><?php echo $product['AverageWeight']?></td>
                                                            <td>
                                                                <input name="QuantityBatchId<?php echo $product['BatchId']?>" type="number" class="form-control pull-right" style="width:100px;">
                                                            </td>
                                                        </tr>
                                                    <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="row">
                                        <div class="col-sm-6">
                                            <button type="button" onclick="changePage(0)" class="btn btn-secondary" style="width:100%">Previous</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="button" onclick="changePage(2)" class="btn btn-warning pull-right" style="width:100%">Next</button>
                                            
                                        </div>
                                    </div>
                        </div>

                        <div id="orderDiv" style="display:none;">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Reservation Details</h4>
                                </div>
                                <div class="content">  
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date Reserved</label>
                                                <input type="text" value="<?php date('Y-m-d')?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Expected Amount </label>
                                                <input name="ExpectedAmount" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Actual Amount </label>
                                                <input name="ActualAmount" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Description </label>
                                                <textarea name="ReservationDescription" class="form-control" style="margin-bottom:20px;height:80px;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button type="button" onclick="changePage(1)" class="btn btn-secondary" style="width:100%">Previous</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="button" onclick="confirmCheckout()" class="btn btn-primary" style="width:100%">Save changes</button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                        </div>
                        
                        <script>
                            var divs = ['customerDiv','checkoutDiv','orderDiv'];
                            var lis = ['customerLis','checkoutLis','orderLis'];
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
                            function confirmCheckout(){
                                var addWalkinOrderDetails = $('#addWalkinOrderForm').serialize();
                                var confirmClear = confirm("Are you sure you want to submit items?");
                                if(confirmClear){
                                    $.ajax({
                                        method: 'post',
                                        data: addWalkinOrderDetails,
                                        url: "../../../controllers/subscribers/add_walkin_order.php",
                                        success: function(result){
                                            console.log(result);
                                            var JSONResult = JSON.parse(result);
                                            if(JSONResult.Status === "Success"){
                                                alert("Order confirmed");
                                                window.location.reload();
                                            }else{
                                                alert(JSONResult.Status);
                                            }
                                        },
                                        fail: function(result){
                                            console.log(result);
                                        }
                                    });
                                }
                            }
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
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
                    <a class="navbar-brand" href="#">Table List</a>
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






            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title" style="display:inline;">Order History</h4>
                                <img data-toggle="modal" data-target="#addWalkin" src="../../../assets/img/icons/add_icon.gif" class="icon_small" alt="">
                                <p class="category"></p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Customer Name</th>
                                    	<th>Transaction Date</th>
                                    	<th>Actual Amount</th>
                                    	<th>Status</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach($orders as $order){
                                            ?>
                                            <tr>
                                                <td><a href="order_details.php?id=<?php echo $order['ReservationNo']?>"><?php echo $order['ReservationNo']?></a></td>
                                                <td><?php echo $order['BuyerLName'].", ".$order['BuyerFName']?></td>
                                                <td><?php echo $order['DateReserved'] ?></td>
                                                <td><?php echo $order['ActualAmount']?'PHP'.$order['ActualAmount']:'Not Paid' ?></td>
                                                <td>
                                                    <?php
                                                        $status = $order['Status'];
                                                        $toBeDelivered = $order['ToBeDelivered'];
                                                        switch($status){
                                                            case 0:
                                                                if($toBeDelivered){
                                                                    echo "<span class='badge badge-danger'>for Delivery</span>";
                                                                }else{
                                                                    echo "<span class='badge badge-info'>for Pickup</span>";
                                                                }
                                                                break;
                                                            default:
                                                                echo "<span class='badge badge-secondary'>Closed</span>";
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>

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

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="../../../assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="../../../assets/js/demo.js"></script>


</html>
