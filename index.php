<?php
if ($_COOKIE['user'] == '')
    header('Location: auth.html');
$mysqli = new mysqli('localhost', 'root', 'root', 'todoajax');
$statement = $mysqli->prepare('select id, name, status from todolist where user = ?');
$statement->bind_param('s', $_COOKIE['user']);
$statement->execute();
$statement->bind_result($id, $name, $status);
?>
<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <title>Список задач</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="d-flex flex-row align-items-center bg-white border-bottom py-3 px-5">
        <a class="navbar-brand mr-auto" href="/">Список задач</a>
        <h6 class="mr-3"> <?= $_COOKIE['user'] ?></h6>
        <a class="btn btn-outline-primary" href="php/exit.php">Выйти</a>
    </div>
    <main>
        <form action="php/add.php" method="post" class="form-add mt-5">
            <h4 class="mb-3">Добавление задачи</h4>
            <p class="text-danger" id="error"></p>
            <p class="text-success" id="success"></p>
            <div class="mb-3">
                <label for="name">Название задачи</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="description">Описание задачи</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <button class="btn btn-primary btn-lg btn-block" type="submit" id="addButton">Добавить задачу</button>
        </form>
        <ul class="list-group mt-5">
            <?php
            while ($statement->fetch()) {
            ?>
                <li class="list-group-item d-flex justify-content-between align-items-center" data-id="<?php echo $id ?>">
                    <h6><?php echo $name ?></h6>
                    <div>
                        <?php
                        if ($status == true)
                            echo '<button type="button" class="btn btn-sm btn-success mr-2 statusButton">Выполнена</button>';
                        else
                            echo '<button type="button" class="btn btn-sm btn-danger mr-2 statusButton">Не выполнена</button>';
                        ?>
                        <div class="btn-group">
                            <a class="btn btn-sm btn-outline-info" href="task.php?id=<?php echo $id ?>">Просмотреть</a>
                            <button type="button" class="btn btn-sm btn-outline-danger deleteButton">Удалить</button>
                        </div>
                    </div>
                </li>
            <?php
            }
            $statement->close();
            $mysqli->close();
            ?>
        </ul>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/tasks.js"></script>
</body>

</html>