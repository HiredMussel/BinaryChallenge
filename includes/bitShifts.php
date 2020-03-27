<?php

/**
 * Function to shift a binary number left by the given number of bits
 *
 * @param $input array a binary number on which the operation will be performed
 * @param $shiftBy Int the number of bits by which to shift left
 *
 * @return array the result of shifting the binary number $shiftBy bits to the left
 */
function leftShift(array $input, Int $shiftBy) : array {
    $output = [];
    for ($i = 0; $i < $shiftBy; $i++) {
        $output[$i] = 0;
    }
    for ($i = 0; $i < count($input); $i++) {
        $output[] = $input[$i];
    }
    return $output;
}

/**
 * Function to shift a binary number right by the given number of bits. Note that this may truncate the least significant
 * bits of $input
 *
 * @param $input array a binary number to shift right
 * @param $shiftBy Int the number of bits by which to shift right
 *
 * @return array the result of right-shifting $input right by $shiftBy bits
 */
function rightShift (array $input, Int $shiftBy) : array {
    $output = [];
    for ($i = $shiftBy; $i < count($input); $i++) {
        $output[] = $input[$i];
    }
    return $output;
}