<?php
namespace Model;

use CoffeeCode\DataLayer\DataLayer;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../config/db.php';

class Book extends DataLayer {

    public function __construct() {
        parent::__construct("books", ["title", "author", "published_date"], "id", false);
    }
    
}