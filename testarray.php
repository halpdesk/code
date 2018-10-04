<?php

class Foo {
    public $bar = 'tor';
}

$kar = new Foo();
$kar2 = new Foo();
$params = [
    $kar,
    $kar2,
    new Foo()
];
foreach($params as $fooObject)
{
    $fooObject->bur = "baz";
}
var_dump($params);
