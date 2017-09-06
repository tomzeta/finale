<?php
function Connect() {
    $dbhost = "localhost";
    $dbUser = "root";
    $dbPassword = "root";
    $targetdb = "tecweb";
    $conn = new mysqli($dbhost, $dbUser, $dbPassword, $targetdb);
    if($conn->connect_errno) {
        echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
    return $conn;
}
?>