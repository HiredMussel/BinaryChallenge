<?php

require_once 'bitShifts.php';
require_once 'binarySubtract.php';
require_once 'binaryOrderRelations.php';

/**
 * Function to perform binary division. This uses a binary long division algorithm
 *
 * @param $input1 array the dividend (number being divided)
 * @param $input2 array the divisor (number to divide by)
 * @param $remainder array (optional) the variable in which to store the remainder after division
 *
 * @return array the result of dividing $input1 by $input2
 */
function binaryDivide(array $input1, array $input2, &$remainder = NULL) : array {
    $dividendLength = count($input1);
    $workingArray = [];
    $output = [0 => 0];
    for ($i = 0; $i < $dividendLength; $i++) {
        $workingArray[0] = $input1[$dividendLength - 1 - $i];
        if (binGEQ($workingArray, $input2)) {
            $output[$dividendLength - 1 - $i] = 1;
            $workingArray = binarySubtract($workingArray, $input2);
        } else {
            $output[$dividendLength - 1 - $i] = 0;
        }
        $workingArray = leftShift($workingArray, 1);
    }
    $remainder = rightShift($workingArray, 1);
    return $output;
}