<?php
    setcookie('user', $login, time() - 3600, "/");
    
    header('Location: /');
?>