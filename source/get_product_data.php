<?php
require_once "config.php";
function getBetween($string, $start = "", $end = "")
{
    if (strpos($string, $start)) {
        // required if $start not exist in $string
        $startCharCount = strpos($string, $start) + strlen($start);
        $firstSubStr = substr($string, $startCharCount, strlen($string));
        $endCharCount = strpos($firstSubStr, $end);
        if ($endCharCount == 0) {
            $endCharCount = strlen($firstSubStr);
        }
        return substr($firstSubStr, 0, $endCharCount);
    } else {
        return "";
    }
}

if ($_POST["datatype"] == "url") {
    if (
        substr($_POST["url"], 0, 2) === "AK" ||
        substr($_POST["url"], 0, 2) === "AG" ||
        substr($_POST["url"], 0, 2) === "AB" ||
        substr($_POST["url"], 0, 2) === "FT" ||
        substr($_POST["url"], 0, 2) === "CA" ||
        substr($_POST["url"], 0, 2) === "PS" ||
        substr($_POST["url"], 0, 2) === "ZG" ||
        substr($_POST["url"], 0, 2) === "OD" ||
        substr($_POST["url"], 0, 2) === "AN" ||
        substr($_POST["url"], 0, 2) === "GR" ||
        substr($_POST["url"], 0, 2) === "HD" ||
        substr($_POST["url"], 0, 2) === "KK" ||
        substr($_POST["url"], 0, 2) === "KM" ||
        substr($_POST["url"], 0, 2) === "PK" ||
        substr($_POST["url"], 0, 2) === "PL" ||
        substr($_POST["url"], 0, 2) === "SW" ||
        substr($_POST["url"], 0, 2) === "TB" ||
        substr($_POST["url"], 0, 2) === "LN" ||
        substr($_POST["url"], 0, 2) === "ST" ||
        substr($_POST["url"], 0, 2) === "ZD" ||
        substr($_POST["url"], 0, 2) === "KX"
    ) {
        $xml = "";
        $request_url = "";
        $request_url =
            "ftp://f1431_cashprom:ua&mCxuala&S74CEVueW@localhost:21/domains/alione.pl/public_html/platform/bna.xml";
        $xml_url = simplexml_load_file($request_url);
        if ($xml_url == false) {
            throw new Exception("No XML data retrieved");
        }

        $produkt = $xml_url->xpath(
            'produkt[indeks_katalogowy="' . $_POST["url"] . '"]'
        );

        $str_image_final = $produkt[0]->zdjecie;

        $str_title_final = $produkt[0]->nazwa;

        $str_price_final = $produkt[0]->cena_netto_bez;

        $str_quantity_final = $produkt[0]->stan;

        if ($str_quantity_final == "Brak") {
            $str_quantity_final = 0;
        } elseif ($str_quantity_final == "Mała ilość") {
            $str_quantity_final = 1;
        } elseif ($str_quantity_final == "Średnia ilość") {
            $str_quantity_final = 2;
        } elseif ($str_quantity_final == "Duża ilość") {
            $str_quantity_final = 3;
        }

        $return = [
            "title" => $str_title_final[0],
            "avaibleQuantity" => $str_quantity_final,
            "indeks" => $_POST["url"],
            "image" => $str_image_final[0],
            "deliveryDayMax" => "3",
            "price" => $str_price_final[0],
            "price_from_server_aptel" => "true",
        ];
        echo json_encode($return);
    } else {
        if (strpos($_POST["url"], "shopee") !== false) {
            function scrapper()
            {
                $url = $_POST["url"];
                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                ]);

                $response = curl_exec($curl);
                return $response;
            }
            $scrap_data = scrapper();
            $needle_title = "twitter:title' content='";
            $needle_image = "twitter:image' content='";
            $needle_price = 'itemprop="price" content="';

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

            $return = [
                "title" => $str_title_final,
                "image" => $str_image_final[0][0],
                "price" => $str_price_final,
                "scrap" => $scrap_data,
            ];
            echo json_encode($return);
        } elseif (strpos($_POST["url"], "aliexpress") !== false) {
            function scrapper()
            {
                $url = $_POST["url"];
                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                ]);

                $response = curl_exec($curl);
                return $response;
            }
            $scrap_data = scrapper();

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
            //  $check_variants ='skuPropertyValueShowOrder":1,"skuPropertyValueTips":"';

            if ($which_item == "unset") {
                $check_variants =
                    'skuPropertyName":"kolor","skuPropertyValues":';
                $check_variants2 =
                    'skuPropertyName":"Color","skuPropertyValues":';
                $check_variants3 =
                    'skuPropertyName":"color","skuPropertyValues":';
                $check_variants4 =
                    'skuPropertyName":"Kolor","skuPropertyValues":';

                $str_variants_count = substr_count(
                    $scrap_data,
                    $check_variants
                );
                $str_variants_count2 = substr_count(
                    $scrap_data,
                    $check_variants2
                );
                $str_variants_count3 = substr_count(
                    $scrap_data,
                    $check_variants3
                );
                $str_variants_count4 = substr_count(
                    $scrap_data,
                    $check_variants4
                );

                if ($str_variants_count > 0) {
                    $str_variants = substr(
                        $scrap_data,
                        strpos($scrap_data, $check_variants) +
                            strlen($check_variants),
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
                        preg_replace(
                            '/[\x00-\x1F\x80-\xFF]/',
                            "",
                            $str_variants_final
                        ),
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
                $str_title_prefinall = str_replace(
                    "|",
                    "",
                    $str_title_prefinal
                );
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
                    strpos($scrap_data, $needle_ship_from) +
                        strlen($needle_ship_from),
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
                $str_ship_from_final = str_replace(
                    ",",
                    "",
                    $str_ship_from_prefinal
                );
                preg_match_all(
                    "(\d+(?:\.\d+)*)",
                    $str_ship_from_final,
                    $str_ship_from
                );

                $needle_connect_ids = '"availQuantity":';
                $str_avaible_quant = substr(
                    $scrap_data,
                    strpos($scrap_data, $needle_connect_ids) +
                        strlen($needle_connect_ids),
                    6
                );
                $str_avaible_quant_prefinal1 = str_replace(
                    ",",
                    "",
                    $str_avaible_quant
                );
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
                $str_avaible_quant_prefinal1 = str_replace(
                    ",",
                    "",
                    $str_avaible_quant
                );
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
                    strpos(
                        $str_variant_image_scrap,
                        $str_variant_image_needle
                    ) + strlen($str_variant_image_needle),
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
                $str_title_prefinall = str_replace(
                    "|",
                    "",
                    $str_title_prefinal
                );
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
                        strpos($parsed2, $needle_scItemId) +
                            strlen($needle_scItemId),
                        27
                    );
                    $res2 = preg_replace("/[^0-9]/", "", $str_skuId2);
                    $needle_res2 = $res2 . '\\\\\\"}\\",\\"p8\\":\\"PL';
                    $str_skuId3 = substr(
                        $scrap_data,
                        strpos($scrap_data, $needle_res2) +
                            strlen($needle_res2),
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
                        strpos($scrap_data, $needle_res2) +
                            strlen($needle_res2),
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
                    strpos($scrap_data, $needle_ship_from) +
                        strlen($needle_ship_from),
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
                $str_ship_from_final = str_replace(
                    ",",
                    "",
                    $str_ship_from_prefinal
                );
                preg_match_all(
                    "(\d+(?:\.\d+)*)",
                    $str_ship_from_final,
                    $str_ship_from
                );

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
                $str_avaible_quant_prefinal1 = str_replace(
                    ",",
                    "",
                    $str_avaible_quant
                );
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
                    strpos(
                        $str_variant_image_scrap,
                        $str_variant_image_needle
                    ) + strlen($str_variant_image_needle),
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
            } //     else of    if ($which_item == "unset"){

            /*

        $variants_array = array();

        $check_variants ='"skuPropertyTips":"';

str_ireplace("CHINA","","");




        $str_variants_count = substr_count($scrap_data_variants,$check_variants);
        for ($x = 0; $x <= $str_variants_count; $x++) {
            if ($str_variants_prefinal != "CHINA"){
            
                    }

        $str_variants[$x] = substr($scrap_data_variants, strpos($scrap_data, $check_variants[$x]) + strlen($check_variants[$x]), 15);
        $str_variants_prefinal[$x] = strtok($str_variants[$x], '"');
        array_push($variants_array, $str_variants_prefinal[$x]);
}
*/

            //echo json_encode($scrap_data);
        }
    }
} elseif ($_POST["datatype"] == "id") {
    $product_id = $_POST["id"];
    $sql = "SELECT * FROM products_platform WHERE id='" . $product_id . "' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $return = [
        "title" => $row["title"],
        "image" => $row["img"],
        "price" => $row["price"],
        "comments" => $row["comments"],
        "variant" => $row["variant"],
        "suggested_title" => $row["suggested_title"],
        "source_price" => $row["source_price"],
        "price_from_server_aptel" => "false",
        "source_shippment_price" => $row["source_shippment_price"],
        "source_shippment_from" => $row["source_shippment_from"],
        "source_shippment_price" => $row["source_shippment_price"],
        "source_shippment_time" => $row["source_shippment_time"],
        "added_allegro" => $row["added_allegro"],
        "added_allegro_by" => $row["added_allegro_by"],
        "added_allegro_date" => $row["added_allegro_date"],
        "added_by" => $row["added_by"],
        "added_date" => $row["added_date"],
        "need_update_allegro" => $row["need_update_allegro"],
        "added_olx" => $row["added_olx"],
        "added_olx_by" => $row["added_olx_by"],
        "added_olx_date" => $row["added_olx_date"],
        "need_update_olx" => $row["need_update_olx"],
        "added_erli" => $row["added_erli"],
        "added_erli_by" => $row["added_erli_by"],
        "added_erli_date" => $row["added_erli_date"],
        "need_update_erli" => $row["need_update_erli"],
        "added_alione" => $row["added_alione"],
        "added_alione_by" => $row["added_alione_by"],
        "added_alione_date" => $row["added_alione_date"],
        "need_update_alione" => $row["need_update_alione"],
        "added_sprzedajemy" => $row["added_sprzedajemy"],
        "added_sprzedajemy_by" => $row["added_sprzedajemy_by"],
        "added_sprzedajemy_date" => $row["added_sprzedajemy_date"],
        "need_update_sprzedajemy" => $row["need_update_sprzedajemy"],
        "added_shopee" => $row["added_shopee"],
        "added_shopee_by" => $row["added_shopee_by"],
        "added_shopee_date" => $row["added_shopee_date"],
        "need_update_shopee" => $row["need_update_shopee"],
        "added_google" => $row["added_google"],
        "added_google_by" => $row["added_google_by"],
        "added_google_date" => $row["added_google_date"],
        "need_update_google" => $row["need_update_google"],
        "added_fb_marketplace" => $row["added_fb_marketplace"],
        "added_fb_marketplace_by" => $row["added_fb_marketplace_by"],
        "added_fb_marketplace_date" => $row["added_fb_marketplace_date"],
        "need_update_fb_marketplace" => $row["need_update_fb_marketplace"],
        "added_pinterest" => $row["added_pinterest"],
        "added_pinterest_by" => $row["added_pinterest_by"],
        "added_pinterest_date" => $row["added_pinterest_date"],
        "need_update_pinterest" => $row["need_update_pinterest"],
    ];
    echo json_encode($return);
}

?>
