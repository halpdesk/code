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


$matrix = one_func([50,50]);
show($matrix);
