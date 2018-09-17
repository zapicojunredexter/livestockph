<?php
    $filename = "test.jpg";
    $certificateId = $_GET['id'];
    include_once('../../utils/db_conn.php');
    $certificates = getRecord("SELECT * FROM certificates WHERE CertificateNo = $certificateId");
    $fileName = $certificates['FileName'];
    header("location:".$fileName);
?>