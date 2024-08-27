<?php

namespace App\DummyJson;

interface DummyJsonInterface
{
     /**
     * Получает данные об продукте.
     * Если были использованы какие-то параметры, то возвращает вмести с ними.
     * @return array<string, mixed>
     */
    function get(): array;

    /**
     * @return array
     */
    function add(): array;
}