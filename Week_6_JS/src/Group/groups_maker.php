<?php
error_reporting(-1);
require_once("src/DB/db_connect.php");

/**
 * getRandomElements
 *
 * @param array $inputArray
 * @param integer $numMembers
 * @return array array of random keys equal to inputArray length or #numMembers whichever is less
 */
function getRandomElements(array $inputArray, int $numMembers): array {
	// get rand values
	if (empty($inputArray)) {
		throw new \InvalidArgumentException("empty array passed!!");
	}

	// array_rand will cause an infinite loop of warnings if array length < requested number of values
	if ($numMembers > count($inputArray)) {
		// just send back the remaining keys
		return array_keys($inputArray);
	}

	return array_rand($inputArray, $numMembers);
}

/**
 * createGroups
 *
 * @return array multidimensional array of groups and members
 */
function createGroups()
{
	// list of student names
	$students = array(
		'Ali, Elyas',
		'Baia, Rebecca',
		'Brown, Waymon',
		'Burdick, Nicholas',
		'Chhabra, Gagan',
		'Clark, Charles',
		'Frazzini, Anthony',
		'Kased, Eiman',
		'Lainson, Christopher',
		'Ricci Jr., Vincent',
		'Schrecongost, Margaret',
		'Saulon, William',
	);

	// create empty groups array
	$groups = array();
	// start with group id at 0
	$groupID = 0;
	// create groups of 3 until there is nobody left
	while (count($students) > 0) {
		$tmpGroup = $groups[$groupID] ?? [];
		foreach (getRandomElements($students, 3) as $key) {
			array_push($tmpGroup, $students[$key]);
			unset($students[$key]);
		}

		$groups[$groupID] = $tmpGroup;

		++$groupID;
	}

	return $groups;
}
