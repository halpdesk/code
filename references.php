<?php

/*
$elem1 = 1;
$elem2 = 2;
foreach (Array(&$elem1, &$elem2) as &$val)
{
    $val++;
}
var_dump($elem1, $elem2);
*/

$elem1 = 1;
$elem2 = 2;
$arr = Array($elem1, $elem2);
foreach ($arr as &$val)
{
    $val++;
}
var_dump($arr);

foreach ($arr as $key => $val)
{
    $arr[$key]++;
}
var_dump($arr);
