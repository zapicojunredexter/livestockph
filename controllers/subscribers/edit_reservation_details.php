<?php
    include_once('../../utils/session_functions.php');
    include_once('../../utils/db_conn.php');
    $response = new stdClass();
    $response -> Status = "Error";
    $erroredItems = "";
    if(sizeof($_POST)>0){
        
        $reservationDetailsId = array_keys($_POST);
        $newQuantity = array_values($_POST);
        $records = getRecords("SELECT * FROM reservationdetails reservationdetail,obbatches batch, ownerbreeds obreed,
        breeds breed, categories category WHERE category.CategoryId = breed.CategoryId AND
        breed.BreedId = obreed.BreedId AND obreed.OwnerBreedId = batch.OwnerBreedId ANd batch.BatchId = reservationdetail.BatchId AND 
        reservationdetail.ReservDetailNo IN (".implode(',', array_map('intval', $reservationDetailsId)).")");

        $canProceed = true;
        $i=0;
        foreach($records as $record){
            if($record['Stock']<$newQuantity[$i++]){
                $erroredItems = $record['CategoryDescription']." - ".$record['BreedDescription'].",".$erroredItems;
                $canProceed = false;
            }
        }

        if($canProceed){
            for($i = 0; $i<sizeof($reservationDetailsId); $i++){
                $quantity = $newQuantity[$i];
                $reservationId = $reservationDetailsId[$i];
                setRecord("UPDATE reservationdetails SET Quantity = $quantity WHERE ReservDetailNo = $reservationId");
            }
            $response -> Status = "Success";
        }else{
            $response -> Status = "Inventory Error for ".$erroredItems;
        }
    }
    echo json_encode($response);
?>