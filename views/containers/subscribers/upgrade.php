<!doctype html>
<html lang="en">
<head>

    <?php
        require_once('../../components/subscribers_main_header.php');
        require_once('../../../utils/db_conn.php');
        require_once('../../../utils/session_functions.php');
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
                    <a class="navbar-brand" href="#">Upgrade</a>
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
					<div class="col-md-8 col-md-offset-2">
                        <div class="card">
                            <div class="header text-center">
                                <h4 class="title">Light Bootstrap Dashboard PRO</h4>
                                <p class="category">Are you looking for more components? Please check our Premium Version of Light Bootstrap Dashboard.</p>
								<br>
                            </div>
                            <div class="content table-responsive table-full-width table-upgrade">
                                <table class="table">
                                    <thead>
                                        <th></th>
                                    	<th class="text-center">Free</th>
                                    	<th class="text-center">PRO</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        	<td>Components</td>
                                        	<td>16</td>
                                        	<td>115+</td>
                                        </tr>
                                        <tr>
                                        	<td>Plugins</td>
                                        	<td>4</td>
                                        	<td>14+</td>
                                        </tr>
                                        <tr>
                                        	<td>Example Pages</td>
                                        	<td>4</td>
                                        	<td>22+</td>
                                        </tr>
                                        <tr>
                                        	<td>Documentation</td>
                                        	<td><i class="fa fa-times text-danger"></i></td>
                                        	<td><i class="fa fa-check text-success"></td>
                                        </tr>
                                        <tr>
                                        	<td>SASS Files</td>
											<td><i class="fa fa-times text-danger"></i></td>
                                        	<td><i class="fa fa-check text-success"></td>
                                        </tr>
                                        <tr>
                                        	<td>Login/Register/Lock Pages</td>
											<td><i class="fa fa-times text-danger"></i></td>
                                        	<td><i class="fa fa-check text-success"></td>
                                        </tr>
										<tr>
                                        	<td>Premium Support</td>
											<td><i class="fa fa-times text-danger"></i></td>
                                        	<td><i class="fa fa-check text-success"></td>
                                        </tr>
										<tr>
                                        	<td></td>
											<td>Free</td>
                                        	<td>Just $39</td>
                                        </tr>
										<tr>
											<td></td>
											<td>
												<a href="#" class="btn btn-round btn-fill btn-default disabled">Current Version</a>
											</td>
											<td>
												<a target="_blank" href="http://www.creative-tim.com/product/light-bootstrap-dashboard-pro/?ref=lbdupgrade" class="btn btn-round btn-fill btn-info">Upgrade to PRO</a>
											</td>
										</tr>
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
