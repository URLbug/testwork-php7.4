<?php

namespace App\DummyJson\Service;

trait ProductsJsonTrait
{
        /**
     * Показывает все категории.
     * @return array<string, mixed>
     */
    function categories(): array
    {
        return $this->curlRequest($this->api . '/categories');
    }

    /**
     * Выводит список категорий если параметер byCatrgory пустой.
     * Если byCatrgory написана категория, то выводит все продукты с этой категорией.
     * @param mixed $byCatrgory
     * @return array<string, mixed>
     */
    function category(?string $byCatrgory = null): array 
    {
        if(isset($byCatrgory))
        {
            return $this->curlRequest($this->api . '/category/' . $byCatrgory);
        }

        return $this->curlRequest($this->api . '/category-list');
    } 
}