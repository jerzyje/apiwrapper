<?php

namespace ApiWrapper;

require_once 'vendor/autoload.php';
require_once 'ClientA.php';

class Wrapper
{
    private $client;

    public function __construct()
    {
        $this->client = new ClientA();
    }

    public function getBooks($limit = 0, $offset = 0)
    {
        return $this->client->books($limit, $offset);
    }

    public function getAuthors($limit = 0, $offset = 0)
    {
        return $this->client->authors($limit, $offset);
    }

    public function getAuthorsBooks($id, $limit = 0, $offset = 0)
    {
        return $this->client->authors_books($id, $limit, $offset);
    }

}