<?php
header ("Content-Type:text/xml");
    $ch = curl_init();
    $xml_url='http://localhost:8000/status3.xsl';

    curl_setopt($ch, CURLOPT_URL, $xml_url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    $data = curl_exec($ch);
    echo $data;
    curl_close($ch);
?>