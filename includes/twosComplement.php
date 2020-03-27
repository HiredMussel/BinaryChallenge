<?php

require_once 'binaryAdd.php';

/**
 * Gets the two's complement additive inverse of the provided binary number
 *
 * @param array $input Binary number whose inverse should be calculated
 *
 * @return array The two's complement of the number passed in
 */
function twosComplement (array $input) : array {
    $one = [0 => 1];
    $output = [];
    for ($i = 0; $i < count($input); $i++) {
        $output[$i] = !($input[$i]);
        $output[$i] = (int) $output[$i];
    }
    $output = binaryAdd($one, $output);
    return $output;
}