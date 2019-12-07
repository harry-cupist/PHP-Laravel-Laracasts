</<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php foreach ($animals as $animal) : ?>
            <li><?= $animal; ?></li>
        <?php endforeach ?>
    </ul>
    <ul>
        <?php foreach ($person as $feature) : ?>
            <li><?= $feature; ?></li>
        <?php endforeach; ?>
    </ul>
    <ul>
        <?php foreach ($person as $key => $value) : ?>
            <li><strong><?= $key; ?></strong> <?= $value; ?></li>
        <?php endforeach; ?>

    </ul>
</body>
</html>