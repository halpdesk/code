<?php

trait Meta {

    public $a = 1;
    public static $b = 2;

    public function __construct($c) {
        echo "-- constructor called with param: c($c) -- \n";
    }

    private function inStaticContext() {
        $backtrace = debug_backtrace();
        return $backtrace[1]['type'] == '::';
    }

    public function classVars() {
        $vars = get_class_vars(__CLASS__);
        $accessedVars = [];
        foreach ($vars as $key => $var) {
            if (isset(static::${$key})) {
                $accessedVars[] = $key . "(".static::${$key}.")";
            }
            else if (isset($this) && isset($this->$key)) {
                $accessedVars[] = $key . "(".$this->$key.")";
            }
        }
        return implode(", ", $accessedVars);
    }

    public static function output($method) {
        $static = static::inStaticContext() ? "static context" : "object context";
        $classVars = static::classVars();
        $msg = "Called $method from $static and has access to member variables: $classVars";
        echo "-- " . $msg . "\n";
    }
}

class A {

    use Meta;

    public function pubFun() {
        static::output(__METHOD__);
    }
    public static function statPubFun() {
        static::output(__METHOD__);
    }
}

echo "## Calling by class resolution:\n";
call_user_func([A::class, 'pubFun']);
call_user_func([A::class, 'statPubFun']);

echo "\n";
echo "## Instantiating object:\n";
$a = new A(3);

echo "\n";
echo "## Calling with object:\n";
call_user_func([$a, 'pubFun']);
call_user_func([$a, 'statPubFun']);

echo "\n";
echo "## Calling with object referenced class (get_class):\n";
call_user_func([get_class($a), 'pubFun']);
call_user_func([get_class($a), 'statPubFun']);

// ------------

echo "\n";
echo "\n";
echo "## Instantiating object from anynymous class:\n";
$anon = new class(3) {

    use Meta;

    public function pubFun() {
        static::output(__METHOD__);
    }
    public static function statPubFun() {
        static::output(__METHOD__);
    }
};

echo "\n";
echo "## Calling with object created from anynonymous class:\n";
call_user_func([$anon, 'pubFun']);
call_user_func([$anon, 'statPubFun']);

echo "\n";
echo "## Calling with object referenced class (get_class) from anynonymous class:\n";
call_user_func([get_class($anon), 'pubFun']);
call_user_func([get_class($anon), 'statPubFun']);

// define("CLASS_REF", get_class($anon));
// call_user_func([CLASS_REF, 'pubFun']);
