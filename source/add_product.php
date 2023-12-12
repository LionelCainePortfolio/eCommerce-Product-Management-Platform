<?php
require_once "config.php";
$title = $_POST["title"];
$comments = $_POST["comments"];
$price = $_POST["price"];
$img = $_POST["img"];
$source_price = $_POST["source_price"];
$source = $_POST["source"];
$new_title = $_POST["new_title"];
$source_url = $_POST["source_url"];
$source_quantity = $_POST["source_quantity"];
$source_shippment_from = $_POST["source_shippment_from"];
$source_shippment_price = $_POST["source_shippment_price"];
$source_shippment_time = $_POST["source_shippment_time"];
$added_by = $_POST["added_by"];

// Attempt insert query execution
$sql = "INSERT INTO products_platform (title, img, price, comments, suggested_title, source, source_url, source_quantity, source_price, source_shippment_from, source_shippment_price, source_shippment_time, added_by) VALUES ('$title','$img', '$price', '$comments', '$new_title', '$source',  '$source_url','$source_quantity', '$source_price', '$source_shippment_from', '$source_shippment_price', '$source_shippment_time', '$added_by')";
if (mysqli_query($conn, $sql)) {
    echo "Success";
} else {
    echo "ERROR: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>

 