<?php
date_default_timezone_set('Asia/Jakarta');
use CLTher\CLTher;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/constant.php';

$weather = new CLTher(SYSTEM_MODE, CONSTANT_PATH);

$result = $weather->setLat(LATITUDE)->setLon(LONGITUDE)->setUnits(UNITS)->getweather();

$fl = fopen(SYSTEM_PATH, 'w');

fwrite($fl, serialize($weather));

fclose($fl);