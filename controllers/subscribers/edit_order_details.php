<?php
    include_once('../../utils/session_functions.php');
    include_once('../../utils/db_conn.php');
    if(sizeof($_POST)>0){
        $reservationId = $_POST['ReservationId'];
        $actualAmount = $_POST['ActualAmount'];
        $closedBy = $_POST['ClosedBy'];
        $newStatus = 1;
        setRecord("UPDATE reservations SET ActualAmount = $actualAmount, Status = $newStatus,
        ClosedBy = $closedBy WHERE ReservationNo = $reservationId");
    }
    header("location:".$_SERVER["HTTP_REFERER"]."&message=Success");
?>