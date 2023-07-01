<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "form_submit";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$targetDir = "uploads/"; // Directory where uploaded files will be stored

$targetFile = $targetDir . basename($_FILES["health_report"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if the file is a PDF
if ($fileType != "pdf") {
    echo "Only PDF files are allowed.";
    $uploadOk = 0;
}


if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["health_report"]["tmp_name"], $targetFile)) {
        echo "The file " . basename($_FILES["health_report"]["name"]) . " has been uploaded.";

        // Insert user details into the database
        $name = $_POST['name'];
        $age = $_POST['age'];
        $weight = $_POST['weight'];
        $email = $_POST['email'];

        // Insert the file path into the database
        $healthReportPath = $targetFile;

        $sql = "INSERT INTO users (name, age, weight, email, health_report_path)
                VALUES ('$name', '$age', '$weight', '$email', '$healthReportPath')";

        if (mysqli_query($conn, $sql)) {
            echo "User details inserted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


mysqli_close($conn);
?>
