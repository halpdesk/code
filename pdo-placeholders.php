<?php

    /*
     *  FIELD STRING
     */
    $columns = array();
    foreach (range(1,5) as $i) {
        $columns[] = [
            'col1' => 'value1',
            'col2' => 'value2',
            'col3' => 'value3',
            'col4' => 'value4',
        ];
    }
    $columnKeys = array_keys($columns[0]);
    $columnString = implode(',', $columnKeys);


    /*
     *  VALUE STRING
     */
    $values = array();
    $updateValues = array();
    foreach(range(0,count($columns)-1) as $i) {
        $values[]       = '(?,?,?,?)';
        $updateValues   = array_merge($updateValues, array_values($columns[$i]));
    }
    $valueString = implode(',', $values);

    $query = 'INSERT INTO table ('.$columnString.') VALUES ' . $valueString;

    echo $query . "\n";
    print_r($updateValues);
