<?php
ini_set('display_errors', 1);

use \Slim\Factory\AppFactory;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \WFDWeb\Student;

require 'vendor/autoload.php';

$app = AppFactory::create();

// handle show all students route `/api/students/`
$app->get('/api/students/', function (Request $request, Response $response, array $args) {
	echo 'show all students';
	$students = Student::listStudents();
	$studentsJSON = json_encode($students);
	$response->getBody()->write('test');

	return $response;
});

$app->get('/api/hello/{name}', function (Request $request, Response $response, array $args) {
	$name = $args['name'];
	$response->getBody()->write("Hello, $name");

	return $response;
});
$app->run();
