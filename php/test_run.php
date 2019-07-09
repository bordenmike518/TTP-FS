<?php

    $stocks = implode(',', array("goog"));

    $url = "https://api.iextrading.com/1.0/tops?symbols=" . $stocks;


    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);

    curl_close($ch);

    $result = json_decode($result, true);

    if($result) {
        print_r($result[0]['symbol']);
    }
?>