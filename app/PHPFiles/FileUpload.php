<?php
function uploadFile() {
    $response = array();
    
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(!empty($_FILES['upload']['name'])) {
            $FileName = $_FILES['upload']['name'];
            // $FileSize = $_FILES['upload']['size'];
            $FileTmp = $_FILES['upload']['tmp_name'];
            $target = "Uploads/$FileName";
            if(move_uploaded_file($FileTmp, $target)) {
                $response['success'] = true;
                $response['message'] = 'File uploaded successfully';
            } else {
                $response['success'] = false;
                $response['message'] = 'Error occurred while uploading file';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Please choose an image';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'No file submitted';
    }

    return $response;
}
?>