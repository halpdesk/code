<?php

    $factor = 28433;
    $base   = 2;
    $power  = 7830457;
    $reduce_power_by = 10;
    $term   = 1;

    while ($power > 0)
    {
        if ($power < $reduce_power_by)
        {
            $reduce_power_by = $power;
        }
        $power      = $power - $reduce_power_by;
        $factor     = $factor * pow($base, $reduce_power_by);

        $factor     = (int)substr((string)$factor, -11, 11);
    }

    $factor = $factor+$term;

    echo '10 last didigts of factor is '.substr((string)$factor, -10, 10)."\n";
