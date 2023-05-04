<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <title>Form</title>
</head>

<body>
    <?php
    require_once 'connect.php';
    require "validation.php";
    $id = $_GET['updateid'];

    $sql = "SELECT * from formtable WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);

    $name = $row['Name'];
    $pass = $row['pass'];
    $email = $row['Email'];
    $gender = $row['Gender'];
    $image = $row['Image'];
    $psd = $row['pass'];
    $qualification = $row['Qualification'];

    // $row["Gender"] contains the gender value retrieved from the database
    $male_checked = '';
    $female_checked = '';
    $other_checked = '';
    if ($row["Gender"] === 'Male') {
        $male_checked = 'checked';
    } else if ($row["Gender"] === 'Female') {
        $female_checked = 'checked';
    } else if ($row["Gender"] === 'Other') {
        $other_checked = 'checked';
    }

    // Inserting Data To form
    if (isset($_POST["update"])) {


        $name = validate($_POST['name']);
        $pass = validate($_POST['pass']);
        $email = validate($_POST['email']);
        $gender = $_POST['gender'];
        $image = $_POST['Image'];

        $conn = mysqli_connect($servername, $username, $password, $db);
        if (!$conn) {
            die("Connection failed" . mysqli_connect_error());
        } else {
            echo "connection successful";
        }

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

        $sql = "UPDATE formtable SET id='$id', Name='$name', pass='$pass', Email='$email', Gender='$gender', Image='$path' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
        alert('New record created successfully')
        </script>";

            //redirect to next page
            header("Location:profile.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    ?>
    <div class="form-div">
        <form action="" method="post" enctype="multipart/form-data">
            <h2>Update Basic Details</h2>
            <div class="data-field">
                <label>Name:</label>
                <input name="name" id="name" value="<?php echo $name ?>" minlength="4" required /><br />
            </div>

            <div class="data-field">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $email ?>"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Incorrect Email Domain" /><br />
            </div>
            <div class="data-field">
                <label>Password:</label>
                <input name="pass" id="pass" value="<?php echo $psd ?>" minlength="8"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="(Must Contain: least one number, and one uppercase and lowercase
            letter)" required /><br />
            </div>
            <?php

            // Assume that $row["gender"] contains the gender value retrieved from the database
            $male_checked = '';
            $female_checked = '';
            $other_checked = '';
            if ($row["Gender"] === 'male') {
                $male_checked = 'checked';
            } else if ($row["Gender"] === 'female') {
                $female_checked = 'checked';
            } else if ($row["Gender"] === 'other') {
                $other_checked = 'checked';
            }


            ?>

            <div class="data-field">
                <label>Gender:</label>
                <input value="male" name="gender" id="gender1" type="radio" <?php echo $male_checked; ?> />
                <label for="gender1">Male</label>
                <input value="female" name="gender" id="gender2" type="radio" <?php echo $female_checked; ?> />
                <label for="gender2">Female</label>
                <input value="other" name="gender" id="gender3" type="radio" <?php echo $other_checked; ?> />
                <label for="gender3">Other</label><br />
            </div>



            <div class="data-field">
                <label>Qualification:</label>
                <input type="checkbox" id="qualification1" name="qualification[]" value="Graduation" <?php if (str_contains($qualification, 'Graduation')) {
                    echo 'checked';
                }
                ?> />
                <label for="qualification11">Graduate</label>
                <input type="checkbox" id="qualification2" name="qualification[]" value="Highschool" <?php if (str_contains($qualification, 'Highschool')) {
                    echo 'checked';
                }
                ?> />
                <label for="qualification2">High School</label>
                <input type="checkbox" id="qualification3" name="qualification[]" value="Illitrate" <?php if (str_contains($qualification, 'Illitrate')) {
                    echo 'checked';
                }
                ?> />
                <label for="qualification13">Illitrate</label><br />
            </div>
            <div class="data-field">
                <label for="options" name="options">Options:</label>

                <select name="options" id="options">
                    <option value="item1">Item1</option>
                    <option value="item2">Item2</option>
                    <option value="item3">Item3</option>
                </select>
                <br />
            </div>
            <div class="data-field">
                <label for="photo">Select image:</label>
                <input type="file" id="photo" name="photo" accept="image/*" />
                <br />
                <p style="font-size: small;">Uploaded Image :
                    <?php
                    if (empty($image)) {
                        echo "No Image Uploaded";
                    } else {
                        echo $image;
                    }
                    ?>
                </p>
            </div>
            <div class="data-field">
                <button type="submit" value="update" name="update">Update</button>

            </div>
        </form>
    </div>
</body>

</html>