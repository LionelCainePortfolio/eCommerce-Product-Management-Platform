<?php
require_once "config.php";

$product_id = $_POST["id"];
$user_id = $_POST["user_id"];
$price = $_POST["price"];
$comments = $_POST["comments"];
$source_shippment_price = $_POST["source_shippment_price"];
$source_shippment_from = $_POST["source_shippment_from"];
$source_shippment_time = $_POST["source_shippment_time"];
$new_title = $_POST["new_title"];
$allegro_url = $_POST["allegro_url"];
$olx_url = $_POST["olx_url"];
$erli_url = $_POST["erli_url"];
$alione_url = $_POST["alione_url"];
$sprzedajemy_url = $_POST["sprzedajemy_url"];
$shopee_url = $_POST["shopee_url"];
$google_url = $_POST["google_url"];
$fb_marketplace_url = $_POST["fb_marketplace_url"];
$pinterest_url = $_POST["pinterest_url"];

$sql =
    "UPDATE products_platform SET source_shippment_time='" .
    $source_shippment_time .
    "', source_shippment_from='" .
    $source_shippment_from .
    "', source_shippment_price= '" .
    $source_shippment_price .
    "', price = '" .
    $price .
    "', comments = '" .
    $comments .
    "', suggested_title = '" .
    $new_title .
    "', added_allegro = '" .
    $allegro_url .
    "', added_erli = '" .
    $erli_url .
    "', added_olx = '" .
    $olx_url .
    "', added_alione = '" .
    $alione_url .
    "', added_sprzedajemy = '" .
    $sprzedajemy_url .
    "', added_shopee = '" .
    $shopee_url .
    "', added_google = '" .
    $google_url .
    "', added_fb_marketplace = '" .
    $fb_marketplace_url .
    "', added_pinterest = '" .
    $pinterest_url .
    "' WHERE id='" .
    $product_id .
    "' ";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM products_platform  WHERE id='" . $product_id . "'";
$result2 = mysqli_query($conn, $sql2);
$row = mysqli_fetch_row($result2);

if (strlen($allegro_url) > 0) {
    $check_allegro_added_by = $row["added_allegro_by"];
    if ($check_allegro_added_by == null) {
        $sql3 =
            "UPDATE products_platform SET added_allegro_by = '" .
            $user_id .
            "' WHERE id='" .
            $product_id .
            "' ";
        $result3 = mysqli_query($conn, $sql3);
    }
}

if (strlen($olx_url) > 0) {
    $check_olx_added_by = $row["added_olx_by"];
    if ($check_olx_added_by == null) {
        $sql3 =
            "UPDATE products_platform SET added_olx_by = '" .
            $user_id .
            "' WHERE id='" .
            $product_id .
            "' ";
        $result3 = mysqli_query($conn, $sql3);
    }
}

if (strlen($erli_url) > 0) {
    $check_erli_added_by = $row["added_erli_by"];
    if ($check_erli_added_by == null) {
        $sql3 =
            "UPDATE products_platform SET added_erli_by = '" .
            $user_id .
            "' WHERE id='" .
            $product_id .
            "' ";
        $result3 = mysqli_query($conn, $sql3);
    }
}

if (strlen($alione_url) > 0) {
    $check_alione_added_by = $row["added_alione_by"];
    if ($check_alione_added_by == null) {
        $sql3 =
            "UPDATE products_platform SET added_alione_by = '" .
            $user_id .
            "' WHERE id='" .
            $product_id .
            "' ";
        $result3 = mysqli_query($conn, $sql3);
    }
}

if (strlen($sprzedajemy_url) > 0) {
    $check_sprzedajemy_added_by = $row["added_sprzedajemy_by"];
    if ($check_sprzedajemy_added_by == null) {
        $sql3 =
            "UPDATE products_platform SET added_sprzedajemy_by = '" .
            $user_id .
            "' WHERE id='" .
            $product_id .
            "' ";
        $result3 = mysqli_query($conn, $sql3);
    }
}

if (strlen($shopee_url) > 0) {
    $check_shopee_added_by = $row["added_shopee_by"];
    if ($check_shopee_added_by == null) {
        $sql3 =
            "UPDATE products_platform SET added_shopee_by = '" .
            $user_id .
            "' WHERE id='" .
            $product_id .
            "' ";
        $result3 = mysqli_query($conn, $sql3);
    }
}

if (strlen($google_url) > 0) {
    $check_google_added_by = $row["added_google_by"];
    if ($check_google_added_by == null) {
        $sql3 =
            "UPDATE products_platform SET added_google_by = '" .
            $user_id .
            "' WHERE id='" .
            $product_id .
            "' ";
        $result3 = mysqli_query($conn, $sql3);
    }
}

if (strlen($fb_marketplace_url) > 0) {
    $check_fb_marketplace_added_by = $row["added_fb_marketplace_by"];
    if ($check_fb_marketplace_added_by == null) {
        $sql3 =
            "UPDATE products_platform SET added_fb_marketplace_by = '" .
            $user_id .
            "' WHERE id='" .
            $product_id .
            "' ";
        $result3 = mysqli_query($conn, $sql3);
    }
}

if (strlen($pinterest_url) > 0) {
    $check_pinterest_added_by = $row["added_pinterest_by"];
    if ($check_pinterest_added_by == null) {
        $sql3 =
            "UPDATE products_platform SET added_pinterest_by = '" .
            $user_id .
            "' WHERE id='" .
            $product_id .
            "' ";
        $result3 = mysqli_query($conn, $sql3);
    }
}

?>
