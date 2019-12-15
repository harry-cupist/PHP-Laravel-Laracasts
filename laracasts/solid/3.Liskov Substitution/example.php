<?php

// class A {
//     public function fire() {}
// }
//
// class B extends A {
//     public function fire() {}
// }
//
// function doSomething(A $obj)
// {
//     // do something with it
// }

class VideoPlayer {
    public function play($file)
    {
        // play the video
    }
}

class AviVideoPlayer extends VideoPlayer {
    public function play($file)
    {
        if(pathinfo($file, PATHINFO_EXTENSION) !== 'avi')
        {
            throw new Exception; // violate LSP
        }
    }
}