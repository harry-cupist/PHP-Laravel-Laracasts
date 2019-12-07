<!doctype html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <h1>Create New Project</h1>

    <form method="POST" action="/projects">
        {{ csrf_field() }}
        <div>
            <input type="text" name="title" placeholder="Project title" required value="{{ old('title') }}">
        </div>

        <div>
            <textarea name="description" placeholder="Project description" required> {{ old('description') }} </textarea>
        </div>

        <div>
            <button type="submit">Create Project</button>
        </div>

        <?php if ($errors->any()) : ?>
        <div>
            <ul>
                <?php foreach($errors->all() as $error) : ?>
                    <li> {{ $error }}</li>
                <?php endforeach ?>
            </ul>
        </div>
        <?php endif; ?>
    </form>
</body>
</html>
