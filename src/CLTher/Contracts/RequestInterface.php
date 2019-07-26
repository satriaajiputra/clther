<?php
namespace CLTher\Contracts;

interface RequestInterface {
    /**
     * Set request URL
     * 
     * @param string $url
     */
    public function setRequestUrl(string $url);

    /**
     * Execute request with CURL
     * 
     * @param string $path (/data/forecast/etc)
     * @param string $method (GET, POST)
     * @param array $data ([key => value])
     * 
     * @return object|null
     */
    public function execute(string $path, string $method = 'GET', array $data = []);

    /**
     * Set APP ID for request
     * 
     * @param string $appID
     */
    public function setAPPID(string $appID);

    /**
     * Set data for send while executing request
     * 
     * @param array $data ([key => value])
     * @param bool $push
     */
    public function setData(array $data = [], bool $push = null);

    /**
     * Set methode request
     * 
     * @param string $method (GET, POST)
     */
    public function setMethod(string $method);

    /**
     * Set path request
     * 
     * @param string $path (/data/forecast/etc)
     * 
     * @return string
     */
    public function setPath(string $path): string;
}