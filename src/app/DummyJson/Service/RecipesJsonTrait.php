<?php

namespace App\DummyJson\Service;

trait RecipesJsonTrait
{
    /**
     * @param ?string $tag
     * @return array<string, mixed>
     */
    function tag(?string $tag = null): array
    {
        if(isset($tag))
        {
            return $this->curlRequest($this->api . '/tag/' . $tag);
        }

        return $this->curlRequest($this->api . '/tags');
    }

    /**
     * @param string $type
     * @return array<string, mixed>
     */
    function meal(string $type): array
    {
        return $this->curlRequest($this->api . '/meal-type/' . $type);
    }
}