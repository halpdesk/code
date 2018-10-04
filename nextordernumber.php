<?php


    $test = [
        [
            'numberFormat'      => '8*******',
            'savedOrderNumber'  => '80000001',
        ],
        [
            'numberFormat'      => 'BD****C',
            'savedOrderNumber'  => 'BD0022C',
        ],
        [
            'numberFormat'      => '****',
            'savedOrderNumber'  => '0123',
        ],
        [
            'numberFormat'      => '8****DD',
            'savedOrderNumber'  => '89905DD',
        ],
        [
            'numberFormat'      => '****1',
            'savedOrderNumber'  => '00011',
        ],
    ];

    function getNextOrderNumber($numberFormat, $savedOrderNumber) {

        $lastPos = 0;
        while (($lastPos = strpos($numberFormat, '*', $lastPos)) !== false) {
            $positions[] = $lastPos;
            $lastPos = $lastPos + strlen('*');
        }
        $orderNumberParts = str_split($savedOrderNumber);
        foreach ($positions as $position) {
            $orderNumber[] = $orderNumberParts[$position];
        }
        $orderNumber        = implode($orderNumber);
        $nextOrderNumber    = (int)$orderNumber + 1;

        $nextOrderNumberParts = str_split($nextOrderNumber);
        $numberFormatParts    = array_reverse(str_split($numberFormat));

        foreach ($numberFormatParts as $numberFormatPart) {
            if ($numberFormatPart == '*') {
                $number = array_pop($nextOrderNumberParts);
                if (!empty($number)) {
                    $nextOrderNumberFormatted[] = $number;
                } else {
                    $nextOrderNumberFormatted[] = 0;
                }
            } else {
                $nextOrderNumberFormatted[] = $numberFormatPart;
            }
        }
        $nextOrderNumberFormatted = implode(array_reverse($nextOrderNumberFormatted));

        // print_r([
        //     'orderNumber' => $orderNumber,
        //     'ne*tOrderNumber' => $ne*tOrderNumber,
        //     'ne*tOrderNumberParts' => $ne*tOrderNumberParts,
        //     'numberFormatParts' => $numberFormatParts,
        //     'ne*tOrderNumberFormatted' => $ne*tOrderNumberFormatted
        // ]);

        print_r([
            'aformat' => $numberFormat,
            'current' => $savedOrderNumber,
            'nextnum' => $nextOrderNumberFormatted,
        ]);

    }

    foreach ($test as $t) {
        getNextOrderNumber($t['numberFormat'], $t['savedOrderNumber']);
    }
