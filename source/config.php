<?php
/* Database credentials. Assuming you are running MySQL
 server with default setting (user 'root' with no password) */
define("DB_SERVER", "");
define("DB_USERNAME", "");
define("DB_PASSWORD", "");
define("DB_NAME", "m1039_platform_demo");

/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
