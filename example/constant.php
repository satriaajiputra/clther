<?php

// mode (DEVELOPMENT OR PRODUCTION)
$constant['SYSTEM_MODE'] = 'PRODUCTION';

// latitude longitude bandung
$constant['LATITUDE'] = -6.9042112;
$constant['LONGITUDE'] = 107.5882227;

// system constant
$constant['PRODUCTION_API_URL'] = 'https://api.openweathermap.org';
$constant['DEVELOPMENT_API_URL'] = 'https://samples.openweathermap.org';
$constant['PRODUCTION_APP_ID'] = 'yourapikey';
$constant['DEVELOPMENT_APP_ID'] = 'b6907d289e10d714a6e88b30761fae22';
$constant['CONSTANT_PATH'] = __DIR__ . '/constant.php';
$constant['SYSTEM_PATH'] = __DIR__ . '/cache/weather.dat';

foreach($constant as $key => $val) {
    if( !defined($key) ) {
        define($key, $val);
    }
}