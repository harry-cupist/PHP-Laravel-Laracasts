<!doctype html>
<html lang="en">
<head>
    <title>@yield('title', 'laracasts')</title>
</head>
<body>

    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/about">About Us </a></li>
        <li><a href="/contact">Contact </a> us to learn more.</li>
    </ul>
    @yield('content')
</body>
</html>
