<?php
ini_set('display_errors', 1);

require __DIR__.'/vendor/autoload.php';

use \Slim\Factory\AppFactory;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \WFDWeb\Student;

$app = AppFactory::create();

$middleware = $app->addErrorMiddleware(true,true,true);

// $app->setBasePath((function () {
// 	$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
// 	$uri = (string) parse_url('http://a' . $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
// 	if (stripos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
// 		return $_SERVER['SCRIPT_NAME'];
// 	}
// 	if ($scriptDir !== '/' && stripos($uri, $scriptDir) === 0) {
// 		return $scriptDir;
// 	}
// 	return '';
// })());

$app->get('/', function (Request $request, Response $response, array $args) {
	// $name = $args['name'];
	$response->getBody()->write("test");

	return $response;
});

// handle show all students route `/api/students/`
$app->get('/api/students/', function (Request $request, Response $response, array $args) {
	echo 'show all students';
	// $students = Student::listStudents();
	// $studentsJSON = json_encode($students);
	$response->getBody()->write('test');

	return $response;
});

$app->get('/api/hello/{name}', function (Request $request, Response $response, array $args) {
	$name = $args['name'];
	$response->getBody()->write("Hello, $name");

	return $response;
});
$app->run();
