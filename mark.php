<?php
/**
 * mark controller
 * for administrator only!
 * Set status solved
 */
if (isset($_COOKIE['cv']) && ($_COOKIE['cv']==md5('AdministrAtor'))) {

    include 'model/Task.php';

    $id = 0;
    if (isset($_POST['id'])) {
        $id = intval($_POST['id']);
    }

    $task = Task::getById($id);

    if ($task) {
        $task->setSolved(true);
        $task->update();
    } else {
        header("HTTP/1.0 404 not found");
        echo('<h1>Not found</h1>');

    }
} else {
    header("HTTP/1.0 403 forbidden");
    echo('<h1>Forbidden</h1>');
}