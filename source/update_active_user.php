<?php
ini_set("display_errors", "0");
ini_set("display_startup_errors", "0");
require_once "Connection.php";
$user_id = $_GET["user_id"];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id='" . $user_id . "'");

if (mysqli_num_rows($query) > 0) {
    $query2 = mysqli_query(
        $conn,
        "UPDATE users SET is_online='true' WHERE id='" . $user_id . "'"
    );
    $query3 = mysqli_query(
        $conn,
        "UPDATE users SET last_scene=NOW() WHERE id='" . $user_id . "'"
    );

    $date = date("Y-m-d H:i");
    $myObj->last_seen = $date;
    $myJSON = json_encode($myObj);
    echo $myJSON;
}

?>
