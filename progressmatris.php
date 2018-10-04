<?php

$actions    = [
    'skapa' => 'POST',
    'ta bort' => 'DELETE',
    'uppdatera' => 'PUT',
    'visa' => 'GET',
    'lista' => 'GET'
];
$userroles  = [
    'Resenär' => 'consumer',
    'Kund-administratör' => 'ca',
    'Administratör' => 'coa'
];
$objects    = [
    'Orderrad'  => 'orderrows',
    'Order'  => 'orders',
    'Kundvagnsrad'  => 'cartrows',
    'Kundvagn'  => 'carts',
    'Produkt'  => 'products',
    'Produktmall'  => 'producttypes',
    'Produktkategori'  => 'productcategories',
    'Produktkatalog'  => 'catalogues',
    /*
    'Resenär'   => 'consumers',
    'Kund'      => 'customers',
    'THuvudman' => 'companys',
    */
];

foreach ($objects as $object => $objectName) {
    foreach ($userroles as $userrole => $userroleName) {
        echo 'BE:'.$userrole. ' ska kunna hantera ' .$object . "\n";
        foreach ($actions as $action => $actionName) {
            $index = ($action == 'visa' || $action == 'uppdatera' || $action == 'ta bort') ? true : false;
            echo "\t" . '[] ' . $userrole . ' ska kunna ' . $action . ' ' . $object . ' ';
            echo '(';
            echo $actionName .' /'. $userroleName .'/'. $objectName . ($index ? '/<id>' : '');
            echo ')';
            echo  "\n";
        }
    }
}
