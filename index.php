<?php
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
$list = Task::tasks($perPage, ($page - 1) * $perPage);
?>

<html>
<?php include_once 'view/html_head';?>
<body>
<table>
<thead>
<tr>
<td>User</td>
<td>Email</td>
<td>Task</td>
<td>Modified?</td>
<td>Status</td>
</tr>
</thead>
<tbody>
<?php foreach ($list as $task) : ?>
<tr>
<td><?= $task->getUserName();?></td>
<td><?= $task->getEmail();?></td>
<td><?= htmlentities($task->getText());?></td>
<td><?= $task->getModified() ? 'Yes' : '';?></td>
<td><?= $task->getSolved() ? 'Solved' : 'Not solved';?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<?php /* paginator */ ?>




<p>
<a href="/add.php">Add task</a>
</p>
<p>
<?php if (isset($_COOKIE['cv']) && ($_COOKIE['cv']==md5('AdministrAtor'))) : ?>
<a href="logout.php">Logout</a>
<?php else : ?>
<a href="/login.php">Login as administrator</a>
<?php endif;?>
</p>
</body>
</html>