<?php

include('config.php');
Mysql::conectar();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <div class="container">

        <div class="form-image">
            <img src="../assets/imagens/undraw_barber_-3-uel.svg" alt="">
            <a href="../login/index.php">
                <- Voltar para o login</a>
        </div>
        <div class="form">
            <form method="post">
                <div class="form-header">
                    <div class="title">
                        <h1>Crie sua conta</h1>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label>Usuario</label>
                        <input type="text" name="usuario" placeholder="Usuario">
                    </div>

                    <div class="input-box">
                        <label>E-mail</label>
                        <input type="email" name="email" placeholder="E-mail">
                    </div>

                    <div class="input-box">
                        <label>Senha</label>
                        <input type="password" name="senha" placeholder="Senha">
                    </div>
                </div>

                <div class="login-button">
                    <input type="submit" name="acao" value="Cadastrar">
                    <input type="hidden" name="form" value="f_form">
                    <?php
                    if (isset($_POST['acao']) && $_POST['form'] == 'f_form') {
                        $usuario = $_POST['usuario'];
                        $email = $_POST['email'];
                        $senha = $_POST['senha'];

                        if ($usuario == '') {
                            echo '<div class = "teste">' . 'O usuario ficou vazio!' . '</div>';
                        } else if ($email == '') {
                            echo '<div class = "teste">' . 'O email ficou vazio!' . '</div>';
                        } else if ($senha == '') {
                            echo '<div class = "teste">' . 'A senha ficou vazia!' . '</div>';
                        } else {

                            $sqlUsuario = Mysql::conectar()->prepare("SELECT * FROM `formulario` WHERE `usuario` = ?");
                            $sqlUsuario->execute(array($usuario));

                            if ($sqlUsuario->rowCount() == 1) {
                                echo '<div class = "teste"' . '>Usuario já cadastrado' . '</div>';
                            } else {
                                $sql = Mysql::conectar()->prepare("INSERT INTO `formulario` VALUES (null,?,?,?)");
                                $sql->execute(array($usuario, $email, $senha));
                                echo '<div class = "teste">' . 'Usuario ' . 'cadastrado com sucesso!' . '</div>';
                            }
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</body>

</html>