<?php
    require_once('../../utils/db_conn.php');
    require_once('../../utils/session_functions.php');
    $response = new stdClass();
    $response->Status = "Failed";
    $companyId = $_SESSION['account_company'];
    $erroredItems = "";
    if(sizeof($_POST)>0){
        
        $checkInventory = getRecords("SELECT * from obbatches batch,
        ownerbreeds obreed, breeds breed, categories category WHERE category.CategoryId = breed.CategoryId
        AND breed.BreedId AND obreed.BreedId = breed.BreedId AND obreed.OwnerBreedId = batch.OwnerBreedId 
        AND obreed.SupplierNo = $companyId");

        $canProceed = true;
        $cart = [];
        foreach($checkInventory as $inventory){
            $quantity = isset($_POST['QuantityBatchId'.$inventory['BatchId']])?$_POST['QuantityBatchId'.$inventory['BatchId']]:null;
            if($quantity > 0){
                if($inventory['Stock'] >= $quantity){
                    $cartItem = new stdClass();
                    $cartItem -> BatchId = $inventory['BatchId'];
                    $cartItem -> Quantity = $quantity;
                    array_push($cart, $cartItem);
                } else {
                    $erroredItems = $inventory['CategoryDescription']." - ".$inventory['BreedDescription'].",".$erroredItems;
                    $canProceed = false;
                }
            }
        }
        
        if($canProceed){
            $toBeDelivered = isset($_POST['ToBeDelivered']) ? 1 : 0;
            $status = -1; // because closed siya nga walk in
            $supplierNo = $companyId;
            $buyerNo  = -1;
            $expectedAmount = $_POST['ExpectedAmount'];
            $actualAmount = $_POST['ActualAmount'];
            $description = $_POST['ReservationDescription'];
            $closedBy = $_POST['ClosedBy'];
            
            $reservationId = setRecord("INSERT INTO reservations
            (Status,BuyerNo,ToBeDelivered,ExpectedAmount,ActualAmount,SupplierNo,ReservationDescription,ClosedBy) VALUES 
            ($status,$buyerNo,$toBeDelivered,$expectedAmount,$actualAmount,$supplierNo,'$description',$closedBy)");
    
            foreach($cart as $cartItem){
                setRecord("INSERT INTO reservationdetails (Quantity,BatchId,OrderNo) VALUES 
                ($cartItem->Quantity,$cartItem->BatchId,$reservationId)");
                setRecord("UPDATE obbatches SET Stock = Stock - $quantity WHERE BatchId = $cartItem->BatchId");
            }

            $buyerFName = $_POST['BuyerFName'] !== "" ? $_POST['BuyerFName']: '-';
            $buyerLName = $_POST['BuyerLName'] !== "" ? $_POST['BuyerLName']: '-';
            $contactNo = $_POST['ContactNo'] !== "" ? $_POST['ContactNo']: '-';
            $city = $_POST['City'] !== "" ? $_POST['City']: '-';
            $province = $_POST['Province'] !== "" ? $_POST['Province']: '-';
            $street = $_POST['Street'] !== "" ? $_POST['Street']: '-';
            $zipCode = $_POST['ZipCode'] !== "" ? $_POST['ZipCode']: '-';
            $buyerId = setRecord("INSERT INTO livestockbuyers (BuyerFName,BuyerLName,ContactNo,City,Province,Street,ZipCode)
            VALUES ('$buyerFName','$buyerLName','$contactNo','$city','$province','$street','$zipCode')");
        
            setRecord("UPDATE reservations SET BuyerNo = $buyerId WHERE ReservationNo = $reservationId");

            $response->Status = "Success";
        }else{

            $response->Status = "Inventory Error for ".$erroredItems;
        }

    }
    
    echo json_encode($response);
?>