<?php
    include_once('../../utils/session_functions.php');
    include_once('../../utils/db_conn.php');
    $response = new stdClass();
    $response -> Status = "Server Error";
    if(sizeof($_POST)>0){
        $empFName = $_POST['EmpFName'];
        $empLName = $_POST['EmpLName'];
        $supplierNo = $_POST['SupplierNo'];

        $username = $_POST['Username'];
        $password = $_POST['Password'];

        $checkExistingUser = getRecord("SELECT * from accounts WHERE Username = '$username'");

        if(!$checkExistingUser){
            $employeeId = setRecord("INSERT INTO employees (EmpFName,EmpLName,SupplierNo) VALUES ('$empFName', '$empLName', $supplierNo)");

            $accountType = "Subscriber";
            setRecord("INSERT INTO accounts (Username, Password, AccountType, OwnerId) VALUES ('$username','$password','$accountType',$employeeId)");
            $response -> Status = "Successfully Added";
        }else{
            $response -> Status = "Username already in use";
        }

    }
    echo json_encode($response);
?>