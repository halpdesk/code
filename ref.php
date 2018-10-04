<?php

/* Using references */
$arr = [4, 2, 1, 7, 4, 6];
function sortAndReturnSum(&$arr)
{
    sort($arr);
    return array_sum($arr);
}

$sum = sortAndReturnSum($arr);
print_r($arr);
echo "sum: " . $sum . "\n";





/* Using globals */
global $arr2;
$arr2 = [4, 2, 1, 7, 4, 6];
function sortAndReturnSumGlob($arr2)
{
    global $arr2;
    sort($arr2);
    return array_sum($arr2);
}
$sum2 = sortAndReturnSumGlob($arr);
print_r($arr2);
echo "sum: " . $sum2 . "\n";


/* Using namspaces */
// namespace test;
// \test\$arr3 = [4, 2, 1, 7, 4, 6];
// var_dump(\test\$arr3);
