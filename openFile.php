<?php
    session_start();
    $username = $_SESSION['username'];
    if ( !preg_match('/^[\w_\-]+$/', $username)) {
            echo "Invalid username";
            exit;
    }
    $filename=$_POST["openFiles"];
    if ( !preg_match('/^[\w_\.\-]+$/', $filename)) {
        echo "Invalid filename";
        exit;
    }
    // open file
    $fileLocation = sprintf("/home/donaldshen/M2data/users/%s/files/%s", $username, $filename);  
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($fileLocation);
    header("Content-Type: ".$mime);
    readfile($fileLocation);
?>