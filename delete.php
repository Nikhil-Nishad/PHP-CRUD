<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "phpPractice";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
}

$id = $_GET['id'];
$sql = "DELETE from formtable WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    echo "<script>
    alert('Record Deleted Successfully!!')
    </script>";
    header("Refresh:0; url=profile.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
