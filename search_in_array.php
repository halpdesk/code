<?php

    function array_stristr($array, $search)
    {
        if (stristr(implode(";", $array), $search))
        {
            return true;

        }
        else
        {
            return false;

        }

    }

    function array_find($array, $search, $getKey = false)
    {
        if (stristr(implode(";", $array), $search))
        {
            $value = strrev(stristr(strrev(stristr(implode(";", $array), $search, true)), ";", true)) . stristr(stristr(implode(";", $array), $search, false), ";", true);

            if ($getKey)
                $value = array_flip($array)[$value];

            return $value;

        }
        else
        {
            return false;

        }
    }

    $array  = ["Herro", "Hero", "Hello", "EHLO"];
    $search = "lo";

    if (array_stristr($array, $search))
        echo $search . " was found in " . implode(";", $array) . "\n";

    echo "key:" . array_find($array, $search) . "\n";
