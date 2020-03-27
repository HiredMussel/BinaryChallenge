<?php

require_once 'binarySubtract.php';

/**
* Function to determine whether a binary number is strictly greater than another binary number
*
* @param $input1 array the first number to be compared
* @param $input2 array the second number to be compared
*
* @return bool is $input 1 greater than $input2?
*/
function binGreaterThan(array $input1, array $input2) : bool {
    $tester = binarySubtract($input2, $input1);
    if ($tester[count($tester) - 1]) {
        return true;
    } else {
        return false;
    }
}

/** Various other functions playing off binGreaterThan above. All return boolean values.
*  binLessThan : is $input1 strictly less than $input2
*  binLEQ : is $input1 less than or equal to $input2
*  binGEQ : is $input1 greater than or equal to $input2
*/
function binLessThan(array $input1, array $input2) : bool {
    return binGreaterThan($input2, $input1);
}
function binLEQ(array $input1, array $input2) : bool {
    return !binGreaterThan($input1, $input2);
}
function binGEQ(array $input1, array $input2) : bool {
    return !binLessThan($input1, $input2);
}