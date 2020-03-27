<?php

require_once 'matchLength.php';
require_once 'bitwiseAdd.php';

/**
* Adds together two binary numbers using ripple carry (look-ahead carry won't save time when emulating in serial)
*
* @param $input1 array the first of two binary numbers to add together
* @param $input2 array the second of two binary numbers to add together
*
* @return array the sum of the two inputs as a binary number
*/
function binaryAdd (array $input1, array $input2) : array {
matchLength($input1, $input2);
$output = [];
// Does the first bit propagate a carry?
$carryOne = 0;
// Does the second bit propagate a carry?
$carryTwo = 0;
// Has a carry been propagated?
$carryFinal = 0;
for ($i = 0; $i < max(count($input1), count($input2)); $i++) {
$workBit = bitwiseAdd($input1[$i], $carryFinal, $carryOne);
$output[$i] = bitwiseAdd($workBit, $input2[$i],$carryTwo);
$carryFinal = ($carryOne || $carryTwo);
$carryFinal = (int) $carryFinal;
}
return $output;
}