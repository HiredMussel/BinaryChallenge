<?php

/**
 * Function to add two bits. A carry bit may be passed by reference, in which case the function will save the carry state
 * to the variable provided
 *
 * @param $bit1 Int the value of the first bit
 * @param $bit2 Int the value of the second bit
 * @param $carry Int the variable in which to store the carry bit
 *
 * @return Int the bitwise xor of the integer, possibly having saved the carry bit to $carry
 */
function bitwiseAdd(Int $bit1, Int $bit2, Int &$carry=NULL) : Int {
    $return = ($bit1 xor $bit2);
    $carry = ($bit1 && $bit2);
    $return = (int) $return;
    $carry = (int) $carry;

    return $return;
}