<?php

/**
 * Converts an integer into a binary number. Though a slight abuse of data types, the values of bits are treated as
 * integers. As such, they must be either 1 or zero. If passed a different integer value as part of an array, that
 * value will be treated as a 1.
 * By default, this function converts integers into 64-bit signed binary integers. Note that the rest of the functions
 * on this page will implement no protection against integer overflow, so the following limits are in place:
 *
 * @param $input Int
 * @param $bitNo Int the number of bits to represent the integer as
 * @return array The binary representation of the base-10 input
 */
function intToBinary (Int $input, Int $bitNo = 64) : array {
    $output = [];

    for ($i = 0; $i < $bitNo; $i++) {
        $output[$i] = 0;
    }

    if ($input < 0) {
        $output[$bitNo - 1] = 1;
    }
    for ($i = $bitNo - 2; $i >= 0; $i--) {
        $output[$i] = (int)floor($input / (pow(2, $i)));
        $input -= $output[$i] * pow(2, $i);
    }

    return $output;
}