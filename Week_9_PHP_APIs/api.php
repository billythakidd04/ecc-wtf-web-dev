<?php
ini_set('display_errors', 1);

require __DIR__.'/vendor/autoload.php';

use \Slim\Factory\AppFactory;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \WFDWeb\Student;

$app = AppFactory::create();

// adding this so I dont have to do some tricky nonsense and can avoid long route names... efficient huh? 
$app->setBasePath((function () {
	// literally everything in here is to avoid typing Week_whatever each time this gets copied for the next week. DO NOT DO THIS!!!
	$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
	$uri = (string) parse_url('http://a' . $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
	if (stripos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
		return $_SERVER['SCRIPT_NAME'];
	}
	if ($scriptDir !== '/' && stripos($uri, $scriptDir) === 0) {
		return $scriptDir;
	}
	return '';
})().'/api');// Append route with api cuz I don't want to write that every time also

// this route does nothing but print "test" I'm leaving it here for testing
$app->get('/', function (Request $request, Response $response, array $args) {
	$response->getBody()->write("test");

	return $response;
});

// handle show all students route `/students/`
$app->get('/students/', function (Request $request, Response $response, array $args) {
	echo 'show all students';
	$students = Student::listStudents();
	$studentsJSON = json_encode($students);
	$response->getBody()->write($studentsJSON);

	return $response;
});

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
	$name = $args['name'];
	$response->getBody()->write("Hello, $name");

	return $response;
});
$app->run();
