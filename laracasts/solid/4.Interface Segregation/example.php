<?php

interface ManagableInterface {
    public function beManaged();
}

interface WorkerableInterface {
    public function work();

}

interface SleepableInterface {
    public function sleep();
}

class HumanWorker implements WorkerableInterface, SleepableInterface, ManagableInterface {
    public function work()
    {

    }

    public function sleep()
    {
        return 'human sleeping';
    }

    public function beManaged()
    {
        $this->work();
        $this->sleep();

    }
}

class AndroidWorker implements WorkerableInterface, ManagableInterface {
    public function work()
    {

    }

    public function beManaged()
    {
        $this->work();
    }

}



class Captain {
    public function manage(ManagableInterface $worker)
    {
        $worker->beManaged();


    }
}