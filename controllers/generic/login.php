<?php
    include_once('../../utils/session_functions.php');
    include_once('../../utils/db_conn.php');
    $response = new stdClass();
    if(isLoggedIn()){
        $response->Status = 'Already Logged In';
    }else{
        if(sizeof($_POST)>0){
            $username = $_POST['Username'];
            $password = $_POST['Password'];

            $account = getRecord("SELECT * FROM accounts WHERE Username = '$username'");
            if($account){
                if($account['Password'] == $password){
                    $ownerId = $account['OwnerId'];
                    if($account['AccountType'] == 'Customer'){
                        $customer = getRecord("SELECT * FROM livestockbuyers WHERE BuyerNo = $ownerId");
                                        
                        $_SESSION['account_id'] = $customer['BuyerNo'];
                        $_SESSION['account_name'] = $customer['BuyerFName'];
                        $_SESSION['account_last_name'] = $customer['BuyerFName'];
                        $response->Status = 'Success Buyer Account';
                    }else{
                        $subscriber = getRecord("SELECT * FROM employees e, livestocksuppliers l WHERE l.SupplierNo = e.EmployeeNo AND e.EmployeeNo = $ownerId");
                                        
                        $_SESSION['account_id'] = $subscriber['EmployeeNo'];
                        $_SESSION['account_name'] = $subscriber['EmpFName'];
                        $_SESSION['account_expiry'] = $subscriber['AccountExpiry'];
                        $_SESSION['account_company'] = $subscriber['SupplierNo'];
                        $response->Status = 'Success Subscriber Account';
                    }
                }else{
                    $response->Status = 'Credentials Mismatch';
                }
            }else{
                $response->Status = 'Username not found';
            }
        }else{
            $response->Status = 'No Data Sent';
        }
    }
    echo json_encode($response);
?>