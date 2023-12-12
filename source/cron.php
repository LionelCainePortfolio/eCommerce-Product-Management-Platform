<?php
require_once "config.php";

$offsetx = 0;
function scrapper($url)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
    ]);

    $response = curl_exec($curl);
    return $response;
}

//download XML cron
///////////APTEL

/*$local_file = 'bna.xml';
$server_file = 'bna.xml';
$ftp_server="ftp.s15.hekko.pl";
$ftp_user_name="bnainvestments@aptel.pl";
$ftp_user_pass="iPPfc]5@I0q^-y-c";

$conn_id = ftp_connect($ftp_server);
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

if (ftp_get($conn_id, $local_file, $server_file, FTP_BINARY)) {
    echo "Successfully written to $local_file\n";
}
else {
    echo "There was a problem\n";
}
ftp_close($conn_id);

$dom=new DOMDocument();
$dom->load("bna.xml");

$root=$dom->documentElement; // This can differ (I am not sure, it can be only documentElement or documentElement->firstChild or only firstChild)

$nodesToDelete=array();

$produkty=$root->getElementsByTagName('produkt');

// Loop trough childNodes
foreach ($produkty as $produkt) {

    $title=$produkt->getElementsByTagName('nazwa')->item(0)->textContent;
    $newTitle = str_replace("<![CDATA[","", $title);
    $produkt->getElementsByTagName('nazwa')->item(0)->nodeValue = $newTitle;

    // Your filters here

    // To remove the marker you just add it to a list of nodes to delete
    //$nodesToDelete[]=$produkt;
}

// You delete the nodes
//foreach ($nodesToDelete as $node) $node->parentNode->removeChild($node);

$dom->saveXML(); // This will return the XML as a string
$dom->save('bna.xml'); // This saves the XML to a file
*/
///////////APTEL

//update price and quantity from
//////////////SHOPEE
$array = [];
$urls = [];

$doneShopee = false;

function updateShopeeGlobal()
{
    if ($doneShopee == false) {
        $array = [];

        $sqlCommand =
            "SELECT * FROM products_platform where source='shopee' order by id asc ";
        ($query = mysqli_query($conn, $sqlCommand)) or die(mysqli_error($conn));

        while ($row = mysqli_fetch_array($query)) {
            $this_id = $row["id"];
            $this_price = $row["price"];
            $this_source_url = $row["source_url"];

            $file_name = "update_products/shopee/" . $this_id . ".html";
            $scrap_data = file_get_contents($file_name);

            $needle_title = "twitter:title' content='";
            $needle_image = "twitter:image' content='";
            $needle_price = 'itemprop="price" content="';
            $needle_quantity = "";

            $str_title = substr(
                $scrap_data,
                strpos($scrap_data, $needle_title) + strlen($needle_title),
                100
            );
            $str_title_final = strtok($str_title, "'/>");

            $str_image = substr(
                $scrap_data,
                strpos($scrap_data, $needle_image) + strlen($needle_image),
                250
            );
            $str_image_prefinal = str_replace("'/>", "", $str_image);
            preg_match_all(
                "#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#",
                $str_image_prefinal,
                $str_image_final
            );

            $str_price = substr(
                $scrap_data,
                strpos($scrap_data, $needle_price) + strlen($needle_price),
                10
            );
            $str_price_prefinal = str_replace('"/>', "", $str_price);
            preg_match_all(
                "(\d+(?:\.\d+)*)",
                $str_price_prefinal,
                $str_price_final
            );

            $price = $str_price_final[0][0];
            $image = $str_image_final[0][0];
            $title = $str_title_final;
            if ($price != null) {
                $resultShopeeUpdate =
                    "UPDATE products_platform SET price = '" .
                    $price .
                    "', img = '" .
                    $image .
                    "', title='" .
                    $title .
                    "' WHERE id = '" .
                    $this_id .
                    "'";
                // array_push($array, $resultShopeeUpdate);
                ($query2 = mysqli_query($conn, $resultShopeeUpdate)) or
                    die(mysqli_error($conn));
                // zrobic update stocku ilsoci magazyn
            }
        }
        // $comma_separated = implode("; ", $array);
        //  $query2=mysqli_query($conn, $comma_separated) or die(mysqli_error($conn));
    }
}
///////////SHOPEE
///////////ALIEXPRESS

function updateAliexpressGlobal()
{
    $sqlCommand =
        "SELECT * FROM products_platform where source='aliexpress' order by id asc ";
    ($query = mysqli_query($conn, $sqlCommand)) or die(mysqli_error($conn));

    while ($row = mysqli_fetch_array($query)) {
        $this_id = $row["id"];
        $this_price = $row["price"];
        $this_source_url = $row["source_url"];

        $needle_title = 'property="og:title" content="';
        $needle_image = 'property="og:image" content="';
        $needle_price = 'property="og:title" content="';
        $needle_ship_from = 'shipFrom":"';
        $needle_delivery_day_max = 'deliveryDayMax":';
        $needle_guaranted_delivery_time = 'guaranteedDeliveryTime":';
        $needle_compose_delivary_date = 'deliveryDate":"';
        $needle_free_shippment = 'shippingFee":"';
        $variants_array = [];

        $which_item = $_POST["which_item"];
    }

    //  $check_variants ='skuPropertyValueShowOrder":1,"skuPropertyValueTips":"';

    if ($which_item == "unset") {
        $check_variants = 'skuPropertyName":"kolor","skuPropertyValues":';
        $check_variants2 = 'skuPropertyName":"Color","skuPropertyValues":';
        $check_variants3 = 'skuPropertyName":"color","skuPropertyValues":';
        $check_variants4 = 'skuPropertyName":"Kolor","skuPropertyValues":';

        $str_variants_count = substr_count($scrap_data, $check_variants);
        $str_variants_count2 = substr_count($scrap_data, $check_variants2);
        $str_variants_count3 = substr_count($scrap_data, $check_variants3);
        $str_variants_count4 = substr_count($scrap_data, $check_variants4);

        if ($str_variants_count > 0) {
            $str_variants = substr(
                $scrap_data,
                strpos($scrap_data, $check_variants) + strlen($check_variants),
                15000
            );
            //$str_variants_prefinal = explode("}]}", $str_variants);
            $str_variants_prefinal = substr(
                $str_variants,
                0,
                strpos($str_variants, "}]}")
            );
            $str_variants_final = $str_variants_prefinal . "}]";
            $str_variants_final_data = json_decode(
                preg_replace('/[\x00-\x1F\x80-\xFF]/', "", $str_variants_final),
                true
            );
        } elseif ($str_variants_count2 > 0) {
            $str_variants2 = substr(
                $scrap_data,
                strpos($scrap_data, $check_variants2) +
                    strlen($check_variants2),
                15000
            );
            $str_variants_prefinal2 = substr(
                $str_variants2,
                0,
                strpos($str_variants2, "}]}")
            );
            $str_variants_final2 = $str_variants_prefinal2 . "}]";
            $str_variants_final_data = json_decode(
                preg_replace(
                    '/[\x00-\x1F\x80-\xFF]/',
                    "",
                    $str_variants_final2
                ),
                true
            );
        } elseif ($str_variants_count3 > 0) {
            $str_variants3 = substr(
                $scrap_data,
                strpos($scrap_data, $check_variants3) +
                    strlen($check_variants3),
                15000
            );
            $str_variants_prefinal3 = substr(
                $str_variants3,
                0,
                strpos($str_variants3, "}]}")
            );
            $str_variants_final3 = $str_variants_prefinal3 . "}]";
            $str_variants_final_data = json_decode(
                preg_replace(
                    '/[\x00-\x1F\x80-\xFF]/',
                    "",
                    $str_variants_final3
                ),
                true
            );
        } elseif ($str_variants_count4 > 0) {
            $str_variants4 = substr(
                $scrap_data,
                strpos($scrap_data, $check_variants4) +
                    strlen($check_variants4),
                15000
            );
            $str_variants_prefinal4 = substr(
                $str_variants4,
                0,
                strpos($str_variants4, "}]}")
            );
            $str_variants_final4 = $str_variants_prefinal4 . "}]";
            $str_variants_final_data = json_decode(
                preg_replace(
                    '/[\x00-\x1F\x80-\xFF]/',
                    "",
                    $str_variants_final4
                ),
                true
            );
        }

        $needle_find_ship_from_Poland =
            '"shipFrom":"Poland","deliveryDayMax":3';
        $needle_find_ship_from_Poland2 =
            '"shipFrom":"Poland","deliveryDayMax":5';
        $needle_find_ship_from_Poland3 =
            '"shipFrom":"Poland","deliveryDayMax":7';
        $needle_find_ship_from_France =
            '"shipFrom":"France","deliveryDayMax":3';
        $needle_find_ship_from_France2 =
            '"shipFrom":"France","deliveryDayMax":5';
        $needle_find_ship_from_France3 =
            '"shipFrom":"France","deliveryDayMax":7';
        $needle_find_ship_from_Germany =
            '"shipFrom":"Germany","deliveryDayMax":3';
        $needle_find_ship_from_Germany2 =
            '"shipFrom":"Germany","deliveryDayMax":5';
        $needle_find_ship_from_Germany3 =
            '"shipFrom":"Germany","deliveryDayMax":7';
        $ship_from_PL = "false";
        $ship_from_CN = "false";
        $ship_from_FR = "false";
        $ship_from_DE = "false";
        $parsed = "";
        $str_find_ship_from_poland = strpos(
            $scrap_data,
            $needle_find_ship_from_Poland
        );
        $str_find_ship_from_poland2 = strpos(
            $scrap_data,
            $needle_find_ship_from_Poland2
        );
        $str_find_ship_from_poland3 = strpos(
            $scrap_data,
            $needle_find_ship_from_Poland3
        );

        $str_find_ship_from_france = strpos(
            $scrap_data,
            $needle_find_ship_from_France
        );
        $str_find_ship_from_france2 = strpos(
            $scrap_data,
            $needle_find_ship_from_France2
        );
        $str_find_ship_from_france3 = strpos(
            $scrap_data,
            $needle_find_ship_from_France3
        );

        $str_find_ship_from_geramny = strpos(
            $scrap_data,
            $needle_find_ship_from_Germany
        );
        $str_find_ship_from_gerany2 = strpos(
            $scrap_data,
            $needle_find_ship_from_Germany2
        );
        $str_find_ship_from_geramny3 = strpos(
            $scrap_data,
            $needle_find_ship_from_Germany3
        );
        if ($str_find_ship_from_poland != false) {
            $ship_from_PL = "true";
            $ship_from_FR = "false";
            $ship_from_DE = "false";
            $ship_from_CN = "false";
        } elseif ($str_find_ship_from_poland2 != false) {
            $ship_from_PL = "true";
            $ship_from_FR = "false";
            $ship_from_DE = "false";
            $ship_from_CN = "false";
        } elseif ($str_find_ship_from_poland3 != false) {
            $ship_from_PL = "true";
            $ship_from_FR = "false";
            $ship_from_DE = "false";
            $ship_from_CN = "false";
        } elseif ($str_find_ship_from_france != false) {
            $ship_from_PL = "false";
            $ship_from_FR = "true";
            $ship_from_DE = "false";
            $ship_from_CN = "false";
        } elseif ($str_find_ship_from_france2 != false) {
            $ship_from_PL = "false";
            $ship_from_FR = "true";
            $ship_from_DE = "false";
            $ship_from_CN = "false";
        } elseif ($str_find_ship_from_france3 != false) {
            $ship_from_PL = "false";
            $ship_from_FR = "true";
            $ship_from_DE = "false";
            $ship_from_CN = "false";
        } elseif ($str_find_ship_from_germany != false) {
            $ship_from_PL = "false";
            $ship_from_FR = "false";
            $ship_from_DE = "true";
            $ship_from_CN = "false";
        } elseif ($str_find_ship_from_germany2 != false) {
            $ship_from_PL = "false";
            $ship_from_FR = "false";
            $ship_from_DE = "true";
            $ship_from_CN = "false";
        } elseif ($str_find_ship_from_germany3 != false) {
            $ship_from_PL = "false";
            $ship_from_FR = "false";
            $ship_from_DE = "true";
            $ship_from_CN = "false";
        } else {
            $ship_from_PL = "false";
            $ship_from_FR = "false";
            $ship_from_DE = "false";
            $ship_from_CN = "true";
        }
        if ($ship_from_PL == "true") {
            $needle_check_warehouse =
                '"company":"CAINIAO WAREHOUSE STANDARD SHIPPING"';
            $str_confirm_ship_from_poland = substr_count(
                $scrap_data,
                strpos($scrap_data, $needle_check_warehouse) +
                    strlen($needle_check_warehouse),
                10
            );

            if ($str_confirm_ship_from_poland > 0) {
                $ship_from_FR = "false";
                $ship_from_DE = "false";
                $ship_from_CN = "false";
                $ship_from_PL = "true";
            } else {
                $ship_from_PL = "false";
                $ship_from_FR = "false";
                $ship_from_DE = "false";
                $ship_from_CN = "true";
            }
        } elseif ($ship_from_CN == "true") {
            $needle_check_warehouse =
                '"company":"AliExpress Standard Shipping"';
            $str_confirm_ship_from_china = substr_count(
                $scrap_data,
                strpos($scrap_data, $needle_check_warehouse) +
                    strlen($needle_check_warehouse),
                10
            );

            if ($str_confirm_ship_from_china > 0) {
                $ship_from_FR = "false";
                $ship_from_DE = "false";
                $ship_from_CN = "true";
                $ship_from_PL = "false";
            }
        }

        if ($ship_from_PL == "true") {
            $needle_check_data2 = '"p8\":\"PL\",\"';
            $needle_check_data = "#" . $which_item;
            $needle_check_data3 = 'availQuantity":';
            //  $str_confirm_ship_from_poland2 = substr($scrap_data, strpos($scrap_data, $needle_check_data2) + strlen($needle_check_data2), 1000);
            // $str_confirm_ship_from_poland3 = substr($str_confirm_ship_from_poland2, strpos($str_confirm_ship_from_poland2, $needle_check_data) + strlen($needle_check_data), 1000);
            // $str_confirm_ship_from_poland4 = substr($str_confirm_ship_from_poland3, strpos($str_confirm_ship_from_poland3, $needle_check_data) + strlen($needle_check_data), 1000);

            $parsed = getBetween(
                $scrap_data,
                $needle_check_data,
                $needle_check_data2
            );
        }

        if ($ship_from_CN == "true") {
            $needle_check_data2 = '"p7\":\"{}\",\"';
            $needle_check_data = "#" . $which_item;
            $needle_check_data3 = 'availQuantity":';
            //  $str_confirm_ship_from_poland2 = substr($scrap_data, strpos($scrap_data, $needle_check_data2) + strlen($needle_check_data2), 1000);
            // $str_confirm_ship_from_poland3 = substr($str_confirm_ship_from_poland2, strpos($str_confirm_ship_from_poland2, $needle_check_data) + strlen($needle_check_data), 1000);
            // $str_confirm_ship_from_poland4 = substr($str_confirm_ship_from_poland3, strpos($str_confirm_ship_from_poland3, $needle_check_data) + strlen($needle_check_data), 1000);

            $parsed = getBetween(
                $scrap_data,
                $needle_check_data,
                $needle_check_data2
            );
        }

        $str_title = substr(
            $scrap_data,
            strpos($scrap_data, $needle_title) + strlen($needle_title),
            125
        );
        $str_title_prefinal = strstr($str_title, "|");
        $str_title_prefinall = str_replace("|", "", $str_title_prefinal);
        $str_title_final = strtok($str_title_prefinall, "'/>");

        $str_image = substr(
            $scrap_data,
            strpos($scrap_data, $needle_image) + strlen($needle_image),
            250
        );
        $str_image_prefinal = str_replace('"/', "", $str_image);
        preg_match_all(
            "#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#",
            $str_image_prefinal,
            $str_image_final
        );

        $needle_price_variant = 'value":';
        $str_price = substr(
            $scrap_data,
            strpos($scrap_data, $needle_price_variant) +
                strlen($needle_price_variant),
            7
        );
        $str_price_final = strtok($str_price, "},");
        // preg_match_all('(\d+(?:\.\d+)*)', $str_price_final, $str_price_prefinal);

        $str_ship_from = substr(
            $scrap_data,
            strpos($scrap_data, $needle_ship_from) + strlen($needle_ship_from),
            10
        );
        if (strpos($str_ship_from, "China") !== false) {
            $str_ship_from = substr(
                $scrap_data,
                strpos($scrap_data, $needle_ship_from) +
                    strlen($needle_ship_from),
                7
            );
        } elseif (strpos($str_ship_from, "Poland") !== false) {
            $str_ship_from = substr(
                $scrap_data,
                strpos($scrap_data, $needle_ship_from) +
                    strlen($needle_ship_from),
                8
            );
        } elseif (strpos($str_ship_from, "France") !== false) {
            $str_ship_from = substr(
                $scrap_data,
                strpos($scrap_data, $needle_ship_from) +
                    strlen($needle_ship_from),
                8
            );
        } elseif (strpos($str_ship_from, "Czech") !== false) {
            $str_ship_from = substr(
                $scrap_data,
                strpos($scrap_data, $needle_ship_from) +
                    strlen($needle_ship_from),
                14
            );
        } elseif (strpos($str_ship_from, "Belgium") !== false) {
            $str_ship_from = substr(
                $scrap_data,
                strpos($scrap_data, $needle_ship_from) +
                    strlen($needle_ship_from),
                8
            );
        } elseif (strpos($str_ship_from, "Italy") !== false) {
            $str_ship_from = substr(
                $scrap_data,
                strpos($scrap_data, $needle_ship_from) +
                    strlen($needle_ship_from),
                6
            );
        } elseif (strpos($str_ship_from, "Spain") !== false) {
            $str_ship_from = substr(
                $scrap_data,
                strpos($scrap_data, $needle_ship_from) +
                    strlen($needle_ship_from),
                6
            );
        } elseif (strpos($str_ship_from, "Germany") !== false) {
            $str_ship_from = substr(
                $scrap_data,
                strpos($scrap_data, $needle_ship_from) +
                    strlen($needle_ship_from),
                8
            );
        }
        $str_ship_from_prefinal = str_replace('"', "", $str_ship_from);
        $str_ship_from_final = str_replace(",", "", $str_ship_from_prefinal);
        preg_match_all("(\d+(?:\.\d+)*)", $str_ship_from_final, $str_ship_from);

        $needle_connect_ids = '"availQuantity":';
        $str_avaible_quant = substr(
            $scrap_data,
            strpos($scrap_data, $needle_connect_ids) +
                strlen($needle_connect_ids),
            6
        );
        $str_avaible_quant_prefinal1 = str_replace(",", "", $str_avaible_quant);
        $str_avaible_quant_prefinal2 = str_replace(
            '"',
            "",
            $str_avaible_quant_prefinal1
        );
        $str_avaible_quant_prefinal3 = str_replace(
            "d",
            "",
            $str_avaible_quant_prefinal2
        );
        $str_avaible_quant_final = str_replace(
            "i",
            "",
            $str_avaible_quant_prefinal3
        );
        preg_match_all(
            "(\d+(?:\.\d+)*)",
            $str_avaible_quant_final,
            $str_avaible_quant_prefinal3
        );

        $needle_connect_ids =
            'propertyValueDisplayName":"' .
            $which_item .
            '","propertyValueId":';
        $str_avaible_quant = substr(
            $scrap_data,
            strpos($scrap_data, $needle_connect_ids) +
                strlen($needle_connect_ids),
            6
        );
        $str_avaible_quant_prefinal1 = str_replace(",", "", $str_avaible_quant);
        $str_avaible_quant_prefinal2 = str_replace(
            '"',
            "",
            $str_avaible_quant_prefinal1
        );
        $str_avaible_quant_prefinal3 = str_replace(
            "d",
            "",
            $str_avaible_quant_prefinal2
        );
        $str_avaible_quant_final = str_replace(
            "i",
            "",
            $str_avaible_quant_prefinal3
        );
        preg_match_all(
            "(\d+(?:\.\d+)*)",
            $str_avaible_quant_final,
            $str_avaible_quant_prefinal3
        );

        $str_variant_image_scrap = substr(
            $scrap_data,
            strpos($scrap_data, $needle_connect_ids) +
                strlen($needle_connect_ids),
            600
        );
        $str_variant_image_needle = 'skuPropertyImagePath":"';
        $str_variant_image = substr(
            $str_variant_image_scrap,
            strpos($str_variant_image_scrap, $str_variant_image_needle) +
                strlen($str_variant_image_needle),
            450
        );
        $str_variant_image_final = strtok($str_variant_image, '","');
        preg_match_all(
            "(\d+(?:\.\d+)*)",
            $str_variant_image_final,
            $str_variant_image
        );

        $str_delivery_day_max = substr(
            $scrap_data,
            strpos($scrap_data, $needle_delivery_day_max) +
                strlen($needle_delivery_day_max),
            3
        );
        $str_delivery_day_max_prefinal = str_replace(
            ",",
            "",
            $str_delivery_day_max
        );
        $str_delivery_day_max_final = str_replace(
            '"',
            "",
            $str_delivery_day_max_prefinal
        );

        preg_match_all(
            "(\d+(?:\.\d+)*)",
            $str_delivery_day_max_final,
            $str_delivery_day_max_prefinal
        );

        $str_guaranted_delivery_time = substr(
            $scrap_data,
            strpos($scrap_data, $needle_guaranted_delivery_time) +
                strlen($needle_guaranted_delivery_time),
            3
        );
        $str_guaranted_delivery_time_prefinal = str_replace(
            ",",
            "",
            $str_guaranted_delivery_time
        );
        $str_guaranted_delivery_time_final = str_replace(
            '"',
            "",
            $str_guaranted_delivery_time_prefinal
        );
        preg_match_all(
            "(\d+(?:\.\d+)*)",
            $str_guaranted_delivery_time_final,
            $str_guaranted_delivery_time_prefinal
        );

        $str_compose_delivary_date = substr(
            $scrap_data,
            strpos($scrap_data, $needle_compose_delivary_date) +
                strlen($needle_compose_delivary_date),
            7
        );
        $str_compose_delivary_date_prefinal = str_replace(
            ",",
            "",
            $str_compose_delivary_date
        );
        $str_compose_delivary_date_final = str_replace(
            '"',
            "",
            $str_compose_delivary_date_prefinal
        );
        preg_match_all(
            "(\d+(?:\.\d+)*)",
            $str_compose_delivary_date_final,
            $str_compose_delivary_date_prefinal
        );

        $str_free_shippment = substr(
            $scrap_data,
            strpos($scrap_data, $needle_free_shippment) +
                strlen($needle_free_shippment),
            7
        );
        $str_free_shippment_prefinal = str_replace(
            ",",
            "",
            $str_free_shippment
        );
        $str_free_shippment_final = str_replace(
            '"',
            "",
            $str_free_shippment_prefinal
        );
        preg_match_all(
            "(\d+(?:\.\d+)*)",
            $str_free_shippment_final,
            $str_free_shippment_prefinal
        );

        $return = [
            "title" => $str_title_final,
            "image" => $str_image_final[0][0],
            "price" => $str_price_final,
            "free_shippment" => $str_free_shippment_final,
            "ship_from" => $str_ship_from_final,
            "deliveryDayMax" => $str_delivery_day_max_final,
            "guaranteedDeliveryTime" => $str_guaranted_delivery_time_final,
            "logisticsComposeDeliveryDate" => $str_compose_delivary_date_final,
            "avaibleQuantity" => $str_avaible_quant_final,
            "11" => $needle_proper_value_id,
            "33" => $str_proper_value_id_final,
            "variant" => $which_item,

            "variants" => $str_variants_final_data,
            "variant_image" => $str_variant_image_final,
            "scrap" => $scrap_data,
        ];
        echo json_encode($return);
    }
    //        if ($which_item == "unset"){
    else {
        $str_title = substr(
            $scrap_data,
            strpos($scrap_data, $needle_title) + strlen($needle_title),
            125
        );
        $str_title_prefinal = strstr($str_title, "|");
        $str_title_prefinall = str_replace("|", "", $str_title_prefinal);
        $str_title_final = strtok($str_title_prefinall, "'/>");

        $needle_find_ship_from_Poland =
            '"shipFrom":"Poland","deliveryDayMax":3';
        $needle_find_ship_from_Poland2 =
            '"shipFrom":"Poland","deliveryDayMax":5';
        $needle_find_ship_from_Poland3 =
            '"shipFrom":"Poland","deliveryDayMax":7';
        $needle_find_ship_from_France =
            '"shipFrom":"France","deliveryDayMax":3';
        $needle_find_ship_from_France2 =
            '"shipFrom":"France","deliveryDayMax":5';
        $needle_find_ship_from_France3 =
            '"shipFrom":"France","deliveryDayMax":7';
        $needle_find_ship_from_Germany =
            '"shipFrom":"Germany","deliveryDayMax":3';
        $needle_find_ship_from_Germany2 =
            '"shipFrom":"Germany","deliveryDayMax":5';
        $needle_find_ship_from_Germany3 =
            '"shipFrom":"Germany","deliveryDayMax":7';
        $ship_from_PL = "false";
        $ship_from_CN = "false";
        $ship_from_FR = "false";
        $ship_from_DE = "false";
        $parsed = "";
        $str_find_ship_from_poland = strpos(
            $scrap_data,
            $needle_find_ship_from_Poland
        );
        $str_find_ship_from_poland2 = strpos(
            $scrap_data,
            $needle_find_ship_from_Poland2
        );
        $str_find_ship_from_poland3 = strpos(
            $scrap_data,
            $needle_find_ship_from_Poland3
        );

        $str_find_ship_from_france = strpos(
            $scrap_data,
            $needle_find_ship_from_France
        );
        $str_find_ship_from_france2 = strpos(
            $scrap_data,
            $needle_find_ship_from_France2
        );
        $str_find_ship_from_france3 = strpos(
            $scrap_data,
            $needle_find_ship_from_France3
        );

        $str_find_ship_from_geramny = strpos(
            $scrap_data,
            $needle_find_ship_from_Germany
        );
        $str_find_ship_from_gerany2 = strpos(
            $scrap_data,
            $needle_find_ship_from_Germany2
        );
        $str_find_ship_from_geramny3 = strpos(
            $scrap_data,
            $needle_find_ship_from_Germany3
        );
        if ($str_find_ship_from_poland != false) {
            $ship_from_PL = "true";
            $ship_from_FR = "false";
            $ship_from_DE = "false";
            $ship_from_CN = "false";
        } elseif ($str_find_ship_from_poland2 != false) {
            $ship_from_PL = "true";
            $ship_from_FR = "false";
            $ship_from_DE = "false";
            $ship_from_CN = "false";
        } elseif ($str_find_ship_from_poland3 != false) {
            $ship_from_PL = "true";
            $ship_from_FR = "false";
            $ship_from_DE = "false";
            $ship_from_CN = "false";
        } elseif ($str_find_ship_from_france != false) {
            $ship_from_PL = "false";
            $ship_from_FR = "true";
            $ship_from_DE = "false";
            $ship_from_CN = "false";
        } elseif ($str_find_ship_from_france2 != false) {
            $ship_from_PL = "false";
            $ship_from_FR = "true";
            $ship_from_DE = "false";
            $ship_from_CN = "false";
        } elseif ($str_find_ship_from_france3 != false) {
            $ship_from_PL = "false";
            $ship_from_FR = "true";
            $ship_from_DE = "false";
            $ship_from_CN = "false";
        } elseif ($str_find_ship_from_germany != false) {
            $ship_from_PL = "false";
            $ship_from_FR = "false";
            $ship_from_DE = "true";
            $ship_from_CN = "false";
        } elseif ($str_find_ship_from_germany2 != false) {
            $ship_from_PL = "false";
            $ship_from_FR = "false";
            $ship_from_DE = "true";
            $ship_from_CN = "false";
        } elseif ($str_find_ship_from_germany3 != false) {
            $ship_from_PL = "false";
            $ship_from_FR = "false";
            $ship_from_DE = "true";
            $ship_from_CN = "false";
        } else {
            $ship_from_PL = "false";
            $ship_from_FR = "false";
            $ship_from_DE = "false";
            $ship_from_CN = "true";
        }
        if ($ship_from_PL == "true") {
            $needle_check_warehouse =
                '"company":"CAINIAO WAREHOUSE STANDARD SHIPPING"';
            $str_confirm_ship_from_poland = substr_count(
                $scrap_data,
                strpos($scrap_data, $needle_check_warehouse) +
                    strlen($needle_check_warehouse),
                10
            );

            if ($str_confirm_ship_from_poland > 0) {
                $ship_from_FR = "false";
                $ship_from_DE = "false";
                $ship_from_CN = "false";
                $ship_from_PL = "true";
            } else {
                $ship_from_PL = "false";
                $ship_from_FR = "false";
                $ship_from_DE = "false";
                $ship_from_CN = "true";
            }
        } elseif ($ship_from_CN == "true") {
            $needle_check_warehouse =
                '"company":"AliExpress Standard Shipping"';
            $str_confirm_ship_from_china = substr_count(
                $scrap_data,
                strpos($scrap_data, $needle_check_warehouse) +
                    strlen($needle_check_warehouse),
                10
            );

            if ($str_confirm_ship_from_china > 0) {
                $ship_from_FR = "false";
                $ship_from_DE = "false";
                $ship_from_CN = "true";
                $ship_from_PL = "false";
            }
        }

        if ($ship_from_PL == "true") {
            $needle_check_data2 = '"p8\":\"PL\",\"';
            $needle_check_data = "#" . $which_item;
            $needle_skuPropIds = '"skuPropIds"';
            $needle_check_data3 = 'availQuantity":';
            //$str_confirm_ship_from_poland2 = substr($scrap_data, strpos($scrap_data, $needle_check_data2) + strlen($needle_check_data2), 1000);
            // $str_confirm_ship_from_poland3 = substr($str_confirm_ship_from_poland2, strpos($str_confirm_ship_from_poland2, $needle_check_data) + strlen($needle_check_data), 1000);
            //$str_confirm_ship_from_poland4 = substr($str_confirm_ship_from_poland3, strpos($str_confirm_ship_from_poland3, $needle_check_data) + strlen($needle_check_data), 1000);

            $parsed = getBetween(
                $scrap_data,
                $needle_check_data,
                $needle_skuPropIds
            );
            $needle_skuId = '"skuId":';
            $str_skuId = substr(
                $parsed,
                strpos($parsed, $needle_skuId) + strlen($needle_skuId),
                17
            );
            $res = preg_replace("/[^0-9]/", "", $str_skuId);
            $nee = '\",\"p0\":\"' . $res;
            $nee2 = '"}';
            $parsed2 = getBetween($scrap_data, $nee, $nee2);
            $needle_scItemId = '"scItemId';
            $str_skuId2 = substr(
                $parsed2,
                strpos($parsed2, $needle_scItemId) + strlen($needle_scItemId),
                27
            );
            $res2 = preg_replace("/[^0-9]/", "", $str_skuId2);
            $needle_res2 = $res2 . '\\\\\\"}\\",\\"p8\\":\\"PL';
            $str_skuId3 = substr(
                $scrap_data,
                strpos($scrap_data, $needle_res2) + strlen($needle_res2),
                500
            ); // pokazuje info o wariancie, nalezy stad pobrac dalsze dane jak np ilosc i cene

            $str_availQuantity = substr(
                $str_skuId3,
                strpos($str_skuId3, $needle_check_data3) +
                    strlen($needle_check_data3),
                400
            );
            $str_availQuantity_final = strtok($str_availQuantity, ',"');

            //  preg_match_all('(\d+(?:\.\d+)*)', $str_title_final, $str_availQuantity);
        } elseif ($ship_from_CN == "true") {
            $needle_check_data2 = '"p7\":\"{}\",\"';
            $needle_check_data = "#" . $which_item;
            $needle_skuPropIds = '"skuPropIds"';
            $needle_check_data3 = 'availQuantity":';
            //$str_confirm_ship_from_poland2 = substr($scrap_data, strpos($scrap_data, $needle_check_data2) + strlen($needle_check_data2), 1000);
            // $str_confirm_ship_from_poland3 = substr($str_confirm_ship_from_poland2, strpos($str_confirm_ship_from_poland2, $needle_check_data) + strlen($needle_check_data), 1000);
            //$str_confirm_ship_from_poland4 = substr($str_confirm_ship_from_poland3, strpos($str_confirm_ship_from_poland3, $needle_check_data) + strlen($needle_check_data), 1000);

            $parsed = getBetween(
                $scrap_data,
                $needle_check_data,
                $needle_skuPropIds
            );
            $needle_skuId = '"skuId":';
            $str_skuId = substr(
                $parsed,
                strpos($parsed, $needle_skuId) + strlen($needle_skuId),
                17
            );
            $res = preg_replace("/[^0-9]/", "", $str_skuId);
            $nee = '\",\"p0\":\"' . $res;
            $nee2 = '"}';
            $parsed2 = getBetween($scrap_data, $nee, $nee2);
            $needle_scItemId = '"scItemId';
            $needle_res2 = "";
            if (
                substr_count(
                    $scrap_data,
                    strpos($scrap_data, $needle_check_warehouse) +
                        strlen($needle_check_warehouse),
                    10
                ) > 0
            ) {
                $str_skuId2 = substr(
                    $parsed2,
                    strpos($parsed2, $needle_scItemId) +
                        strlen($needle_scItemId),
                    27
                );
                $res2 = preg_replace("/[^0-9]/", "", $str_skuId2);
                $needle_res2 = $res2 . '\\\\\\"}\\",\\"p7\\":\\"{}';
            } else {
                $needle_res2 = ',\"p0\":\"' . $res;
            }

            $str_skuId3 = substr(
                $scrap_data,
                strpos($scrap_data, $needle_res2) + strlen($needle_res2),
                800
            ); // pokazuje info o wariancie, nalezy stad pobrac dalsze dane jak np ilosc i cene

            $str_availQuantity = substr(
                $str_skuId3,
                strpos($str_skuId3, $needle_check_data3) +
                    strlen($needle_check_data3),
                400
            );
            $str_availQuantity_final = strtok($str_availQuantity, ',"');

            //  preg_match_all('(\d+(?:\.\d+)*)', $str_title_final, $str_availQuantity);
        }

        $str_image = substr(
            $scrap_data,
            strpos($scrap_data, $needle_image) + strlen($needle_image),
            250
        );
        $str_image_prefinal = str_replace('"/', "", $str_image);
        preg_match_all(
            "#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#",
            $str_image_prefinal,
            $str_image_final
        );

        $needle_price_variant = 'value":';
        $str_price = substr(
            $str_skuId3,
            strpos($str_skuId3, $needle_price_variant) +
                strlen($needle_price_variant),
            7
        );
        $str_price_final = strtok($str_price, "},");
        // preg_match_all('(\d+(?:\.\d+)*)', $str_price_final, $str_price_prefinal);

        $str_ship_from = substr(
            $scrap_data,
            strpos($scrap_data, $needle_ship_from) + strlen($needle_ship_from),
            10
        );
        if (strpos($str_ship_from, "China") !== false) {
            $str_ship_from = substr(
                $scrap_data,
                strpos($scrap_data, $needle_ship_from) +
                    strlen($needle_ship_from),
                7
            );
        } elseif (strpos($str_ship_from, "Poland") !== false) {
            $str_ship_from = substr(
                $scrap_data,
                strpos($scrap_data, $needle_ship_from) +
                    strlen($needle_ship_from),
                8
            );
        } elseif (strpos($str_ship_from, "France") !== false) {
            $str_ship_from = substr(
                $scrap_data,
                strpos($scrap_data, $needle_ship_from) +
                    strlen($needle_ship_from),
                8
            );
        } elseif (strpos($str_ship_from, "Czech") !== false) {
            $str_ship_from = substr(
                $scrap_data,
                strpos($scrap_data, $needle_ship_from) +
                    strlen($needle_ship_from),
                14
            );
        } elseif (strpos($str_ship_from, "Belgium") !== false) {
            $str_ship_from = substr(
                $scrap_data,
                strpos($scrap_data, $needle_ship_from) +
                    strlen($needle_ship_from),
                8
            );
        } elseif (strpos($str_ship_from, "Italy") !== false) {
            $str_ship_from = substr(
                $scrap_data,
                strpos($scrap_data, $needle_ship_from) +
                    strlen($needle_ship_from),
                6
            );
        } elseif (strpos($str_ship_from, "Spain") !== false) {
            $str_ship_from = substr(
                $scrap_data,
                strpos($scrap_data, $needle_ship_from) +
                    strlen($needle_ship_from),
                6
            );
        } elseif (strpos($str_ship_from, "Germany") !== false) {
            $str_ship_from = substr(
                $scrap_data,
                strpos($scrap_data, $needle_ship_from) +
                    strlen($needle_ship_from),
                8
            );
        }
        $str_ship_from_prefinal = str_replace('"', "", $str_ship_from);
        $str_ship_from_final = str_replace(",", "", $str_ship_from_prefinal);
        preg_match_all("(\d+(?:\.\d+)*)", $str_ship_from_final, $str_ship_from);

        //  $needle_connect_ids = 'skuPropIds":"'.$str_proper_value_id_final.','.$str_proper_value_id_long_final.'","skuVal":{"availQuantity":';
        $needle_connect_ids =
            'propertyValueDisplayName":"' .
            $which_item .
            '","propertyValueId":';
        $str_avaible_quant = substr(
            $scrap_data,
            strpos($scrap_data, $needle_connect_ids) +
                strlen($needle_connect_ids),
            6
        );
        $str_avaible_quant_prefinal1 = str_replace(",", "", $str_avaible_quant);
        $str_avaible_quant_prefinal2 = str_replace(
            '"',
            "",
            $str_avaible_quant_prefinal1
        );
        $str_avaible_quant_prefinal3 = str_replace(
            "d",
            "",
            $str_avaible_quant_prefinal2
        );
        $str_avaible_quant_final = str_replace(
            "i",
            "",
            $str_avaible_quant_prefinal3
        );
        preg_match_all(
            "(\d+(?:\.\d+)*)",
            $str_avaible_quant_final,
            $str_avaible_quant_prefinal3
        );

        $str_variant_image_scrap = substr(
            $scrap_data,
            strpos($scrap_data, $needle_connect_ids) +
                strlen($needle_connect_ids),
            600
        );
        $str_variant_image_needle = 'skuPropertyImagePath":"';
        $str_variant_image = substr(
            $str_variant_image_scrap,
            strpos($str_variant_image_scrap, $str_variant_image_needle) +
                strlen($str_variant_image_needle),
            450
        );
        $str_variant_image_final = strtok($str_variant_image, '","');
        preg_match_all(
            "(\d+(?:\.\d+)*)",
            $str_variant_image_final,
            $str_variant_image
        );

        $str_delivery_day_max = substr(
            $scrap_data,
            strpos($scrap_data, $needle_delivery_day_max) +
                strlen($needle_delivery_day_max),
            3
        );
        $str_delivery_day_max_prefinal = str_replace(
            ",",
            "",
            $str_delivery_day_max
        );
        $str_delivery_day_max_final = str_replace(
            '"',
            "",
            $str_delivery_day_max_prefinal
        );

        preg_match_all(
            "(\d+(?:\.\d+)*)",
            $str_delivery_day_max_final,
            $str_delivery_day_max_prefinal
        );

        $str_guaranted_delivery_time = substr(
            $scrap_data,
            strpos($scrap_data, $needle_guaranted_delivery_time) +
                strlen($needle_guaranted_delivery_time),
            3
        );
        $str_guaranted_delivery_time_prefinal = str_replace(
            ",",
            "",
            $str_guaranted_delivery_time
        );
        $str_guaranted_delivery_time_final = str_replace(
            '"',
            "",
            $str_guaranted_delivery_time_prefinal
        );
        preg_match_all(
            "(\d+(?:\.\d+)*)",
            $str_guaranted_delivery_time_final,
            $str_guaranted_delivery_time_prefinal
        );

        $str_compose_delivary_date = substr(
            $scrap_data,
            strpos($scrap_data, $needle_compose_delivary_date) +
                strlen($needle_compose_delivary_date),
            7
        );
        $str_compose_delivary_date_prefinal = str_replace(
            ",",
            "",
            $str_compose_delivary_date
        );
        $str_compose_delivary_date_final = str_replace(
            '"',
            "",
            $str_compose_delivary_date_prefinal
        );
        preg_match_all(
            "(\d+(?:\.\d+)*)",
            $str_compose_delivary_date_final,
            $str_compose_delivary_date_prefinal
        );

        $str_free_shippment = substr(
            $scrap_data,
            strpos($scrap_data, $needle_free_shippment) +
                strlen($needle_free_shippment),
            7
        );
        $str_free_shippment_prefinal = str_replace(
            ",",
            "",
            $str_free_shippment
        );
        $str_free_shippment_final = str_replace(
            '"',
            "",
            $str_free_shippment_prefinal
        );
        preg_match_all(
            "(\d+(?:\.\d+)*)",
            $str_free_shippment_final,
            $str_free_shippment_prefinal
        );
        $return = [
            "title" => $str_title_final,
            "image" => $str_image_final[0][0],
            "price" => $str_price_final,
            "free_shippment" => $str_free_shippment_final,
            "ship_from" => $str_ship_from_final,
            "variant" => $which_item,
            "deliveryDayMax" => $str_delivery_day_max_final,
            "guaranteedDeliveryTime" => $str_guaranted_delivery_time_final,
            "logisticsComposeDeliveryDate" => $str_compose_delivary_date_final,
            "avaibleQuantity" => $str_availQuantity_final,
            "variant_image" => $str_variant_image_final,
            "scrap" => $str_skuId3,
        ];
        echo json_encode($return);
    }
}
///////////ALIEXPRESS

function multi_download($urls, $pathToSave, $type)
{
    $filesShopee = glob("update_products/shopee/*"); // get all file names
    foreach ($filesShopee as $file) {
        // iterate files
        if (is_file($file)) {
            unlink($file); // delete file
        }
    }

    $filesAliexpress = glob("update_products/aliepxress/*"); // get all file names
    foreach ($filesAliexpress as $file) {
        // iterate files
        if (is_file($file)) {
            unlink($file); // delete file
        }
    }

    $urls = [];

    $sqlCommand = "";
    if ($type == "shopee") {
        $sqlCommand =
            "SELECT * FROM products_platform where source='shopee' order by id asc";
    } elseif ($type == "aliepxress") {
        $sqlCommand =
            "SELECT * FROM products_platform where source='aliexpress' order by id asc";
    }
    ($query = mysqli_query($conn, $sqlCommand)) or die(mysqli_error($conn));

    while ($row = mysqli_fetch_array($query)) {
        $this_id = $row["id"];
        $this_price = $row["price"];
        $this_source_url = $row["source_url"];
        $apply_array = $this_id . "DELTHIS:" . $this_source_url . " ";
        array_push($urls, $apply_array);
    }

    // updateShopeeGlobal();

    $multi_handle = curl_multi_init();
    $file_pointers = [];
    $curl_handles = [];
    if (!file_exists($pathToSave)) {
        //create folder
        mkdir($pathToSave, 0775);
    }

    foreach ($urls as $key => $url) {
        $filename = strtok($url, "DELTHIS") . ".html";
        $url = trim(substr($url, strpos($url, "DELTHIS")));
        $url = str_replace("DELTHIS:", "", $url);
        $file = $pathToSave . "/" . $filename;

        $curl_handles[$key] = curl_init($url);
        if (!file_exists($file)) {
            $file_pointers[$key] = fopen($file, "w");
            curl_setopt($curl_handles[$key], CURLOPT_AUTOREFERER, true);
            curl_setopt($curl_handles[$key], CURLOPT_HEADER, 0);
            curl_setopt($curl_handles[$key], CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl_handles[$key], CURLOPT_TIMEOUT, 30); //30s
            curl_setopt($curl_handles[$key], CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl_handles[$key], CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl_handles[$key], CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt(
                $curl_handles[$key],
                CURLOPT_FILE,
                $file_pointers[$key]
            );
            curl_multi_add_handle($multi_handle, $curl_handles[$key]);
        }
    }
    // Download the files
    do {
        curl_multi_exec($multi_handle, $running);
    } while ($running > 0);

    // Free up objects
    foreach ($urls as $key => $url) {
        curl_multi_remove_handle($multi_handle, $curl_handles[$key]);
        curl_close($curl_handles[$key]);
        if ($file_pointers[$key]) {
            fclose($file_pointers[$key]);
        }
    }
    curl_multi_close($multi_handle);
    if ($type == "shopee") {
        updateShopeeGlobal();
    } elseif ($type == "aliepxress") {
        updateAliexpressGlobal();
    }
}
multi_download($urls, "update_products/shopee", "shopee");
multi_download($urls, "update_products/aliexpress", "aliepxress");

?>
