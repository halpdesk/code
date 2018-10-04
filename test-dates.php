<?php

    $format             = "Y-m-d H:i:s";
    $startDate          = date('Y-m-d 00:00:00', strtotime("+10 days"));
    $endDate            = date('Y-m-d 00:00:00', strtotime("+60 days"));
    $input              = date('Y-m-d 00:00:00', strtotime("2016-01-29"));

    echo "startDate:\t". $startDate . "\n";
    echo "endDate: \t". $endDate . "\n";

    $startDatetime  = DateTime::createFromFormat($format, $startDate);
    $endDatetime    = DateTime::createFromFormat($format, $endDate);
    $inputDatetime  = DateTime::createFromFormat($format, $input);

    var_dump($startDatetime);
    var_dump($endDatetime);
    var_dump($inputDatetime);

    if(($inputDatetime->getTimestamp() >= $startDatetime->getTimestamp()) && ($inputDatetime->getTimestamp() <= $endDatetime->getTimestamp()))
    {
        echo $input . " is beteween " . $startDate . " and " . $endDate . "\n";

    }
