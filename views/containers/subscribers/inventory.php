<!doctype html>
<html lang="en">
<head>

    <?php
        require_once('../../components/subscribers_main_header.php');
        require_once('../../../utils/db_conn.php');
        require_once('../../../utils/session_functions.php');

        $categories = getRecords("SELECT * FROM categories");
        $breeds = getRecords("SELECT * FROM breeds");
        $companyId = $_SESSION['account_company'];
        $productsOffered = getRecords("SELECT * FROM ownerbreeds o,breeds b,categories c WHERE
        c.CategoryId = b.CategoryId AND b.BreedId = o.BreedId AND o.SupplierNo = $companyId");

        $productBatches = getRecords("SELECT * FROM obbatches batch, ownerbreeds ownerbreed, breeds breed, categories category,
        livestocksuppliers supp WHERE category.CategoryId = breed.CategoryId AND breed.BreedId = ownerbreed.BreedId AND
        supp.SupplierNo = ownerbreed.SupplierNo AND ownerbreed.OwnerBreedId = batch.OwnerBreedId AND supp.SupplierNo = $companyId");
    ?>

</head>
<body>
    
    <div class="modal" tabindex="-1" role="dialog" id="editOfferedProductsModal">
        <div class="modal-dialog" role="document">
            <form id="editOfferedProductsForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">EDIT PRODUCTS OFFERED</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="OwnerBreedId" name="OwnerBreedId">
                        <div class="card" style="margin-bottom:10px;">
                            <div class="content">
                                <div class="form-group">
                                    <label>CATEGORY</label>
                                    <input id="CategoryDescription" type="text" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Breed</label>
                                    <input id="BreedDescription" type="text" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>No. of Pregnant units</label>
                                    <input min="0" id="PregnantUnits" name="PregnantUnits" type="number" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" onclick="submitEditOfferedProducts()" class="btn btn-success">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function editOfferedProduct(object){
            $('#OwnerBreedId').val(object.OwnerBreedId);
            $('#CategoryDescription').val(object.CategoryDescription);
            $('#BreedDescription').val(object.BreedDescription);
            $('#PregnantUnits').val(object.PregnantUnits);
            $('#editOfferedProductsModal').modal('show');
        }
        function submitEditOfferedProducts(){
            $.ajax({
                method: 'post',
                url: "../../../controllers/subscribers/edit_offered_products.php",
                data: $('#editOfferedProductsForm').serialize(),
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
    <div class="modal" tabindex="-1" role="dialog" id="addProductsOfferedModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addProductsOfferedForm">
                    <div class="modal-header">
                        <h5 class="modal-title">ADD PRODUCTS OFFERED</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <input type="hidden" name="SupplierNo" value="<?php echo $companyId?>" />
                        <div class="card">
                            <div class="content">
                                <div class="form-group">
                                    <label>CATEGORY</label>
                                <select onchange="onChangeCategory(this.value)" class="form-control">
                                    <option value=""></option>
                                    <?php
                                        foreach($categories as $category){
                                            ?>
                                        <option value="<?php echo $category['CategoryId']?>"><?php echo $category['CategoryDescription']?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                </div>
                                <div class="form-group">
                                    <label>BREED</label>
                                    <select name="BreedId" id="selectBreed" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="addProductsOffered()" class="btn btn-success">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="addInventoryModal">
        <div class="modal-dialog" role="document">
            <form id="addInventoryBatchForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ADD INVENTORY</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="container">
                                <div class="row">
                                    <div class="form-group col-sm-12" style="margin-top:20px;">
                                        <label>Product</label>
                                        <select class="form-control" name="OwnerBreedId">
                                            <?php
                                            
                                            foreach($productsOffered as $offered){
                                                ?>

                                                    <option value="<?php echo $offered['OwnerBreedId']?>"><?php echo $offered['CategoryDescription']." - ".$offered['BreedDescription']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-12" style="margin-top:20px;">
                                        <label>Description</label>
                                        <textarea name="Description" style="height: 100px;" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Initial Stock</label>
                                        <input type="number" name="Stock" placeholder="Initial Stock" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Average Weight</label>
                                        <input type="number" name="AverageWeight" placeholder="Average weight" class="form-control">
                                
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Price per kilo</label>
                                        <input type="number" name="PricePerKilo" placeholder="Price per kilo" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>DOB</label>
                                        <input type="date" name="DOB" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="addProductsBatch()" class="btn btn-success">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    
    <script>
        var categories = <?php echo json_encode($categories)?>;
        var breeds = <?php echo json_encode($breeds)?>;
        function onChangeCategoryForNewProduct(categoryId){
            $('#ownerBreedBatchIds').empty();
            for(var i = 0; i< breeds.length;i+=1){
                console.log(breeds[i]);
                if(breeds[i].CategoryId == categoryId){
                    $('#ownerBreedBatchIds').append("<option value='"+breeds[i].OwnerBreedId+"'>"+breeds[i].BreedDescription+"</option>");
                }
           }
        }
    </script>

    <script>
        function addBatchToOwnerBreed(ownerBreedId){
            $('#ownerBreedIdField').val(ownerBreedId)
            $('#addInventoryModal').modal('show')
        }
        function addProductsBatch(){
            $.ajax({
                method: 'post',
                url: "../../../controllers/subscribers/add_products_batch.php",
                data: $('#addInventoryBatchForm').serialize(),
                success: function(result){
                    console.log($('#addInventoryBatchForm').serialize());
                    console.log(result);
                    var jsonResult = JSON.parse(result);
                    
                    return;
                    if(jsonResult.Status=='Successfully Added'){
                        window.location.href="manage_batch.php?id="+jsonResult.BatchId;
                    }else{
                        alert(jsonResult.Status);
                    }
                },
                fail: function(result){
                    console.log(result);
                }
            });
        }
        function addProductsOffered(){
            $.ajax({
                method: 'post',
                url: "../../../controllers/subscribers/add_products_offered.php",
                data: $('#addProductsOfferedForm').serialize(),
                success: function(result){
                    console.log(result);
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
                        <a class="navbar-brand" href="#">Inventory</a>
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
                                    <h4 class="title" style="display:inline;">Products Offered</h4>
                                    <img data-toggle="modal" data-target="#addProductsOfferedModal" src="../../../assets/img/icons/add_icon.gif" class="icon_small" alt="">
                                </div>
                                <div class="content">
                                    <table class="table">
                                        <thead>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Breed</th>
                                            <th>No. of Pregnant Units</th>
                                            <th></th>
                                        </thead>
                                        
                                        <tbody>
                                            <?php
                                                $i = 0;
                                                foreach($productsOffered as $product){
                                                    ?>
                                                        <tr>
                                                            <td><?php echo ++$i;?></td>
                                                            <td><?php echo $product['CategoryDescription']?></td>
                                                            <td><?php echo $product['BreedDescription']?></td>
                                                            <td><?php echo $product['PregnantUnits']?></td>
                                                            <td>
                                                                <button onclick='editOfferedProduct(<?php echo json_encode($product)?>)' type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                    
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title" style="display:inline;">Inventory</h4>
                                    <img data-toggle="modal" data-target="#addInventoryModal" src="../../../assets/img/icons/add_icon.gif" class="icon_small" alt="">
                                </div>
                                <div class="content">

                                    
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Price per Kilo</th>
                                                <th>Average Weight</th>
                                                <th>Date of birth</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $i=0;
                                                    foreach($productBatches as $batch){
                                                        ?>
                                                            <tr onclick="window.open('./manage_batch.php?id=<?php echo $batch['BatchId'];?>')">
                                                                <td><?php echo $batch['BatchId']; ?></td>
                                                                <td><?php echo $batch['CategoryDescription'].' '.$batch['BreedDescription']; ?></td>
                                                                <td><?php echo $batch['Stock']; ?></td>
                                                                <td><?php echo $batch['PricePerKilo']; ?></td>
                                                                <td><?php echo $batch['AverageWeight']; ?></td>
                                                                <td><?php echo $batch['DOB']; ?></td>
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
            </div>

            <?php
                require_once('../../components/subscribers_main_footer.php');
            ?>

        </div>
    </div>



            <!--   Core JS Files   -->
    <script src="../../../assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="../../../assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../assets/js/chartist.min.js"></script>
    <script src="../../../assets/js/demo.js"></script>

    <script src="../../../assets/js/bootstrap-notify.js"></script>
    <script src="../../../assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    <script>
        var categories = <?php echo json_encode($categories)?>;
        var breeds = <?php echo json_encode($productsOffered)?>;
        function onChangeCategory(categoryId){
            $('#selectBreed').empty();
            for(var i = 0; i< breeds.length;i+=1){
                console.log(breeds[i]);
                if(breeds[i].CategoryId == categoryId){
                    $('#selectBreed').append("<option value='"+breeds[i].BreedId+"'>"+breeds[i].BreedDescription+"</option>");
                }
           }
        }
    </script>
</body>
</html>
