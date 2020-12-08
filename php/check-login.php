<?php
  $login = $_POST['login'];

  $mysqli = new mysqli('localhost', 'root', 'root', 'todoajax');
  $statement = $mysqli->prepare('select * from users where login = ?');
  $statement->bind_param('s', $login);
  $statement->execute();
  $statement->store_result();

  if ($statement->num_rows == 0)
    echo true;
  else
    echo false;
    
  $statement->close();
  $mysqli->close();
?>