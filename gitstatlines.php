<?php
$str = "4+4+2+7+5+7+11+6+36+4+21+6+71+4+24+10+9+5+18+4+2+4+16+6+3+12+7+19+42+176+20+3+13+63+3+50+21+9+9+3+15+12+10+21+89+19+12+8+3+19+4+4+4+4+4+29+20+10+4+2+3+6+31+3+10+72+31+27+56+6+17+12+4+8+8+5+34+26+7+123+14+9+25+6+21+25+43+2+15+8+5+9+9+36+36+112+4+16+5+39+11+3+3+3+15+21+3+14+3+7+47+6+18+88+16+36+27+3+34+35+35+33+8+8+16+42+4+8+28+23+4+41+7+10+4+35+21+53+58+86+65+28+19+57+13+55+13+4+29+118+16+9+4+43+109+32+29+21+27+29+27+28+20+114+46+44+72+46+23+157+106+9+2+85+70+28+25+66+5+35+6+28+3+8+4+30+7+55+9+20+21+5+11+3+6+8+57+8+26+11+3+8+15+19+34+40+23+19+16+2+5+17+9+18+10+26+5+36+37+44+16+10+8+23+4+9+7+18+9+20+4+66+2+5+6+7+21+3+31+4+9+35+3+4+16+4+3+29+6+5+3+44+10+14+15+44+9+3+4+14+14+6+8+3+4+80+5+12+68+29+35+2+8+6+8+29+2+30+41+5+53+26+6+15+18+9+6+7+33+36+32+40+47+41+107+11+19+22+28+45+8+4+8+3+19+6+4+16+19+15+15+29+13+10+16+82+26+19+5+3+5+6+6+21+100+31+5+21+12+12+11+5+5+30+38+16+11+6+7+18+82+10+11+10+4+70+67+94+65+82+86+65+76+65+65+28+28+14+25+8+4+10+38+22+5+4+3+9+4+11+4+27+20+20+17+76+6+5+10+5+6+14+5+21+3+34+41+30+9+24+8+72+74+67+4+4+105+89+23+7+21+14+2+24+15+19+13+8+19+47+12+7+45+7+6+32+20+86+86+10+9+2+4+86+86+86+9+19+3+26+5+12+18+20+4+8+33+6+10+38+38+34+6+18+12+6+6+36+4+90+67+86+111+20+7+4+17+36+11+12+5+22+173+8+268+93+17+5+5+5+6+3+3+3+111+8+18+8+7+5+5+16+16+16+16+16+16+16+16+16+16+16+16+16+16+19+16+16+6+4+10+4+6+4+6+8+10+10+10+10+10+10+10+10+10+10+10+10+10+11+10+10+5+5+7+5+5+5+5+5+6+5+6+5+5+6+6+5+7+6+6+5+32+35+35+35+40+41+38+34+37+37+39+33+37+42+34+35+36+38+35+34+33+36+207";
$ns = explode('+', $str);
$lines = 0;

foreach ($ns as $n)
{
    echo $n . "\n";
    $lines += $n;
}

echo "\nlines of code since 9th may (50 work days): " . $lines . "\n";
echo $lines/50 . " lines per day\n";

$charactersPerLine = [20,40,60,80,100];
foreach ($charactersPerLine as $c)
{
    $characters = $lines * $c;
    echo "pages (3000 characters per page) of code: " . floor($characters/3000) . " (for a density of ".$c." characters per line)\n";
}

echo "-> going with smallest density ~100 pages full of code in 50 days gives 2 pages full of code every day!\n";
