<?php
    require_once('../../utils/db_conn.php');
    $targetfolder = "./";

    $targetfolder = $targetfolder . basename( $_FILES['fileToUpload']['name']) ;
    $companyId = $_POST['companyId'];
    $certificateName = $_POST['CertificateName'];
    $issuedBy = $_POST['IssuedBy'];
    $dateIssued = $_POST['DateIssued'];
    $expiration = $_POST['Expiration'];

    $file_type=$_FILES['fileToUpload']['type'];
    echo $file_type;
    if($file_type=="application/pdf" || $file_type=="image/gif" || $file_type=="image/jpg" || $file_type=="image/png") {
        $temp = explode(".", $_FILES["fileToUpload"]["name"]);
        $newfilename = $companyId."-".round(microtime(true)) . '.' . end($temp);
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "../../files/documents/" . $newfilename)){
            echo "The file ".$newfilename. " is uploaded";
            $filePath = "../../files/documents/" . $newfilename;
        } else {
            echo "Problem uploading file";
        }

    } else {
        echo "You may only upload PDFs, JPEGs or GIF files.<br>";
    }
    $certificateId = setRecord("INSERT INTO certificates (CertificateName, IssuedBy, DateIssued, Expiration, SupplierNo, FileName)
    VALUES ('$certificateName','$issuedBy','$dateIssued','$expiration',$companyId,'$newfilename')");
    header("location:../../files/documents/view_document.php?id=".$certificateId);
?>