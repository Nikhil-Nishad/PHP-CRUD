<?php
// Importing Validation File  >>>>>>>>>>>>>>>>>>>>>>>>>>>
require "validation.php";
require "connect.php";

if (isset($_POST["submit"])) {


    // Validating and storing Data from form to Variables  >>>>>>>>>>>>>>>>>>>>>>>>>>>
    $name = validate($_POST['name']);
    $pass = validate($_POST['pass']);
    $email = validate($_POST['email']);
    $gender = $_POST['gender'];
    $qualification = $_POST['qualification'];
    $qual = implode(",", $qualification);
    $options = $_POST['options'];



    // Image storing in Database >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {

        $file_name = $_FILES["photo"]["name"];
        $file_size = $_FILES["photo"]["size"];
        $file_tmp_name = $_FILES["photo"]["tmp_name"];
        $file_error = $_FILES["photo"]["error"];
        $file_loc = $_FILES["photo"]["tmp_name"];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $path = "uploads/" . $name . "." . $file_ext;

        if (empty($file_error) == true) {
            move_uploaded_file($file_loc, "uploads/" . $file_name . "." . $file_ext);
        }
    }

    // Sql Insert Query  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    $sql = "INSERT INTO formtable (id, Name, pass, Email, Gender, Qualification, Options, Image) VALUES (NULL, '$name', '$pass','$email', '$gender', '$qual','$options', '$path')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
    alert('New record created successfully')
    </scri>";

        //redirect to next page
        header("Location:profile.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}