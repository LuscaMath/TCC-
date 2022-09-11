<?php
    session_start();
    if(isset($_SESSION["usuario"])) {
        echo '<h3>Login feito com sucesso, bem vundo - ' .$_SESSION["usuario"]. '<\h3>';
        echo '<br><br><a href="logout.php">'.'logout'.'</a>';
    } else {
        header("location:index.php");
    }
?>