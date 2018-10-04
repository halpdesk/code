<?php


// helper function
function show($matrix, $a = "X", $b = ".")
{
    foreach($matrix as $vector)
    {
        foreach($vector as $bit)
        {
            echo ($bit == 1 ? $a : $b) . " ";
        }
        echo "\n";
    }
}


// using one method to build and inject objet in each itteration
function build($size, Array $matrix)
{
    for($i=0;$i<$size;$i++)
    {
        $vector[] = (count($matrix) > 0) ? ($matrix[count($matrix)-1][$i] == 0) ? 0 : rand(0,1) : rand(0,1);
    }
    array_push($matrix, $vector);

    if (count($matrix) < $size)
        return build($size, $matrix);
    else
        return array_reverse($matrix);
}

$matrix = build(5, []);
echo "using one method to build and inject objet in each itteration: \n";
show($matrix);
echo "--------------------\n\n";


// Using two methods
// True recurive function, not injecting the object to build itteratively

function vector($length, $bit = 1)
{
    $bit = ($bit == 0) ? 0 : rand(0,1);
    $length--;
    if ($length < 0)
        return [];
    else
        return array_merge(vector($length, $bit), [$bit]);
}
function matrix($size)
{
    $vector = vector($size[1]);
    $size[0]--;
    if ($size[0] < 0)
        return [];
    else
        return array_merge(matrix($size), [$vector]);
}
$matrix = matrix([5,5]);
echo "using two methods, true recursiveness: \n";
show($matrix);
echo "--------------------\n\n";


 // Using one function
 // True recurive function, not injecting the object to build itteratively
function one_func($size)
{
    $f = function($length, $bit = 1) use (&$f) {
        $bit = ($bit == 0) ? 0 : rand(0,1);
        $length--;
        if ($length < 0)
            return [];
        else
            return array_merge($f($length, $bit), [$bit]);
    };
    $vector = $f($size[1]);
    $size[0]--;
    if ($size[0] < 0)
        return [];
    else
        return array_merge(one_func($size), [$vector]);
}

$matrix = one_func([10,10]);
echo "using one method, true recursiveness: \n";
show($matrix);
echo "--------------------\n\n";


// Other recursive tests
function suma($num) {
    if ($num == 0)
        return 0;
    else
        return $num + suma($num-1);
}

function suma2($num, $return) {
    if ($num == 0)
        return $return;
    else
        return $num + suma2($num-1, $return);
}
$num = 100;
echo suma($num) . "\n";
echo suma2($num, 0);
