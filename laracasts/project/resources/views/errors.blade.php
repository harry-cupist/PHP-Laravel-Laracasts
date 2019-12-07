<?php if ($errors->any()) : ?>
<div>
    <ul>
        <?php foreach($errors->all() as $error) : ?>
        <li> {{ $error }}</li>
        <?php endforeach ?>
    </ul>
</div>
<?php endif; ?>
