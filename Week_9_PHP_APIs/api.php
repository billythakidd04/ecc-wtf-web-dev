<?php
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

use WFDWeb\Group;
use WFDWeb\Student;
use Slim\Factory\AppFactory;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

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
})() . '/api'); // Append route with api cuz I don't want to write that every time also

// this route does nothing but print "test" I'm leaving it here for testing
$app->get('/', function (Request $request, Response $response, array $args) {
	$response->getBody()->write("test");

	return $response;
});

// handle show all students route `/students`
$app->get('/students', function (Request $request, Response $response, array $args) {
	$students = Student::listStudents();

	$studentsJSON = json_encode($students);
	$response->getBody()->write($studentsJSON);

	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
});

// handle show all groups route `/groups`
$app->get('/groups', function (Request $request, Response $response, array $args) {
	$groups = Group::listGroups();

	$groupsJSON = json_encode($groups);
	$response->getBody()->write($groupsJSON);

	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
});

// handle show student route `/student/{id|name}`
$app->get('/student/{value}', function (Request $request, Response $response, array $args) {
	$value = $args['value'];
	if ($value === '0') {
		// we are going to check against ID and names and neither can be zero but will make intval crazy
		throw new InvalidArgumentException("Zero is not a valid identifier");
	}

	$student = new Student();
	if (intval($value)) {
		// we can assume they gave us an id
		$student = Student::findStudentByID($value);
	} else {
		$student = Student::findStudentByName($value);
	}

	$studentJSON = json_encode($student);
	$response->getBody()->write($studentJSON);

	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
});

// handle show group route `/group/id/{id}`
$app->get('/group/id/{id}', function (Request $request, Response $response, array $args) {
	$value = $args['id'];
	if ($value === '0') {
		// we are going to check against ID and names and neither can be zero but will make intval crazy
		throw new InvalidArgumentException("Zero is not a valid identifier");
	}

	// we can assume they gave us an id
	$group = Group::findGroupByID(intval($value));

	$groupJSON = json_encode($group);
	$response->getBody()->write($groupJSON);

	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
});

// handle show group route `/group/num/{groupNumber}`
$app->get('/group/num/{num}', function (Request $request, Response $response, array $args) {
	$value = $args['num'];
	if ($value === '0') {
		// we are going to check against ID and names and neither can be zero but will make intval crazy
		throw new InvalidArgumentException("Zero is not a valid identifier");
	}

	// we can assume they gave us an id
	$group = Group::findGroupByNumber(intval($value));

	$groupJSON = json_encode($group);
	$response->getBody()->write($groupJSON);

	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(200);
});

/**
 * handle new student route `/student/new` POST method
 */
$app->post('/student/new', function (Request $request, Response $response, array $args) {
	$reqBodyJSON = $request->getBody();
	$reqBody = json_decode($reqBodyJSON);

	$student = new Student();
	if (intval($reqBody->id)) {
		// we can assume they gave us an id
		$student = Student::findStudentByID($reqBody->id);
	}

	// TODO validation on student value params
	$student->firstName = $reqBody->first_name ?? '';
	$student->lastName = $reqBody->last_name ?? '';
	$student->email = $reqBody->email ?? '';
	$student->repositoryURL = $reqBody->repo_url ?? '';
	$student->groupID = $reqBody->group_id ?? null;

	if ($student->saveToDB()) {
		$studentJSON = json_encode($student);
		$response->getBody()->write($studentJSON);

		return $response
			->withHeader('Content-Type', 'application/json')
			->withStatus(201);
	}

	return $response->withStatus(500);
});

$app->run();
