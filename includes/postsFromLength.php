<?php

/**
 * Function to return the number of railings and posts you will need to build a fence of a certain length
 *
 * @param $length Float the desired length of fence to build
 * @param $railingLength Array the length of a railing in the fence represented as a binary number
 * @param $postLength Array the length of a post in the fence represented as a binary number
 *
 * @return array an array with two entries, the number of railings and the number of posts required
 */
function lengthToPostsAndRailings(Float $length, Array $railingLength, Array $postLength) : array {
$length *= 100;

$binLength = intToBinary($length);

$binLength = binarySubtract($binLength, $postLength);

$panelLength = binaryAdd($postLength, $railingLength);
$railNumber = binaryDivide($binLength, $panelLength, $remainder);

if (binGreaterThan($remainder, [0 => 0])) {
$railNumber = binaryAdd($railNumber, [0 => 1]);
}

$decRailNumber = binToDecimal($railNumber);

return [
'Railings' => $decRailNumber,
'Posts' => $decRailNumber + 1,
];
}