<?php
  $id = $_POST['id'];
  $status = $_POST['status'];

  $mysqli = new mysqli('localhost', 'root', 'root', 'todoajax');
  $statement = $mysqli->prepare('UPDATE todolist SET status = ? WHERE id = ?');
  $statement->bind_param('ii', $status, $id);
  $statement->execute();

  $statement->close();
  $mysqli->close();
?>