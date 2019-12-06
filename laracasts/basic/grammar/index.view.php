</<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Task For The Day</h1>
    <ul>
        <?php foreach ($task as $heading => $value) :?>
        <li>
            <!-- ucwords: Capitalize first letter of each word -->
            <Strong><?= ucwords($heading); ?>: </Strong> <?= $value; ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <ul>
        <li>
            <strong> Name: </strong> <?= $task['title']; ?>
        </li>
        <li>
            <strong> Due Date: </strong> <?= $task['due']; ?>
        </li>
        <li>
            <strong> Person Responsible: </strong> <?= $task['assigned_to']; ?>
        </li>
        <!-- Boolean 표현 1. 삼항 연산자 -->
        <li>
            <strong> Status: </strong> <?= $task['completed'] ? 'Complete' : 'Incomplete'; ?>
        </li>
        <!-- Boolean 표현 2. 일반 조건문(if/else) -->
        <li>
            <strong> Status: </strong>
            <?php
            if ($task['completed']) {
                echo 'Complete &#9989;';
            } else {
                echo 'Incomplete ';
            }
            ?>

        </li>
        <!-- 2-1. -->
        <li>
            <strong> Status: </strong>
            <?php if ($task['completed']) : ?>
                <span class="icon">&#9989;</span>
            <?php endif; ?>
        </li>
        <!-- 2.2. not 표현 -->
        <li>
            <strong> Status: </strong>
            <?php
                if (! $task['completed']){
                    echo 'Incomplete';
                }
            ?>
        </li>
    </ul>
</body>
</html>

