<?php
Namespace Nodopiano\Corda\Api\Contracts;

Interface ApiInterface
{
    public function posts($id = null);
    public function pages($id = null);
    public function media($id = null);
    public function getUrl();
    public function customPost($type,$id);
    public function get();
    public function toArray($response);
    public function toJson($response);
}