<?php
class A {
    public $foo = 1;
}

$a = new A;
$b = $a;     // $a and $b are copies of the same identifier
             // ($a) = ($b) = <id>
$b->foo = 2;
echo $a->foo."\n";



$c = new A;
$d = $c;     // $a and $b are copies of the same identifier
             // ($a) = ($b) = <id>
$c->foo = 2;
echo $d->foo."\n";
