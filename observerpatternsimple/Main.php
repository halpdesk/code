<?php

include "Subject.php";
include "Observer.php";

include "ConcreteObserverA.php";
include "ConcreteObserverB.php";
include "ConcreteSubject.php";


$subject = new ConcreteSubject();

$observerA = new ConcreteObserverA();
$observerB = new ConcreteObserverB();


$subject->registerObserver($observerA, "test A");
$subject->registerObserver($observerB, "test B");
$subject->printObservers();

$subject->setData("hello");

$subject->setData("hello2");
