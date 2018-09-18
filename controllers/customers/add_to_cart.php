<?php
    include_once('../../utils/session_functions.php');

    function isItemInCart($value, $array){
        return in_array($value, $array);
    }

    $companyId = $_POST['SupplierNo'];
    $batchId = $_POST['BatchId'];

    $newCartItem = new stdClass();
    $newCartItem -> BatchId = $batchId;
    if(!isset($_SESSION['cart_items']) || ($_SESSION['cart_items'])==0){
        $_SESSION['cart_items'] = [];
    }
    $response = new stdClass();
    if(isset($_SESSION['cart_company'])){
        if($_SESSION['cart_company'] == $companyId){
            if(!isItemInCart($batchId,array_column($_SESSION['cart_items'],"BatchId"))){
                array_push($_SESSION['cart_items'],$newCartItem);
                $response -> Message = "Successfully Added";      
            }else{
                $response -> Message = "Item is already in cart";  
            }
        }else{
            $response -> Message = "Already selected Items from another supplier";
        }
    }else{
        if(!isItemInCart($batchId,array_column($_SESSION['cart_items'],"BatchId"))){
            $_SESSION['cart_company'] = $companyId;
            array_push($_SESSION['cart_items'],$newCartItem);
            $response -> Message = "Successfully Added";    
        }else{
            $response -> Message = "Item is already in cart";  
        }
    }
    echo json_encode($response);
?>