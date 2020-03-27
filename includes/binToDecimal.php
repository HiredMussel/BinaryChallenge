<?php

/**
 * Converts a binary number into a decimal number
 *
 * @param $input array binary number to be converted
 * @return Float Decimal representation of the binary number
 */
function binToDecimal (array $input) : Float {
    $output = 0;
    for ($i = 0; $i < count($input) - 1; $i++) {
        $output += $input[$i]*(pow(2,$i));
    }
    if ($input[count($input) - 1] == 1) {
        $output = -$output;
    }
    return $output;
}