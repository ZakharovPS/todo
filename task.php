<?php
if ($_COOKIE['user'] == '')
  header('Location: auth.html');
$id = $_GET['id'];
$mysqli = new mysqli('localhost', 'root', 'root', 'todoajax');
$statement = $mysqli->prepare('select name, description, status from todolist where id = ?');
$statement->bind_param('i', $id);
$statement->execute();
$statement->bind_result($name, $description, $status);
?>
<!doctype html>
<html lang="ru">

<head>
  <meta charset="utf-8" />
  <title>Просмотр задачи</title>
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
    <form class="form-add mt-5 d-none">
      <h4 class="mb-3">Редактирование задачи</h4>
      <p class="text-danger" id="error"></p>
      <p class="text-success" id="success"></p>
      <div class="mb-3">
        <label for="newName">Новое название задачи</label>
        <input type="text" class="form-control" id="newName" name="newName">
      </div>
      <div class="mb-3">
        <label for="newDescription">Новое описание задачи</label>
        <textarea class="form-control" id="newDescription" name="newDescription"></textarea>
      </div>
      <button class="btn btn-primary btn-lg btn-block confirmButton" type="button">Внести изменения</button>
    </form>
    <div class="card my-5" data-id="<?php echo $id ?>">
      <?php
      if ($statement->fetch()) {
      ?>
        <div class="card-header">
          <h4 class="font-weight-normal text-center" id="name"><?php echo $name ?></h4>
        </div>
        <div class="card-body d-flex flex-column">
          <span id="description"><?php echo $description ?></span>
          <?php
          if ($status == true)
            echo '<span class="badge badge-pill badge-success mt-3">Выполнена</span>';
          else
            echo '<span class="badge badge-pill badge-danger mt-3">Не выполнена</span>';
          ?>
          <button type="button" class="btn btn-sm btn-outline-secondary mt-3 editButton">Редактировать</button>
        </div>
    </div>
  <?php
      }
      $statement->close();
      $mysqli->close();
  ?>
  <h4 class="mb-3">Комментарии</h4>
  <div class="comments">
    <div>

  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/task.js"></script>
</body>

</html>