<?php

    function getStockData($stocks) {
        $csv = implode(',', $stocks);
        $url = "https://api.iextrading.com/1.0/tops?symbols=" . $csv;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);            // Read up on parameters!!!
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Read up on parameters!!!
        $result = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($result);
        $stockDict = array();
        foreach($json as &$row) {
            $stockDict[$row["symbol"]] = array_slice($row, 1);
        }
        return $stockDict;
    }

?>
