<?php
    require_once('../../utils/db_conn.php');
    $targetfolder = "./";

    $targetfolder = $targetfolder . basename( $_FILES['fileToUpload']['name']) ;
    $companyId = $_POST['companyId'];
    $file_type=$_FILES['fileToUpload']['type'];
    echo $file_type;
    if($file_type=="image/jpeg" ||$file_type=="image/jpg" || $file_type=="image/png") {
        $temp = explode(".", $_FILES["fileToUpload"]["name"]);
        $newfilename = $companyId."-".round(microtime(true)) . '.' . end($temp);
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "../../files/images/products/" . $newfilename)){
            echo "The file ".$newfilename. " is uploaded";
            $filePath = "../../files/documents/" . $newfilename;
        } else {
            header("location:".$_SERVER["HTTP_REFERER"]."&message=Problem uploading file");
            return;
        }

    } else {
        header("location:".$_SERVER["HTTP_REFERER"]."&message=You may only upload PDFs, JPEGs or GIF files");
        return;
    }
    $batchId = $_POST['BatchId'];
    setRecord("INSERT INTO productimages (ImagePath, BatchId, SupplierId)
    VALUES ('$newfilename',$batchId,$companyId)");
    header("location:".$_SERVER["HTTP_REFERER"]."&message=Success");
?>