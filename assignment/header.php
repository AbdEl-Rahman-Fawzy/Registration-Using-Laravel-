<?php
function uploadFile() {
    $response = array();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!empty($_FILES['upload']['name'])) {
            $FileName = $_FILES['upload']['name'];
            $FileTmp = $_FILES['upload']['tmp_name'];
            $target = "uploads/" . $FileName;
            if(move_uploaded_file($FileTmp, $target)) {
                $response['success'] = true;
                $response['message'] = 'File uploaded successfully';
                $response['target'] = $target;
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


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    uploadFile();
    return;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Index</title>
    <link rel="icon" href="registration-form.png">
    <link rel="stylesheet" href="edit.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#submitBtn").click(function (event) {
                event.preventDefault(); 
                var formData = new FormData();
                var fileInput = document.getElementById('upload');
                var file = fileInput.files[0];
                formData.append('upload', file);
                formData.append('full_name', $('#fullname').val());
                formData.append('user_name', $("#username").val());
                formData.append('email', $("#email").val());
                formData.append('phone', $("#phone").val());
                formData.append('pwd', $("#cpassword").val());
                formData.append('password', $("#password").val());
                formData.append('birthdate', $("#birth").val());

                $.ajax({
                    url: "upload.php",
                    type: "POST",
                    processData: false,
                    contentType: false,
                    data: formData,
                    dataType: "json",
                    success: function (response) {

                        var target = response.target;
                        console.log(target);
                        var formDataJSON = JSON.stringify({
                            "full_name": $('#fullname').val(),
                            "user_name": $("#username").val(),
                            "email": $("#email").val(),
                            "phone": $("#phone").val(),
                            "pwd": $("#cpassword").val(),
                            "password": $("#password").val(),
                            "birthdate": $("#birth").val(),
                            "image": target,
                        });


                        $.ajax({
                            url: "http://localhost:8000/api/auth",
                            type: "POST",
                            headers: {
                                "Accept": "application/json",
                                "Content-Type": "application/json",
                            },
                            data: formDataJSON,
                            success: function (response) {
                                console.log("Registration successful:", response);
                                $("#successMessage").text("Registration successful!");
                            },
                            error: function (error) {
                                console.error("Registration error:", error);
                                $("#errorMessage").text("Registration error. Please try again later.");
                            }
                        });
                    },
                    error: function (error) {
                        console.error("Error occurred while uploading file:", error);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <header>
        <a href="index.html" title="Go To Registration Page"><img src="registration-form.png" alt="Register" width="70"></a>
    </header>
    <div class="heading">
        <h2>Registration</h2>
    </div>

</body>
</html>
