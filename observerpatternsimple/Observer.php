<?php

abstract class Observer
{   
    protected $data = [];
    
    public function notify($data)
    {
        echo "\n-----------------------------------------------------\n";
        echo __CLASS__ . " has been updated with: \n";
        echo $this->data . " => " . $data . "\n";
        echo "-----------------------------------------------------\n\n";
        $this->data = $data;
    }
}
