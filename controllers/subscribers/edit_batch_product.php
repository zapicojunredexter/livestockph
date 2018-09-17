<?php
    include_once('../../utils/session_functions.php');
    include_once('../../utils/db_conn.php');
    if(sizeof($_POST)>0){
        $batchId = $_POST['BatchId'];
        $description = $_POST['Description'];
        $stock = $_POST['Stock'];
        $averageWeight = $_POST['AverageWeight'];
        $pricePerKilo = $_POST['PricePerKilo'];
        $dob = $_POST['DOB'];

        setRecord("UPDATE obbatches SET Description = '$description', Stock = $stock, AverageWeight = $averageWeight,
        PricePerKilo = $pricePerKilo,DOB = '$dob' WHERE BatchId = $batchId");
        echo $description.$stock.$averageWeight.$averageWeight.$pricePerKilo.$dob;
    }
    header("location:".$_SERVER["HTTP_REFERER"]."&message=Success");
?>