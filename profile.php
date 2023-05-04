<?php
// require_once "connection.php";

$servername = "localhost";
$username = "root";
$password = "";
$db = "phpPractice";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
}
//Check If user Has Privilages

// $sql = "SELECT ADMIN from formtable where id='' ";
// $result = mysqli_query($conn, $sql);
// if ($result) {
// } else {
// }


// Query to select all data from table
$sql = "select * from formtable";

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {


    echo "<table width='80%' border=10>";
    echo "<tr  bgcolor='#DDDDDD'><th>ID</th><th>Name</th><th>Email</th><th>Gender</th><th>Qualification</th><th>Actions</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];

        // Output rows

        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["Name"] . "</td>";
        echo "<td>" . $row["Email"] . "</td>";
        echo "<td>" . $row["Gender"] . "</td>";
        echo "<td>" . $row["Qualification"] . "</td>";
        echo "<td><a href='update.php?updateid=" . $id . "'>Update</a> | <a href='delete.php?id=" . $row["id"] . "'>Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo "0 Results.";
}
