<?php

$func = 'foo';
function foo(&$bar) {
	$bar = function($a, $b, $cb = null) {
		$cb($a + $b);
	};
	return 'bar';
}
$buz = function($baz) {
	call_user_func(${$baz($bar)}, 1, 2, function($sum) {
		echo $sum;
	});
};
$buz($func);
