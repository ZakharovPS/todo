<?php
  $id = $_POST['id'];
  $name = $_POST['name'];
  $description = $_POST['description'];

  $mysqli = new mysqli('localhost', 'root', 'root', 'todoajax');
  $statement = $mysqli->prepare('UPDATE todolist SET name = ?, description = ? WHERE id = ?');
  $statement->bind_param('ssi', $name, $description, $id);
  $statement->execute();

  $statement->close();
  $mysqli->close();
?>