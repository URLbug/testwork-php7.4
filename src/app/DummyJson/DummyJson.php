<?php

namespace App\DummyJson;

final class DummyJson implements DummyJsonInterface
{
    private string $api = 'https://dummyjson.com/products';
    private string $params = '?';

    /**
     * @return array<string, mixed>
     */
    private function curlRequest(
        string $url, 
        string $method = 'GET', 
        array $data = []
    ): array {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
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
        $url = $this->api . $this->params;

        return $this->curlRequest($url);
    }

    function findBy(int $id): array
    {
        return $this->curlRequest($this->api . '/' . $id);
    }

    function category(?string $byCatrgory = null): array 
    {
        if(isset($byCatrgory))
        {
            return $this->curlRequest($this->api . '/category/' . $byCatrgory);
        }

        return $this->curlRequest($this->api . '/category-list');
    }

    function limit(int $limit = 0): DummyJson
    {
        $this->params .= '&limit=' . $limit;

        return $this;
    }

    function skip(int $skip = 0): DummyJson
    {
        $this->params .= '&skip=' . $skip;

        return $this;
    }

    function select(array $select): DummyJson
    {
        $this->params .= '&select=' . join(',', $select);

        return $this;
    }

    function query(string $query): DummyJson
    {
        $this->params .= '&q=' . $query;

        return $this;
    }

    function sortBy(string $sortBy = 'title'): DummyJson
    {
        $this->params .= '&sortBy=' . $sortBy;

        return $this;
    }

    function orderBy(string $orderBy = 'asc'): DummyJson
    {
        $this->params .= '&order=' . $orderBy;

        return $this;
    }
}