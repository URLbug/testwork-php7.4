<?php

namespace App\DummyJson\Service;

trait PostsJsonTrait
{
   function comments(int $id): array
   {
        return $this->curlRequest($this->api . '/' . $id . '/comments');
   }

   function userById(int $id): array
   {
        return $this->curlRequest($this->api . '/user' . $id);
   }
}