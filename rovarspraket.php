<?php


    function arrayBitsToCase($array, $case = "upper")
    {
        $result = Array();
        foreach($array as $bit)
        {
            switch($case) {
                case "lower":
                    $result[] = strtolower($bit);
                    break;
                case "upper":
                    $result[] = strtoupper($bit);
                    break;
                default:
                    $result = null;
                    break;
            }
        }
        return $result;
    }

    function rovar($string)
    {
        $consonants          = Array("q","w","r","t","p", "s","d","f","g","h","j","k","l","z","x","c","v","b","n","m"," ");
        $consonants_replace  = Array("qoq","wow","ror","tot","pop", "sos","dod","fof","gog","hoh","joj","kok","lol","zoz","xox","coc","vov","bob","non","mom"," ");

        $chars = str_split($string, 1);
        $rovar = "";
        foreach($chars AS $char)
        {
            if (ord($char) > 96)
            {
                if (in_array($char, arrayBitsToCase($consonants, "lower")))
                    $char = strtolower(str_replace(arrayBitsToCase($consonants, "lower"), arrayBitsToCase($consonants_replace, "lower"), $char));
            }
            else
            {
                if (in_array($char, arrayBitsToCase($consonants, "upper")))
                    $char = strtoupper(str_replace(arrayBitsToCase($consonants, "upper"), arrayBitsToCase($consonants_replace, "upper"), $char));
            }
            $rovar .= $char;
        }
        return $rovar;
    }

    $test = "Jag går oCh Fiskar";
    echo rovar($test) . "\n";
