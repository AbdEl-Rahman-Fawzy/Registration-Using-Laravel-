<?php

// Function to establish database connection
function connectDB() {
    $conn = mysqli_connect("localhost", "root", "");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_select_db($conn, "usersdatabase");
    return $conn;
}

// Function to close database connection
function closeDB($conn) {
    mysqli_close($conn);
}

// Function to create database and table if they don't exist
function createDatabaseAndTable() {
    $conn = mysqli_connect("localhost", "root", "");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // MySQL database creation query
    $sql_create_db = "CREATE DATABASE IF NOT EXISTS usersdatabase";
    if (mysqli_query($conn, $sql_create_db)) {
        mysqli_select_db($conn, "usersdatabase");

        // Table creation query
        $sql_create_table = "CREATE TABLE IF NOT EXISTS users (
                                id INT AUTO_INCREMENT PRIMARY KEY,
                                full_name VARCHAR(50) NOT NULL,
                                user_name VARCHAR(50) UNIQUE NOT NULL,
                                birthdate DATE NOT NULL,
                                phone VARCHAR(15) NOT NULL,
                                address VARCHAR(50) NOT NULL,
                                pwd VARCHAR(255) NOT NULL,
                                email VARCHAR(100) UNIQUE NOT NULL,
                                user_image VARCHAR(255) NOT NULL
                            )";
        if (!mysqli_query($conn, $sql_create_table)) {
            echo "Error creating table: " . mysqli_error($conn);
        }
    } else {
        echo "Error creating database: " . mysqli_error($conn);
    }

    closeDB($conn);
}

// Function to handle form submission
function handleFormSubmission() {
    $conn = connectDB();
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $username = $_POST['username'];
        
        $sql_check_username = "SELECT * FROM users WHERE user_name = '$username'";
        $result = mysqli_query($conn, $sql_check_username);

        if (mysqli_num_rows($result) > 0) {
            echo json_encode(array("success" => false, "message" => "Username already exists. Please choose another username."));
            closeDB($conn);
            exit();
        }

        require_once 'upload.php';
        if(empty($_FILES['upload']['name'])){
            echo json_encode(array("success" => false, "message" => "No image uploaded."));
            closeDB($conn);
            exit();
        }

        // If username is unique and an image is uploaded, proceed with inserting user data into the database
        $full_name = $_POST['fullname'];
        $birthdate = $_POST['birth'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $user_image = isset($_FILES['upload']['name']) ? $_FILES['upload']['name'] : '';

        $sql_insert_user = "INSERT INTO users (full_name, user_name, birthdate, phone, adress, pwd, email, user_image)
                            VALUES ('$full_name', '$username', '$birthdate', '$phone', '$address', '$password', '$email', '$user_image')";

        // Execute the query and handle success or error
        if (mysqli_query($conn, $sql_insert_user)) {
            // Success response
            echo json_encode(array("success" => true, "message" => "Registered Successfully"));
        } else {

            // Error response
            echo json_encode(array("success" => false, "message" => "Error occurred while registering user: " . mysqli_error($conn)));
        }
        closeDB($conn);
        // Ensure that we exit after handling form submission to prevent further execution
        exit();
    }
   else{
    $response = array(
        "success" => false,
        "message" => "isset(s_POST[submit]) is false"
    );
    
    // Output the JSON response
    echo json_encode($response);
   }
}

createDatabaseAndTable();

handleFormSubmission();


?>
