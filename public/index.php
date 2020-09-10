<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Model\Book;

$loader = require __DIR__ . '/../vendor/autoload.php';

$app = new App();

// Get all books
$app->get('/books', function(Request $request, Response $response){
    $books = new Book();
    $book_obj = $books->find()->fetch(true);
    $i = 0;
    foreach($book_obj as $book) {
        $book_data[$i]['id'] = $book->id;
        $book_data[$i]['title'] = $book->title;
        $book_data[$i]['author'] = $book->author;
        $book_data[$i]['published_date'] = $book->published_date;
        $i++;
    }
    return $response->withJson($book_data, 300);
});

// Insert book
$app->post('/books', function(Request $request, Response $response){
    $book = new Book();
    $book_data = $request->getParsedBody();
    $book->title = $book_data['title'];
    $book->author = $book_data['author'];
    $book->published_date = $book_data['published_date'];
    $bookId = $book->save();

    if($book->fail()) {
        $response->getBody()->write($book->fail()->getMessage());        
    }

    $response->getBody()->write($bookId);
});

$app->run();