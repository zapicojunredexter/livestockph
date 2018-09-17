<?php
    include_once('../../utils/session_functions.php');
    include_once('../../utils/db_conn.php');
    $response = new stdClass();
    $response -> Status = "Server Error";
    if(sizeof($_POST)>0){
        $supplierNo = $_POST['SupplierNo'];
        $breedId = $_POST['BreedId'];
    
        $checkExisting = getRecord("SELECT * FROM ownerbreeds WHERE SupplierNo = $supplierNo AND BreedId = $breedId");
        if($checkExisting){
            $response -> Status = "Record Already Exists";
        }else{
            setRecord("INSERT INTO ownerbreeds (SupplierNo,BreedId) VALUES ($supplierNo,$breedId)");
            $response -> Status = "Successfully Added";
        }

    }
    echo json_encode($response);
?>