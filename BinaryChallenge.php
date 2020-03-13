<?php

/**
 * @var $railingLength array binary version of the length of a fence unit in units of 1cm
 */
$railingLength = [
    0 => 0,
    1 => 1,
    2 => 1,
    3 => 0,
    4 => 1,
    5 => 0,
    6 => 0,
    7 => 1,
    8 => 0,
];

/**
 * @var $postLength array length of a post in binary using units of 1cm
 */
$postLength = [
    0 => 0,
    1 => 1,
    2 => 0,
    3 => 1,
    4 => 0,
];

/**
 * Prints a binary number reading from left to right in descending unit size
 *
 * @param $input array the array representing the binary number to be printed
 *
 * @return null
 */
function printBinary (array $input) {
    for ($i = count($input) - 1; $i >= 0; $i--) {
        echo $input[$i];
    }
    echo "<br>";
}

/**
 * Converts an integer into a binary number. Though a slight abuse of data types, the values of bits are treated as
 * integers. As such, they must be either 1 or zero. If passed a different integer value as part of an array, that
 * value will be treated as a 1.
 *
 * @param $input Int
 * @return array The binary representation of the base-10 input
 */
function intToBinary (Int $input) : array {

    $output = [];

    $bitNo = ceil(log($input+1, 2));

    if ($output > 0) {
        $output[$bitNo] = 0;
    } else {
        $output[$bitNo] = 1;
    }
    for ($i = $bitNo - 1; $i >= 0; $i--) {
        $output[$i] = (int)floor($input / (pow(2, $i)));
        $input -= $output[$i] * pow(2, $i);
    }

    return $output;
}

/**
 * Converts a binary number into a decimal number
 *
 * @param $input array binary number to be converted
 * @return Int Decimal representation of the binary number
 */
function binToDecimal (array $input) : Int {
    $output = 0;
    for ($i = 0; $i < count($input); $i++) {
        $output += $input[$i]*(pow(2,$i));
    }
    return $output;
}

/**
 * Function to match the length of two binary numbers. Pads the shorter of the numbers with zeroes in order to match
 * the length of the numbers for processing by binaryAdd.
 *
 * @param $input1 array the first binary number
 * @param $input2 array the second binary number
 *
 * @return null function acts directly on the arrays rather than returning anything
 */
function matchLength (array &$input1, array &$input2) {
    if (count($input1) < count($input2)) {
        $longerArray = $input2;
        $shorterArray = $input1;
    } else {
        $longerArray = $input1;
        $shorterArray = $input2;
    }
    for ($i = count($shorterArray); $i < count($longerArray); $i++) {
        $shorterArray[$i] = 0;
    }
    if (count($input1) < count($input2)) {
        $input1 = $shorterArray;
    } else {
        $input2 = $shorterArray;
    }
}

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

/**
 * Adds together two binary numbers using ripple carry (look-ahead carry won't save time when emulating in serial)
 *
 * @param $input1 array the first of two binary numbers to add together
 * @param $input2 array the second of two binary numbers to add together
 * @param $prependCarry bool if set to false, this will ignore the final carry bit. This is necessary when calculating
 * two's complement (as the two's complement of zero needs to be zero) and for the subtract function.
 *
 * @return array the sum of the two inputs as a binary number
 */
function binaryAdd (array $input1, array $input2, bool $prependCarry = true) : array {
    matchLength($input1, $input2);
    $output = [];
    // Does the first bit propagate a carry?
    $carryOne = 0;
    // Does the second bit propagate a carry?
    $carryTwo = 0;
    // Has a carry been propagated?
    $carryFinal = 0;
    for ($i = 0; $i < max(count($input1), count($input2)); $i++) {
        $workBit = bitwiseAdd($input1[$i], $carryFinal, $carryOne);
        $output[$i] = bitwiseAdd($workBit, $input2[$i],$carryTwo);
        $carryFinal = ($carryOne || $carryTwo);
        $carryFinal = (int) $carryFinal;
    }
    if ($carryFinal == 1 && $prependCarry == true) {
        $output[] = 1;
    }
    return $output;
}

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

/**
 * Function for subtraction on binary numbers. Will subtract the second one provided from the first
 *
 * @param $input1 array the binary number which will have $input2 subtracted from it
 * @param $input2 array the binary number which will be subtracted from $input1
 *
 * @return array the result of subtracting $input2 from $input1
 */
function binarySubtract($input1, $input2) : array {
    matchLength($input1, $input2);
    $input2 = twosComplement($input2);
    return binaryAdd($input1, $input2, false);
}

/**
 * Function to determing whether a binary number is strictly greater than another binary number
 *
 * @param $input1 array the first number to be compared
 * @param $input2 array the second number to be compared
 *
 * @return bool is $input 1 greater than $input2?
 */
function binGreaterThan(array $input1, array $input2) : bool {
    $tester = binarySubtract($input2, $input1);
    if ($tester[count($tester) - 1]) {
        return true;
    } else {
        return false;
    }
}

/** Various other functions playing off binGreaterThan above. All return boolean values.
 *  binLessThan : is $input1 strictly less than $input2
 *  binLEQ : is $input1 less than or equal to $input2
 *  binGEQ : is $input1 greater than or equal to $input2
 */
function binLessThan(array $input1, array $input2) : bool {
    return binGreaterThan($input2, $input1);
}
function binLEQ(array $input1, array $input2) : bool {
    return !binGreaterThan($input1, $input2);
}
function binGEQ(array $input1, array $input2) : bool {
    return !binLessThan($input1, $input2);
}

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

/**
 * Function to perform binary division. This uses a binary long division algorithm
 *
 * @param $input1 array the dividend (number being divided)
 * @param $input2 array the divisor (number to divide by)
 * @param $remainder array (optional) the variable in which to store the remainder after division
 *
 * @return array the result of dividing $input1 by $input2
 */
function binaryDivide(array $input1, array $input2, &$remainder = NULL) : array {
    $dividendLength = count($input1);
    $workingArray = [];
    $output = [0 => 0];
    for ($i = 0; $i < $dividendLength; $i++) {
        $workingArray[0] = $input1[$dividendLength - 1 - $i];
        if (binGEQ($workingArray, $input2)) {
            $output[$dividendLength - 1 - $i] = 1;
            $workingArray = binarySubtract($workingArray, $input2);
        } else {
            $output[$dividendLength - 1 - $i] = 0;
        }
        $workingArray = leftShift($workingArray, 1);
    }
    $remainder = rightShift($workingArray, 1);
    return $output;
}


/**
 * Function to calculate the length of the fence given that a railing is 1.5m long and a fence post is 0.1m long.
 *
 * @param Int $noOfPosts the number of posts in the fence
 * @param Int $noOfRailings the number of railings in the fence
 *
 * @return Float the total length of the fence in metres
 */
function postsAndRailingsToLength(Int $noOfPosts, Int $noOfRailings) : Float {
    global $railingLength;
    global $postLength;
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

echo "<pre>";
echo 'Total length of Fence: ' . postsAndRailingsToLength(11, 10) . ' metres';
echo "</pre>";