<?php

require 'src/Nanite.php';
require 'src/functions.php';

get('/', function () {
?>
    <h1>Nanite Example</h1>
    <h2>Post</h2>
    <form action="<?= $_SERVER['PHP_SELF'] ?>?<?= baseUri('/test') ?>" method="post">
        <input type="text" name="name" />
        <button type="submit">Submit</button>
    </form>
    <h2>Put</h2>
    <form action="<?= $_SERVER['PHP_SELF'] ?>?<?= baseUri('/test') ?>" method="post">
        <input type="hidden" name="_method" value="PUT" />
        <input type="text" name="name" />
        <button type="submit">Submit</button>
    </form>
    <h2>Patch</h2>
    <form action="<?= $_SERVER['PHP_SELF'] ?>?<?= baseUri('/test') ?>" method="post">
        <input type="hidden" name="_method" value="PATCH" />
        <input type="text" name="name" />
        <button type="submit">Submit</button>
    </form>
    <h2>Delete</h2>
    <form action="<?= $_SERVER['PHP_SELF'] ?>?<?= baseUri('/123/delete') ?>" method="post">
        <input type="hidden" name="_method" value="DELETE" />
        <button type="submit">Delete</button>
    </form>
<?php
});

get('/test', function () {
    echo "Test page";
});

post('/test', function () {
    $name = empty($_POST['name']) ? 'World' : $_POST['name'];
    echo "Hello, {$name}";
});

put('/test', function () {
    echo 'Put: ' . $_POST['name'];
});

patch('/test', function () {
    echo 'Patch: ' . $_POST['name'];
});

delete('/([0-9]+)/delete', function ($id) {
    echo "Deleted: {$id}";
});
