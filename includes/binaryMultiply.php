<?php

require_once 'bitShifts.php';
require_once 'binaryAdd.php';

/** Function to multiply together two binary numbers
 *
 * @param $input1 array the first binary number being multiplied
 * @param $input2 array the second binary number being multiplied
 *
 * @return array the product of $input1 and $input2
 */
function binaryProduct(array $input1, array $input2) : array {
    $shiftMatrix = [];
    $sum = [0 => 0];
    for ($i = 0; $i < count($input2); $i++) {
        if ($input2[$i] == 1) {
            $shiftMatrix[$i] = leftShift($input1, $i);
        } else {
            $shiftMatrix[$i] = [0 => 0];
        }
        $sum = binaryAdd($sum, $shiftMatrix[$i]);
    }
    return $sum;
}