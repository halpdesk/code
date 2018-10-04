<?php

abstract class Subject
{
    private $observers;
    private $data;
    
    public function registerObserver(Observer $observer, $name) 
    {
        $this->observers[$name] = $observer;
    }

    public function unregisterObserver(Observer $observer, $name) 
    {
        $key = $name;
        array_splice($this->observers, $key, 1);
    }

    public function printObservers()
    {
        echo "\n-----------------------------------------------------\n";
        echo "Observers registered with " . __CLASS__ .":\n";
        print_r(array_keys($this->observers));
        echo "-----------------------------------------------------\n\n";
    }

    public function notifyObservers() 
    {
        foreach ($this->observers as $observer) {
            $observer->notify($this->data);
        }
    }

    public function setData($data) 
    {
        $this->data = $data;
        sleep(1);
        $this->notifyObservers();
    }
}
