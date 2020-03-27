<?php

require_once 'constants.php';
require_once 'intToBinary.php';
require_once 'binaryMultiply.php';
require_once 'binaryAdd.php';
require_once 'binToDecimal.php';

/**
 * Function to calculate the length of the fence given that a railing is 1.5m long and a fence post is 0.1m long.
 *
 * @param Int $noOfPosts the number of posts in the fence
 * @param Int $noOfRailings the number of railings in the fence
 * @param Array $railingLength length of a railing represented as a binary number
 * @param Array $postLength length of a post represented as a binary number
 *
 * @return Float the total length of the fence in metres
 */
function postsAndRailingsToLength(Int $noOfPosts, Int $noOfRailings, Array $railingLength, Array $postLength) : Float {

// Convert the numbers of posts and railings to binary
$binPostNo = intToBinary($noOfPosts);
$binRailNo = intToBinary($noOfRailings);

$totalRailLength = binaryProduct($binRailNo, $railingLength);
$totalPostLength = binaryProduct($binPostNo, $postLength);

$binFenceLength = binaryAdd($totalRailLength, $totalPostLength);

$decFenceLength = binToDecimal($binFenceLength);

$decFenceLength /= 100;

return $decFenceLength;
}