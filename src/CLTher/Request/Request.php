<?php
namespace CLTher\Request;

use CLTher\Contracts\RequestInterface;
use function GuzzleHttp\Psr7\build_query;

class Request implements RequestInterface {
    private $method = 'GET';
    private $appID = '';
    private $data = [];
    private $url = '';
    private $_curl = null;

    public function __construct(string $url, string $appID)
    {
        $this->setAPPID($appID);
        $this->setRequestUrl($url);
    }

    public function setRequestUrl(string $url)
    {
        $this->url = $url;
    }

    public function setAPPID(string $appID)
    {
        $this->appID = $appID;
    }

    public function setData(array $data = [], bool $push = null)
    {
        if(!$push) $this->data = $data;
        else {
            foreach($data as $key => $val) {
                $this->data[$key] = $val;
            }
        }
    }

    public function setMethod(string $method)
    {
        if(in_array($method, ['GET','POST'])) {
            $this->method = $method;
        } else {
            throw new Exception("Allowed method is GET or POST", 503);
        }
    }

    public function setPath(string $path): string
    {
        return $this->path = $this->url . '/' . $path;
    }

    public function initRequest()
    {
        return $this->_curl = curl_init();
    }

    public function execute(string $path, string $method = 'GET', array $data = [])
    {
        $this->initRequest();
        $this->setPath($path);
        $this->setMethod($method);
        $this->setData($data);
        $this->setData(['appid' => $this->appID], true);
        
        if($this->method == 'GET') {
            $query = http_build_query($this->data);
            $this->setPath($path . '?' . $query);
        }

        curl_setopt($this->_curl, CURLOPT_URL, $this->path);
        curl_setopt($this->_curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, 1);
        
        if($this->method == 'POST') {
            curl_setopt($this->_curl, CURLOPT_POST, 1);
            curl_setopt($this->_curl, CURLOPT_POSTFIELDS, $this->data);
        }

        $response = curl_exec($this->_curl);

        if($response) {
            return $response;
        }

        return null;
    }

}