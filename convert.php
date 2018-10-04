<?php

//mb_internal_encoding("ISO-8859-1");
$encoding = mb_internal_encoding();
echo "internal encoding: " . $encoding . PHP_EOL;

$input = [];
$input[] = chr(197);
$input[] = "\xC5";
$input[] = utf8_encode(chr(197));
//$input[] = utf8_decode(chr(197));

foreach ($input as $i) {
    $encoding = mb_detect_encoding($i);
    $ord = ord($i);
    $unpacked = unpack('H*', $i)[1];
    $bin = chunk_split(str_pad(base_convert($unpacked, 16, 2), 16, 0, STR_PAD_LEFT), 8, " ");

    print_r(Array(
        "\$i" => $i,
        "ord" => $ord,
        "encoding" => $encoding,
        "unpack" => $unpacked,
        "bin" => $bin
    ));
}
echo PHP_EOL;
