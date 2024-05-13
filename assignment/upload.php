<?php
function uploadFile() {
    $response = array();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!empty($_FILES['upload']['name'])) {
            $FileName = $_FILES['upload']['name'];
            // $FileSize = $_FILES['upload']['size'];
            $FileTmp = $_FILES['upload']['tmp_name'];
            $target = "C:/xampp/htdocs/backendFawzy/assignment/Uploads/$FileName";
            if(move_uploaded_file($FileTmp, $target)) {
                $response['success'] = true;
                $response['message'] = 'File uploaded successfully';
                $response['target'] = $target; // إضافة اسم الملف إلى الرد
                echo json_encode($response);
                return;
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

    echo json_encode($response);
}

// استدعاء الفانكشن uploadFile() بمجرد استقبال الطلب POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    uploadFile();
    exit(); // توقيف التنفيذ بعد الاستدعاء لتجنب إرجاع محتوى الصفحة HTML مع الرد ال JSON
}
?>
