<!doctype html>
<html lang="en">
<head>

    <?php
        require_once('../../components/subscribers_main_header.php');
        require_once('../../../utils/db_conn.php');
        require_once('../../../utils/session_functions.php');
        $accountId = $_SESSION['account_id'];
        $user = getRecord("SELECT * FROM employees e, livestocksuppliers l WHERE l.SupplierNo = e.SupplierNo AND e.EmployeeNo = $accountId");
        $companyId = $user['SupplierNo'];
        $certificates = getRecords("SELECT * FROM certificates WHERE SupplierNo = $companyId");
        $employees = getRecords("SELECT * FROM employees e, livestocksuppliers l WHERE l.SupplierNo = e.SupplierNo AND l.SupplierNo = $companyId");
    ?>

</head>
<body>


    <div class="modal" tabindex="-1" role="dialog" id="addDocumentsModal">
        <div class="modal-dialog" role="document">
            <form target="_blank" action="../../../controllers/subscribers/upload_documents.php" method="post" enctype="multipart/form-data">
                    
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Documents</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="content">
                            <div class="form-group">
                                <label>SELECT FIle (PDF / Images only)</label>
                                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>name</label>
                                <input type="text" name="CertificateName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>issued by</label>
                                <input type="text" name="IssuedBy" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>date issued</label>
                                <input type="date" name="DateIssued" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>valid until</label>
                                <input type="date" name="Expiration" class="form-control">
                            </div>
                        </div>
                    </div>
                        <input type="hidden" name="companyId" value="<?php echo $companyId; ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="$('#addDocumentsModal').modal('hide')" class="btn btn-success">UPLOAD DOCUMENT</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="addEmployeeModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addEmployeeForm">
                    <div class="modal-header">
                        <h5 class="modal-title">ADD NEW EMPLOYEE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="header">EMPLOYEE DETAILS</div>
                            <div class="content">
                                <div class="form-group">
                                    <label>First name</label>
                                    <input type="text" class="form-control" placeholder ="Employee First Name" name="EmpFName">
                                </div>
                            
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input type="text" class="form-control" placeholder="Employee Last Name" name="EmpLName">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="header">ACCOUNT DETAILS</div>
                            <div class="content">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" placeholder="Username" name="Username">
                                </div>
                            
                                <div class="form-group">
                                    <label>Password</label>
                                        <input type="text" class="form-control" placeholder="Password" name="Password">
                                </div>
                            </div>
                        </div>
                        <br>
                        <input type="hidden" value="<?php echo $companyId; ?>" name="SupplierNo">

                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="addEmployee()" class="btn btn-success">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function addEmployee(){
          $.ajax({
              method: 'post',
              url: "../../../controllers/subscribers/add_employee.php",
              data: $('#addEmployeeForm').serialize(),
              success: function(result){
                  var jsonResult = JSON.parse(result);
                  if(jsonResult.Status=='Successfully Added'){
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
                    <a class="navbar-brand" href="#">User</a>
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
            <?php
                require_once '../generic/check_expiry.php';
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Company Details</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Company</label>
                                                <input type="text" class="form-control" placeholder="Company" value="<?php echo $user['SupplierName']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Street</label>
                                                <input type="text" class="form-control" placeholder="Home Address" value="<?php echo $user['Street']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Province</label>
                                                <input type="text" class="form-control" placeholder="City" value="<?php echo $user['Province']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control" placeholder="Country" value="<?php echo $user['City']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Zip Code</label>
                                                <input type="number" class="form-control" placeholder="ZIP Code" value="<?php echo $user['ZipCode']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-warning pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h4 class="title" style="display:inline;">Delivery Settings</h4>
                            </div>
                            <div class="content">
                                
                                <form id="deliverySettingsForm">
                                    <div class="row" style="padding:10px 20px 10px 20px;">
                                        <label class="switch" style="margin-right: 10px;">
                                            <input name="AllowDelivery" onchange="onToggleDelivery(this)" type="checkbox" <?php echo ($user['DeliveryFee'] && $user['DeliveryDays']) ? "checked":"";?>>
                                            <span class="slider round"></span>
                                        </label>Allow Delivery?
                                    </div>
                                    <div id="toggleableSettings" style="display:<?php echo ($user['DeliveryFee'] && $user['DeliveryDays']) ? "block":"none";?>">
                                        <div class="form-group">
                                            <label>Delivery Fee</label>
                                            <input name="DeliveryFee" type="text" class="form-control" placeholder="PHP 0.00" value="<?php echo $user['DeliveryFee']; ?>">
                                        </div>
                                    </div>    
                                        <div class="form-group">
                                            <label>No. of days before order closes</label>
                                            
                                            <input type="number" min="0" name="DeliveryDays" class="form-control" placeholder="0 days" value="<?php echo $user['DeliveryDays']; ?>">
                                            
                                        </div>
                                    <input onclick="editSettings()" class="btn btn-warning pull-right" type="button" value="Update Settings">
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        function onToggleDelivery(toggle){
                            $('#toggleableSettings').toggle();
                            if(toggle.checked){
                            }else{
                            }
                        }
                        function editSettings(){
                            $.ajax({
                                method: 'post',
                                url: "../../../controllers/subscribers/edit_settings.php",
                                data: $('#deliverySettingsForm').serialize(),
                                success: function(result){
                                    console.log(result);
                                    var jsonResult = JSON.parse(result);
                                    if(jsonResult.Status=='Success'){
                                        alert("successfully edited");
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
                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h4 class="title" style="display:inline;">Company Documents</h4>
                                <img data-toggle="modal" data-target="#addDocumentsModal" src="../../../assets/img/icons/add_icon.gif" class="icon_small" alt="add">
                            </div>
                            <div class="content">
                                <ul>
                                    <?php
                                    foreach($certificates as $certificate){
                                        ?>
                                            <li><a target="_blank" href="../../../files/documents/view_document.php?id=<?php echo $certificate['CertificateNo']?>"><?php echo $certificate['CertificateName']?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title" style="display:inline;">Company Employees</h4>
                                <img data-toggle="modal" data-target="#addEmployeeModal" src="../../../assets/img/icons/add_icon.gif" class="icon_small" alt="add">

                            </div>
                            <div class="content table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                        <th>Employee Name</th>
                                        <th style="width:10px;">Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($employees as $employee){
                                                ?>
                                            <tr>
                                                <td><?php echo $employee['EmployeeNo']; ?></td>
                                                <td><?php echo $employee['EmpLName'].','.$employee['EmpFName']; ?></td>
                                                <td>q</td>
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
