<?php
namespace CLTher;

use Exception;
use CLTher\Request\Request;

class CLTher extends Request
{
    private $lat = null,
            $lon = null,
            $units = 'default';

    public $weather = [];

    public function __construct(string $mode = 'DEVELOPMENT', string $constantVar = __DIR__ . "/Constant/URL.php")
    {
        require $constantVar;

        if($mode == 'DEVELOPMENT') {
            $url = DEVELOPMENT_API_URL;
            $appID = DEVELOPMENT_APP_ID;
        }
        else if ($mode == 'PRODUCTION') {
            $url = PRODUCTION_API_URL;
            $appID = PRODUCTION_APP_ID;
        }
        else throw new Exception("Mode only DEVELOPMENT or PRODUCTION", 503);
        
        parent::__construct($url, $appID);
    }

    public static function init(string $mode = 'DEVELOPMENT', string $constantVar = __DIR__ . "/Constant/URL.php")
    {
        return new CLTher($mode, $constantVar);
    }

    public function setUnits(string $units) {
        if (in_array($units, ['metric', 'imperial', 'default'])) {
            $this->units = $units;
        }
        return $this;
    }

    public function setLat(float $lat)
    {
        $this->lat = $lat;
        return $this;
    }

    public function setLon(float $lon)
    {
        $this->lon = $lon;
        return $this;
    }

    public function getWeather()
    {
        if($this->lat && $this->lon) {
            $data = $this->buildData(['lat', 'lon', 'units']);
        }

        $request = $this->execute('data/2.5/weather', 'GET', $data);
        
        if($request) {
            $response = json_decode($request);
            if($response->cod === 401) throw new Exception($response->message, 503);
            
            return $this->buildWeather($response);
        } else {
            throw new Exception("Failed while getting weather data", 503);
        }
    }

    public function buildWeather(object $weather)
    {
        $list = $weather->weather[0];

        $this->weather['coord'] = $weather->coord;
        $this->weather['weather'] = [
            'time' => date("Y-m-d H:i:s", $weather->dt),
            'icon' => sprintf('https://openweathermap.org/img/wn/%s@2x.png', $list->icon),
            'status' => $list->main,
            'description' => $list->description
        ];
        $this->weather['main'] = $weather->main;
        $this->weather['units'] = $this->units;

        return $this->weather;
    }

    public function buildData(array $data)
    {
        $results = [];

        foreach($data as $value) {
            $results[$value] = $this->{$value};
        }

        return $results;
    }

    public function __sleep()
    {
        return ['lat', 'lon', 'weather'];
    }
}
