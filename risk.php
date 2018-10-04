<?php

$count = 10;
$def_lost = 0;
$att_lost = 0;

for ($i = 0; $i < $count; $i++):

    $a = mt_rand(1,6);
    $b = mt_rand(1,6);
    $c = mt_rand(1,6);
    $def_d1 = mt_rand(1,6);
    $def_d2 = mt_rand(1,6);

    if ($a > $def_d1 || $b > $def_d1 || $c > $def_d1)
        $def_lost++;
    else
        $att_lost++;

    if ($a > $def_d2 || $b > $def_d2 || $c > $def_d2)
        $def_lost++;
    else
        $att_lost++;

endfor;

echo "Rundor: ".$count ."\n";
echo "Förluster som försvarare: ".$def_lost ."\n";
echo "Förluster som anfallare: ".$att_lost ."\n";
