<?php
    include_once('../../utils/session_functions.php');
    include_once('../../utils/db_conn.php');
    $response = new stdClass();
    $response -> Status = "SQL Error";
    if(sizeof($_POST)>0){
        $ownerBreedId = $_POST['OwnerBreedId'];
        $pregnantUnits = $_POST['PregnantUnits'];
        $newStatus = 1;
        setRecord("UPDATE ownerbreeds SET PregnantUnits = $pregnantUnits
        WHERE OwnerBreedId = $ownerBreedId");
    $response -> Status = "Success";
    }
    echo json_encode($response);
?>