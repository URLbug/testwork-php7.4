<?php

namespace App\DummyJson;

use App\DummyJson\Service\PostsJsonTrait;
use App\DummyJson\Service\ProductsJsonTrait;
use App\DummyJson\Service\RecipesJsonTrait;
use App\DummyJson\Service\UsersJsonTrait;

final class DummyJson implements DummyJsonInterface
{
    use ProductsJsonTrait, RecipesJsonTrait, PostsJsonTrait, UsersJsonTrait;

    private string $api = 'https://dummyjson.com';
    private string $params = '';

    function __construct(string $table)
    {
        $this->api .= '/' . $table;
    }

    /**
     * @return array<string, mixed><string, mixed>
     */
    private function curlRequest(
        string $url, 
        string $method = 'GET', 
        array $data = []
    ): array {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if(
            $method === 'POST' || 
            $method === 'PATCH'
        ) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        
        $response = curl_exec($ch);

        curl_close($ch);

        return (array)json_decode($response);
    }

    function get(): array 
    {
        $url = $this->api;
        
        if($this->params !== '')
        {
            return $this->curlRequest($url . '?' . $this->params);
        }

        return $this->curlRequest($url);
    }

    function add(array $data): array
    {
        return $this->curlRequest($this->api . '/add', 'POST', $data);
    }

    /**
     * Находит по ID продукт.
     * @param int $id
     * @return array<string, mixed>
     */
    function findBy(int $id): array
    {
        return $this->curlRequest($this->api . '/' . $id);
    }

    /**
     * @param int $limit
     * @return \App\DummyJson\DummyJson
     */
    function limit(int $limit = 0): DummyJson
    {
        $this->params .= '&limit=' . $limit;

        return $this;
    }

    /**
     * @param int $skip
     * @return \App\DummyJson\DummyJson
     */
    function skip(int $skip = 0): DummyJson
    {
        $this->params .= '&skip=' . $skip;

        return $this;
    }

    /**
     * @param array $select
     * @return \App\DummyJson\DummyJson
     */
    function select(array $select): DummyJson
    {
        $this->params .= '&select=' . join(',', $select);

        return $this;
    }

    /**
     * @param string $query
     * @return \App\DummyJson\DummyJson
     */
    function query(string $query): DummyJson
    {
        $this->params .= '&q=' . $query;

        return $this;
    }

    /**
     * Summary of sortBy
     * @param string $sortBy
     * @return \App\DummyJson\DummyJson
     */
    function sortBy(string $sortBy = 'title'): DummyJson
    {
        $this->params .= '&sortBy=' . $sortBy;

        return $this;
    }

    /**
     * @param string $orderBy
     * @return \App\DummyJson\DummyJson
     */
    function orderBy(string $orderBy = 'asc'): DummyJson
    {
        $this->params .= '&order=' . $orderBy;

        return $this;
    }
}