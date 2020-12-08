<?php
  $login = $_POST['login'];
  $pass = $_POST['pass'];

  $mysqli = new mysqli('localhost', 'root', 'root', 'todoajax');
  $statement = $mysqli->prepare('select hash from users where login = ?');
  $statement->bind_param('s', $login);
  $statement->execute();
  $statement->bind_result($hash);

  if ($statement->fetch())
    if (password_verify($pass, $hash))
    {
        setcookie('user', $login, time() + 3600, "/");
        echo true;
    }
    else
    echo false;
  else
    echo false;
    
  $statement->close();
  $mysqli->close();
?>