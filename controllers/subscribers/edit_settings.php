<?php
    include_once('../../utils/session_functions.php');
    include_once('../../utils/db_conn.php');
    $response = new stdClass();
    $response->Status = "Fail";
    if(sizeof($_POST)>0){
        $companyId = $_SESSION['account_company'];
        if(isset($_POST['AllowDelivery'])){
            $deliveryFee = $_POST['DeliveryFee'];
            $deliveryDays = $_POST['DeliveryDays'];
            setRecord("UPDATE livestocksuppliers SET DeliveryFee = $deliveryFee, DeliveryDays = $deliveryDays
            WHERE SupplierNo = $companyId");
            $response->Status = "Success";
        }else{
            $deliveryDays = $_POST['DeliveryDays'];
            setRecord("UPDATE livestocksuppliers SET DeliveryFee = null, DeliveryDays = $deliveryDays
            WHERE SupplierNo = $companyId");
            $response->Status = "Success";
        }
    }
    echo json_encode($response);
?>