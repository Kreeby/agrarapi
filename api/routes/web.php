<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->post('/login', 'AuthController@login');

$router->get('/logout', 'AuthController@logout');

$router->post('/register', 'AuthController@register');

$router->post('/listUsers', 'AuthController@listUsers');


$router->get('/selectQuestion', 'QuestionController@selectQuestion');

$router->post('/addQuestion', 'QuestionController@addQuestion');
$router->get('/listQuestions', 'QuestionController@listQuestions');
$router->post('/listByWhom', 'QuestionController@listByWhom');



$router->post('/giveAnswer', 'AnswersController@giveAnswer');