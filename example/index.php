<?php

date_default_timezone_set('Asia/Jakarta');

use CLTher\CLTher;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/constant.php';

header("Content-Type: application/json");

if(file_exists(SYSTEM_PATH)) {
    $fl = fopen(SYSTEM_PATH, 'r');
    $content = null;

    if($fl) {
        while (!feof($fl)) {
            $content .= fread($fl, 9999);
        }

        fclose(($fl));
    }

    $weather = unserialize($content);

    echo json_encode($weather->weather, JSON_PRETTY_PRINT);
} else {
    $weather = new CLTher(SYSTEM_MODE, CONSTANT_PATH);
    $result = $weather->setLat(LATITUDE)->setLon(LONGITUDE)->setUnits(UNITS)->getweather();

    $fl = fopen(SYSTEM_PATH, 'w');

    fwrite($fl, serialize($weather));

    fclose($fl);

    echo json_encode($result, JSON_PRETTY_PRINT);
}