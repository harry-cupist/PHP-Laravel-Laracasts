<?php

class Task {
    // public: outside of this class, anyone can access to the property
    public $description;

    public $completed = false;

    // method
    // __construct : immediately run when instantiating the class
    public function __construct($description)
    {
//        var_dump($description);
        $this->description = $description;
    }

    public function complete()
    {
        $this->completed = true;
    }
}

$task = new Task('Learn OOP');
$task->complete();
var_dump($task->description);
var_dump($task->completed);
