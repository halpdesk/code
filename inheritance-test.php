<?php

interface ITest {
    public function testA();
    public function testB();
}

abstract class ATest {
    public function testA() {
        echo "testA";
    }
}

class Test extends ATest implements ITest {
    public function testB() {
        echo "testB";
    }
}


$test = new Test();
$test->testA();
$test->testB();
