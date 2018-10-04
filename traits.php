<?php
class ParentE {
    public function __construct() {echo "constructed ParentE \n";}
    public function Ea() { echo "used extEa \n"; }
    public function Eb() { echo "used extEb \n"; }
    public function methodA() { echo "used extMethodA \n"; }
}
trait TraitC {
    protected function traitCa() { echo "used traitCa \n"; }
    protected function traitCb() { echo "used traitCb \n"; }
}
trait TraitD {
    protected function traitDa() { echo "used traitDa \n"; }
    protected function traitDb() { echo "used traitDa \n"; }
    protected function methodA() { echo "used traitMethodA \n"; }
}
class A extends ParentE {
    use TraitC;
    use TraitD;
    public function __construct() {echo "constructed A \n";}
    public function a() {echo "used Aa \n";}
}
class B extends ParentE {
    use TraitC;
    public function __construct() {echo "constructed B \n";}
    public function a() {echo "used Ba \n";}
}
$A = new A(); $B = new B();
echo "A--------\n";
$A->a();
$A->traitCa();
$A->traitCb();
$A->traitDa();
$A->traitDb();
$A->methodA();
$A->Ea();
$A->Eb();

echo "B--------\n";
$B->a();
$B->traitCa();
$B->traitCb();
$B->Ea();
$B->Eb();

echo "inst-------\n";

try
{
    $ParentE = new ParentE();
    $ParentE->Ea();
    $ParentE->Eb();
    $C = new C();
    $C->traitCa();
    $C->traitCb();
}
catch (Exception $e)
{
    echo "Nope: [" . $e->getCode() . "]: ". $e->getMessage();
}
