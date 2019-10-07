<?php
/**
 * index controller
 * main page. Consist a list of task
 */
include 'model/Task.php';

$cnt = Task::countTask();
$perPage = 3; // tasks on page
$taskOnLastPage = $cnt % $perPage;
$pages = $taskOnLastPage > 0 ? ($cnt - $taskOnLastPage) / $perPage + 1 : $cnt / $perPage;

if (isset($_GET['page'])) {
	$page = intval($_GET['page']);
} else {
    $page = 1;
}

if ($page <= 0) {
    $page = 1;
}

if ($page > $pages) {
	$page = $pages;
}

$sort = '';
if(isset($_GET['sort'])) {
    if (in_array($_GET['sort'], ['username', 'email', 'solved'])) {
        $sort = $_GET['sort'];
    }
}

$list = Task::tasks($sort, $perPage, ($page - 1) * $perPage);

include "view/index.phtml";
?>

