<?php
    include_once('../../utils/session_functions.php');
    include_once('../../utils/db_conn.php');
    $response = new stdClass();
    $response -> Status = "Server Error";
    if(sizeof($_POST)>0){
        $ownerBreedId = $_POST['OwnerBreedId'];
        $stock = $_POST['Stock'];
        $averageWeight = $_POST['AverageWeight'];
        $pricePerKilo = $_POST['PricePerKilo'];
        $description = $_POST['Description'];
        $dob = $_POST['DOB'];
        $newBatchId = setRecord("INSERT INTO obbatches (OwnerBreedId,Stock,AverageWeight,PricePerKilo,DOB,Description)
            VALUES ($ownerBreedId,$stock,$averageWeight,$pricePerKilo,'$dob','$description')");
        $response -> Status = "Successfully Added";
        $response -> BatchId = $newBatchId;

    }
    echo json_encode($response);
?>