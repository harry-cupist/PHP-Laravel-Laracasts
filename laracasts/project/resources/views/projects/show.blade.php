@extends('layout')

@section('content')
<h1>{{$project->title}}</h1>
<div>
    {{$project->description}}
    <p>
        <a href="/projects/{{$project->id}}/edit">edit </a>
    </p>
</div>
<?php if($project->tasks->count()) : ?>
    <div>
        <?php foreach ($project->tasks as $task) : ?>
            <div>
                <form method="POST" action="/tasks/{{ $task->id }}">
                    @method('PATCH')
                    @csrf

                    <label class="checkbox" form="completed">
                        <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                        {{ $task->description }}
                    </label>
                </form>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>
<hr>
{{-- add a new task form --}}
<form method="POST" action="/projects/{{ $project->id }}/tasks">
    @csrf

    <div>
        <label class="label" for="description">New Task</label>
        <input type="text" class="input" name="description" placeholder="New Task">
    </div>
    <div>
        <button type="submit">Add Task</button>
    </div>

    @include ('errors')

</form>

@endsection
