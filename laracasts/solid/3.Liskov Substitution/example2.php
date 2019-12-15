<?php

interface LessonRepositoryInterface {
    /**
     * Fetch all records
     *
     * @return array
     */
    public function getAll();
}

class FileLessonRepository implements LessonRepositoryInterface {

    public function getAll()
    {
        // return through filesystem
        return [];
    }
}

class DbLessonRepository implements LessonRepositoryInterface {

    public function getAll()
    {
        // return via eloquent model
        return Lesson::all();
    }
}

function foo(LessonRepositoryInterface $lesson)
{
    $lessons = $lesson->getAll();

}