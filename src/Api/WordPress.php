<?php
Namespace Nodopiano\Corda\Api;

Use Nodopiano\Corda\App;
use GuzzleHttp\Client;
use Nodopiano\Corda\Api\Contracts\ApiInterface;

class WordPress implements ApiInterface
{

    protected $api;
    protected $query;
    protected $client;
    protected $headers = array();
    protected $filter;

    public function __construct()
    {
        $username = getenv('WPUSER');
        $password = getenv('WPPASS'); 
        $this->api = App::get('api');
        if ($username && $password) $this->headers['Authorization'] = 'Basic ' . base64_encode( $username . ':' . $password );  
        $this->filters = $_GET;
        $uri = App::get('api')['url'];
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $uri,
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
    }

    public function posts($id = null)
    {
        $this->query = 'posts/'.$id;
        return $this;
    }

    public function pages($id = null)
    {
        $this->query = 'pages/'.$id;
        return $this;
    }

    public function media($id = null)
    {
        $this->query = 'media/'.$id;
        return $this;
    }

    public function getUrl()
    {
        return $this->api['url'].$this->query;
    }

    public function customPost($type,$id)
    {
        $this->query = $type.'/'.$id;
        return $this;
    }

    public function get()
    {
        $response = $this->client->request('GET',$this->query, array('query' => $this->filters, 'headers' => $this->headers));
        return $this->toArray($response);
    }

    public function toArray($response)
    {
        return json_decode($response->getBody());
    }

    public function toJson($response)
    {
        return $response->getBody();
    }

}
