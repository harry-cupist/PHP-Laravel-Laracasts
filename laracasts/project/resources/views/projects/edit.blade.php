@extends('layout')


@section('content')
    <h1 class=""title>Edit Project</h1>

    <form method="POST" action="/projects/{{ $project->id }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <div>
            <label class="label" for="title">Title</label>
            <input type="text" class="input" name="title" placeholder="Title" value="{{ $project->title }}">
        </div>
        <div>
            <label class="label" for="description">Description</label>
            <textarea name="description" class="textarea" >{{ $project->description }}</textarea>
        </div>

        <div>
            <button type="submit" class="button is-link">Update Project</button>
        </div>
    </form>

    <form method="POST" action="/projects/{{ $project->id }}">
        {{ method_field('DELETE') }}
        {{ csrf_Field() }}

        <div>
            <button type="submit">Delete Project</button>
        </div>
    </form>
@endsection
