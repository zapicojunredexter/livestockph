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
        $dob = $_POST['DOB'];
        setRecord("INSERT INTO obbatches (OwnerBreedId,Stock,AverageWeight,PricePerKilo,DOB)
            VALUES ($ownerBreedId,$stock,$averageWeight,$pricePerKilo,'$dob')");
        $response -> Status = "Successfully Added";

    }
    echo json_encode($response);
?>