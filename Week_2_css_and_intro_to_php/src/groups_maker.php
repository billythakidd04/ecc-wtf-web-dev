<?php
error_reporting(-1);

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
		'test',
		'test2',
	);

	// create empty groups array
	$groups = array();
	// start with group id at 0
	$groupID = 0;
	// create groups of 3 until there is nobody left
	while (count($students) > 0) {
		// echo "count students = " . count($students);
		$tmpGroup = $groups[$groupID] ?? [];
		foreach (getRandomElements($students, 3) as $key) {
			array_push($tmpGroup, $students[$key]);
			unset($students[$key]);
		}

		// var_dump($tmpGroup);
		// $groups[$groupID] = $tmpGroup;
		// var_dump($groups);
		++$groupID;
	}

	// print out the groups in a nice format
	foreach ($groups as $key => $val) {
		$output = "\nGroup ";
		$output .= ($key + 1) . ": " . implode(' | ', $val) . "\n";
		// var_dump($val);
		// echo $output;
	}
	return $groups;
}

/**
 * getRandomElements
 *
 * @param array $inputArray
 * @param integer $numMembers
 * @return array array of random keys equal to inputArray length or #numMembers whichever is less
 */
function getRandomElements(array $inputArray, int $numMembers)
{
	// get rand values
	if (empty($inputArray)) {
		throw new Exception("empty array passed!!");
	}

	// array_rand will cause an infinite loop of warnings if array length < requested number of values
	if($numMembers < count($inputArray)){
		// just send back the remaining keys
		return array_keys($inputArray);
	}

	return array_rand($inputArray, $numMembers);
}
