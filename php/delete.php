<?php
  $id = $_POST['id'];

  $mysqli = new mysqli('localhost', 'root', 'root', 'todoajax');
  $statement = $mysqli->prepare('DELETE FROM todolist WHERE id = ?');
  $statement->bind_param('i', $id);
  $statement->execute();

  $statement->close();
  $mysqli->close();
?>