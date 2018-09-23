<?php
    require_once('../../utils/db_conn.php');
    require_once('../../utils/session_functions.php');
    $response = new stdClass();
    $response->Status = "Failed";
    $erroredItems = "";
    if(sizeof($_POST)>0){
        $batchIds = $_POST['BatchId'];
        $quantities = $_POST['Quantity'];
        
        $checkInventory = getRecords("SELECT * from obbatches batch,
        ownerbreeds obreed, breeds breed, categories category WHERE category.CategoryId = breed.CategoryId
        AND breed.BreedId AND obreed.BreedId = breed.BreedId AND obreed.OwnerBreedId = batch.OwnerBreedId 
        AND batch.BatchId IN (".implode(',', array_map('intval', $batchIds)).")");

        $canProceed = true;
        foreach($checkInventory as $inventory){
            for($i = 0; $i<sizeof($batchIds);$i++){
                if($batchIds[$i] === $inventory['BatchId']){
                    if($quantities[$i]>$inventory['Stock']){
                        $erroredItems = $inventory['CategoryDescription']." - ".$inventory['BreedDescription'].",".$erroredItems;
                        $canProceed = false;
                    }
                }
            }
        }
        if($canProceed){
            $toBeDelivered = isset($_POST['ToBeDelivered']) ? 1 : 0;
            $supplierNo = $_POST['SupplierNo'];
            $buyerNo  = $_SESSION['account_id'];
            $expectedAmount = $_POST['ExpectedAmount'];
            $description = $_POST['ReservationDescription'];
            $response->Status = "Success";
    
            $reservationId = setRecord("INSERT INTO reservations (BuyerNo,ToBeDelivered,ExpectedAmount,SupplierNo,ReservationDescription) VALUES 
            ($buyerNo,$toBeDelivered,$expectedAmount,$supplierNo,'$description')");
    
            $cartItemsLength = sizeof($batchIds);
    
            for($i = 0; $i<$cartItemsLength; $i++){
                $quantity = $quantities[$i];
                $batchId = $batchIds[$i];
                setRecord("INSERT INTO reservationdetails (Quantity,BatchId,OrderNo) VALUES 
                ($quantity,$batchId,$reservationId)");
                setRecord("UPDATE obbatches SET Stock = Stock - $quantity WHERE BatchId = $batchId");
            }

            $buyerName = $_SESSION['account_last_name'].", ".$_SESSION['account_name'];
            $message = "A new order has been made by ".$buyerName;
            require_once '../../vendor/autoload.php';

            //create client with api key and secret
            $client = new Nexmo\Client(new Nexmo\Client\Credentials\Basic("72769a3f", "4KRNM9FTZ4AsLZ7E"));

            //send message using simple api params
            $toNumber = "+639569006808";
            $from = "LiveStockPH";

            //an invalid request
            try{
                
            $message = $client->message()->send([
                'to' => $toNumber,
                'from' => $from,
                'text' => $message
            ]);
            } catch (Nexmo\Client\Exception\Request $e) {
                //can still get the API response
            }
            // include_once('../../sms_module/send.php');
        }else{

            $response->Status = "Inventory Error for ".$erroredItems;
        }
    }
    
    echo json_encode($response);
?>