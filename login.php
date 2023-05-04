<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <title>Login</title>


</head>

<body>
    <?php
    require_once "connect.php";
    require "validation.php";

    if (isset($_POST["submit"])) {
        $pass = validate($_POST['pass']);
        $email = validate($_POST['email']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Please enter a valid email')</script>";

            header("Refresh:0");
        } else {

            $sql = "SELECT * FROM formtable where Email='$email' AND pass ='$pass' ";
            $response = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($response);

            if ((int) $row === 1) {
                echo "<script>alert('Login Successfull !!')</script>";
            } else {
                echo "<script>alert('Incorrect Email or Password!')</script>";
            }
        }
    }
    ?>
    <div class="form-div">
        <form action="" method="post" name="loginForm" onsubmit="return validateForm()">
            <h3>Fill Login Details</h3>
            <div class="data-field">
                <label>Email:</label>
                <input type="email" name="email" required /><br />
            </div>

            <div class="data-field">
                <label>Password:</label>
                <input name="pass" id="pass" required /><br />
            </div>

            <div class="data-field">
                <button type="submit" value="submit" name="submit"
                    style="color: rgb(255, 248, 248); border: 1px solid black;background: #0c81f6;border-radius: 2px;font-size:large;margin-left:15rem;margin-top:-2rem; padding:2px;text-decoration:none;font:bolder">Login</button>
            </div>
        </form>

    </div>
    <script>
        function validateForm() {

            var email = document.forms["login"]["email"].value;
            var password = document.forms["login"]["pass"].value;
            if (email == "" || password == "") {
                alert("Fill Both Fields!!");
                return false;
            }
        }
        <script />