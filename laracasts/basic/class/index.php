<?php


class Task {

    // property
    public $description;
    public $completed = false;

    // method
    public function __construct($description)

    {
        // Automatically triggered on instantiation

        // current instance(object)에
        // description(property)에 $description을 할당
        $this->description = $description;
    }

    public function complete()

    {
        $this->completed = true;

    }

    public function isComplete()

    {
        return $this->completed;
    }
}


$task = new Task('Go to the store'); // a new task object
$task-> complete(); // complete the task
var_dump($task->isComplete());
//var_dump($task);

$tasks = [
    new Task('Go to the  store'),
    new Task('Finish my screencast'),
    new Task('Clean my room')
];

$tasks[0]->complete();

var_dump($tasks);

require 'index.view.php';







