<?php
  $name = $_POST['name'];
  $description = $_POST['description'];
  $user = $_COOKIE['user'];

  if ($name != '' && $description != '')
  {
    $mysqli = new mysqli('localhost', 'root', 'root', 'todoajax');
    $statement = $mysqli->prepare('insert into todolist (user, name, description) values (?, ?, ?)');
    $statement->bind_param('sss', $user, $name, $description);
    $statement->execute();

    $statement->close();
    $mysqli->close();
  }

  header('Location: /');
?>