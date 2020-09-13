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
    return $response->withJson($book_data, 200);
});

// Get book by id
$app->get('/books/{id}', function(Request $request, Response $response, array $args){
        $id = $args['id'];
        $books = new Book();
        $book_obj = $books->findById($id);
        if($book_obj == null) {
            return $response->withJson(array('Message' => "Book not found!"), 404);
        }
        $book_data['id'] = $book_obj->id;
        $book_data['title'] = $book_obj->title;
        $book_data['author'] = $book_obj->author;
        $book_data['published_date'] = $book_obj->published_date;
        return $response->withJson($book_data, 200);
});

// Create book
$app->post('/books', function(Request $request, Response $response){
    $book = new Book();
    $book_data = $request->getParsedBody();
    $book->title = $book_data['title'];
    $book->author = $book_data['author'];
    $book->published_date = $book_data['published_date'];
    $result = $book->save();

    if($result == "") {
        return $response->withJson(array('Message' => "There are null fields in your request data!"), 400);
    }

    return $response->withJson(array('Message' => "Book saved successfully!"), 200);
});

// Update book
$app->put('/books/{id}', function(Request $request, Response $response, array $args) {
    $id = $args['id'];
    $book = (new Book())->findById($id);
    if(!$book) {
        return $response->withJson(array('Message' => "Book not found!"), 404);
    }
    $book_data = $request->getParsedBody();
    $book->title = $book_data['title'];
    $book->author = $book_data['author'];
    $book->published_date = $book_data['published_date'];
    $result = $book->save();

    if($result == "") {
        return $response->withJson(array('Message' => "There are null fields in your request data!"), 400);
    }

    return $response->withJson(array('Message' => "Book saved successfully!"), 200);
});

$app->run();
