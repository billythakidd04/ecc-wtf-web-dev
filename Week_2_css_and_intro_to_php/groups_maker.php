<?php

function createTable()
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
        'Heary, Valerie',
        'Kased, Eiman',
        'Lainson, Christopher',
        'Ricci Jr., Vincent',
        'Schrecongost, Margaret',
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

    // print out the groups in a nice format
    foreach ($groups as $key => $val) {
        $output = "\nGroup ";
        $output .= ($key + 1) . ": " . implode(' | ', $val) . "\n";
        // var_dump($val);
        // echo $output;
    }
    return $groups;
}

function getRandomElements(array $inputArray, int $numMembers)
{
    // get rand values
    if (empty($inputArray)) throw new Exception("empty array passed!!");

    $indices = array_rand($inputArray, $numMembers);
    return $indices;
}
