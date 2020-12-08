<?php
  $login = $_POST['login'];
  $hash = password_hash($_POST['pass'], PASSWORD_BCRYPT);

  $mysqli = new mysqli('localhost', 'root', 'root', 'todoajax');
  $statement = $mysqli->prepare('insert into users (login, hash) values (?, ?)');
  $statement->bind_param('ss', $login, $hash);
  $statement->execute();

  $statement->close();
  $mysqli->close();
?>