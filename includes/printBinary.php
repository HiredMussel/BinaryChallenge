<?php

/**
* Prints a binary number reading from left to right in descending unit size
*
* @param $input array the array representing the binary number to be printed
*
* @return String the binary number written from left to right in descending order of place value
*/
function printBinary (array $input) : String {
$output = '';
for ($i = count($input) - 1; $i >= 0; $i--) {
$output .= $input[$i];
}
return $output;
}