<?php

Class A {
	public function __constructor() {
		echo "A constructed \n";
	}
}

$obj = new A();
if ($obj instanceof A) {
   echo 'obj is instance of A' . "\n";
}

$obj = null;
if ($obj instanceof A) {
   echo 'obj is instance of A' . "\n";
}


