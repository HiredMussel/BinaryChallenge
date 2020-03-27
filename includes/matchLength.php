<?php

/** Function to match lengths so that integers of different binary lengths may be added together
 *
 * @param $input1 array the first binary number
 * @param $input2 array the second binary number
 *
 * The function does not output, instead permanently changing the length of the shorter argument passed.
 */
function matchLength (&$input1, &$input2) {
    $length = max(count($input1), count($input2));
    for ($i = count($input1); $i < $length; $i++) {
        $input1[$i] = 0;
    }
    for ($i = count($input2); $i < $length; $i++) {
        $input2[$i] = 0;
    }
}