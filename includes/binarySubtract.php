<?php

require_once 'matchLength.php';
require_once 'twosComplement.php';
require_once 'binaryAdd.php';

/**
 * Function for subtraction on binary numbers. Will subtract the second one provided from the first
 *
 * @param $input1 array the binary number which will have $input2 subtracted from it
 * @param $input2 array the binary number which will be subtracted from $input1
 *
 * @return array the result of subtracting $input2 from $input1
 */
function binarySubtract($input1, $input2) : array {
    matchLength($input1, $input2);
    $input2 = twosComplement($input2);
    return binaryAdd($input1, $input2);
}