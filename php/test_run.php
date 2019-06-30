<?php

    $url = "http://www.govliquidation.com/json/buyer_ux/salescalendar.js";

    $json = file_get_contents($url, 0, null, null);

    $data = json_decode($json, JSON_PRETTY_PRINT);

    print_r($data);

?>
