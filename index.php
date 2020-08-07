<?php
require_once 'ApiWrapper.php';

$api = new ApiWrapper\Wrapper();

var_dump( $api->getAuthors() );
var_dump( $api->getBooks() );
var_dump( $api->getAuthorsBooks(1, 2, 2) );