<?php

namespace App\DummyJson;

interface DummyJsonInterface
{
    /**
     * @param int $limit
     * @param int $skip
     * @param array<string> $select
     * @return array<string, mixed>
     */
    function get(): array;
}