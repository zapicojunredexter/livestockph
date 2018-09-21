<!doctype html>
<html lang="en">
<head>

    <?php
        require_once('../../components/subscribers_main_header.php');
        require_once('../../../utils/db_conn.php');
        require_once('../../../utils/session_functions.php');
        $reservationId = $_GET['id'];
        $order = getRecord("SELECT * FROM reservations reservation, livestockbuyers buyer
        WHERE reservation.BuyerNo = buyer.BuyerNo AND reservation.ReservationNo = $reservationId");
        $orderDetails = getRecords("SELECT *, FLOOR(DATEDIFF(CURDATE(),batch.DOB)/30) AS MonthsOld FROM reservationdetails details,
        obbatches batch, ownerbreeds obreed, breeds breed, categories category
        WHERE category.CategoryId = breed.CategoryId AND breed.BreedId = obreed.BreedId
        AND obreed.OwnerBreedId = batch.OwnerBreedId
        AND batch.BatchId = details.BatchId AND details.OrderNo = $reservationId");
        $orderStatus = $order['Status'];
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
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                     <a href="#">
                                        <img class="avatar border-gray" src="../../../assets/img/faces/face-3.jpg" alt="..."/>

                                    </a>
                                      <h4 class="title"><?php echo $order['BuyerLName'].", ".$order['BuyerFName']?><br />
                                         <small><?php echo $order['ContactNo']?></small>
                                      </h4>
                                </div>
                                <p class="description text-center">
                                <?php
                                    echo $order['Street']." ".$order['City']." ".$order['Province']." ".$order['ZipCode'];
                                ?>
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Reservation Details</h4>
                            </div>
                            <div class="content">
                                <form method="post" action="../../../controllers/subscribers/edit_order_details.php">
                                    <input type="hidden" name="ReservationId" value="<?php echo $reservationId?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date Reserved (disabled)</label>
                                                <input type="text" class="form-control" disabled placeholder="Company" value="<?php echo $order['DateReserved']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <input type="text" class="form-control" disabled placeholder="Company" value="<?php
                                                    if($orderStatus === 0){
                                                        echo "Pending";
                                                    }else{
                                                        echo "Closed";
                                                    }
                                                ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Expected Amount (disabled)</label>
                                                <input type="text" class="form-control" disabled placeholder="Home Address" value="<?php echo $order['ExpectedAmount']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Actual Amount</label>
                                                <input name="ActualAmount" type="text" class="form-control" placeholder="Actual Price" value="<?php echo $order['ActualAmount']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Reservation Details (disabled)</label>
                                                <textarea disabled class="form-control" style="height: 100px;">
                                                    <?php echo $order['ReservationDescription']?>
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-warning pull-right" <?php echo $orderStatus===0?"":"disabled"?>>Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Cart Details</h4>
                            </div>
                            <div class="content">
                                <form id="editCartDetails">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>Price/kg</th>
                                                <th>Average Weight</th>
                                                <th>Months Old</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($orderDetails as $detail){
                                                    ?>
                                                    <tr>
                                                        <td>IMG</td>
                                                        <td><?php echo $detail['CategoryDescription']." ".$detail['BreedDescription']?></td>
                                                        <td>
                                                            <input min="0" max="<?php echo $detail['Stock']?>" name="<?php echo $detail['ReservDetailNo']?>" type="number" value="<?php echo $detail['Quantity']?>" class="form-control" style="width:80px;">
                                                            <?php //echo $detail['Quantity']." out of ".$detail['Stock']?>
                                                        </td>
                                                        <td><?php echo $detail['PricePerKilo']?></td>
                                                        <td><?php echo $detail['AverageWeight']?></td>
                                                        <td><?php echo $detail['MonthsOld']?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <input type="button" value="EDIT" onclick="editCartDetails()">
                                </form>
                                <script>
                                    function editCartDetails(){
                                                                        
                                        $.ajax({
                                            method: 'post',
                                            url: "../../../controllers/subscribers/edit_reservation_details.php",
                                            data: $('#editCartDetails').serialize(),
                                            success: function(result){
                                                console.log(result);
                                                var jsonResult = JSON.parse(result);
                                                if(jsonResult.Status=='Success'){
                                                    alert("Successfully edited");
                                                    window.location.reload();
                                                }else{
                                                    alert(jsonResult.Status);
                                                }
                                            },
                                            fail: function(result){
                                                console.log(result);
                                            }
                                        });
                                    }
                                </script>
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
