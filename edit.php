<?php
/**
 * edit controller
 * for administrator only!
 */
if (isset($_COOKIE['cv']) && ($_COOKIE['cv']==md5('AdministrAtor'))) {

    include 'model/Task.php';

    $id = 0;
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
    }

    $task = Task::getById($id);

    if ($task) {
        $message = '';
        if (isset($_POST['submit'])) {
            $newText = $_POST['task'];
            if (!$newText) {
                $message = 'The task is empty';
            }
            if ($newText == $task->getText()) {
                $message == 'The task is not changed';
            }
            if (!$message) {
                $task->setText($newText);
                $task->setModified(true);

                $answer = $task->update();

                if ($answer) {
                    header('Location: /index.php');
                } else {
                    $message = 'Update was unsuccess';
                }
            }
        }

        include 'view/edit.phtml';
    } else {
        header("HTTP/1.0 404 not found");
        echo('<h1>Not found</h1>');

    }
} else {
    header("HTTP/1.0 403 forbidden");
    echo('<h1>Forbidden</h1>');
}