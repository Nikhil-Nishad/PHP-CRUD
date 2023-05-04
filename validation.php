<?php
function validate($data)
{


    //  Trim blank spaces from first and last of string.
    $data = trim($data);

    //  stripslashes removes any slashes from the string.
    $data = stripslashes($data);

    //  htmlspecialchars removes special characters that are used in HTML code from string. It is used in order to prevent the user from running html code from input box.
    $data = htmlspecialchars($data);

    return $data;
}


?>