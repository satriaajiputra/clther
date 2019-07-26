# CLTher

This package can find current weather status at some location by using ``latitude`` and ``longitude``

This package use API from [OpenWeatherMap](https://openweathermap.org)

## Implementation
The example implementation of this package can found at ``example`` folder

## System Configuration
This package use default configuration that defined at package ``src`` folder.
To change system configuration, you can create a ``constant.php`` file. The example can found at ``example`` folder

```php
<?php

// mode (DEVELOPMENT OR PRODUCTION)
$constant['SYSTEM_MODE'] = 'PRODUCTION';

// latitude longitude Bandung City
$constant['LATITUDE'] = -6.9042112;
$constant['LONGITUDE'] = 107.5882227;

// system constant
$constant['PRODUCTION_API_URL'] = 'https://api.openweathermap.org';
$constant['DEVELOPMENT_API_URL'] = 'https://samples.openweathermap.org';
$constant['PRODUCTION_APP_ID'] = 'yourapikey';
$constant['DEVELOPMENT_APP_ID'] = 'b6907d289e10d714a6e88b30761fae22';
$constant['CONSTANT_PATH'] = __DIR__ . '/constant.php'; // custom constant file
$constant['SYSTEM_PATH'] = __DIR__ . '/cache/weather.dat'; // cache file name
```

## Refresh data
Weather data will updated automatically if you add this script to your ``crontab`` or ``cron``.
Because this package use free API key, recommended refresh time is every 10 minutes
Add this script to youir ``cronjob``:
```
10  * * * * php /path/to/folder/refresh.php >/dev/null 2>&1
```
Change ``/path/to/folder`` to your ``refresh.php`` location.

Copyright &copy; 2019. [Satmaxt Developer](https://satmaxt.xyz). Coded with :heart: & :coffee: at Bandung