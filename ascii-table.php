<?php

function ascii_table($data) {

    $data = (array)$data;

    $keys = array_keys(end($data));

    # calculate optimal width
    $wid = array_map('strlen', $keys);
    foreach($data as $row) {
        foreach(array_values($row) as $k => $v)
            $wid[$k] = max($wid[$k], strlen($v));
    }

    # build format and separator strings
    foreach($wid as $k => $v) {
        $fmt[$k] = "%-{$v}s";
        $sep[$k] = str_repeat('-', $v);
    }
    $fmt = '| ' . implode(' | ', $fmt) . ' |';
    $sep = '+-' . implode('-+-', $sep) . '-+';

    # create header
    $buf = array($sep, vsprintf($fmt, $keys), $sep);

    # print data
    foreach($data as $row) {
        $buf[] = vsprintf($fmt, $row);
        $buf[] = $sep;
    }

    # finis
    return implode("\n", $buf);
}


# example

$data = array(
    array('id' => 1, 'field1' => 'foo', 'field2' => 'bar'),
    array('id' => 2, 'field1' => 'lorem', 'field2' => 'ipsum'),
    array('id' => 3, 'field1' => 'anton', 'field2' => 'helloooooooooooo'),
    array('id' => 4, 'field1' => 'asdsadasdasdas', 'field2' => 'asd'),
);
echo ascii_table($data);
