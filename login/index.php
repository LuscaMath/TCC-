<?php
session_start();
$host = "localhost";
$usuario = "root";
$senha = "";
$database = "form_cadastro";
$message = "";

try {
    $connect = new PDO("mysql:host=$host; dbname=$database", $usuario, $senha);

    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_POST["login"])) {
        if (empty($_POST["usuario"]) || empty($_POST["senha"])) {
            $message = '<label class="teste">Preencha todos os campos</label>';
        } else {
            $query = "SELECT * FROM formulario WHERE usuario = :usuario AND senha = :senha";
            $statement = $connect->prepare($query);
            $statement->execute(array('usuario' => $_POST["usuario"], 'senha' => $_POST["senha"]));

            $count = $statement->rowCount();
            if ($count > 0) {
                $_SESSION["usuario"] = $_POST["usuario"];
                header("location:login_success.php");
            } else {
                $message = '<label class="teste">Usuario ou senha incorretos</label>';
            }
        }
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>

    <div class="container">

        <div class="form-image">
            <img src="../assets/imagens/undraw_barber_-3-uel.svg" alt="">
            <a href="../index.html">
                <- Voltar para página inicial</a>
        </div>
        <div class="form">
            <form method="post">
                <div class="form-header">
                    <div class="title">
                        <h1>Faça login para continuar</h1>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label>Usuario</label>
                        <input type="text" name="usuario" placeholder="Digite seu usuario">
                    </div>

                    <div class="input-box">
                        <label>Senha</label>
                        <input type="password" name="senha" placeholder="Digite sua senha">
                    </div>

                </div>

                <div class="login-button">
                    <input type="submit" name="login" value="Entrar">
                    <p>Não tem uma conta? <a href="../cadastro/index.php">Registre-se</a></p>
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</body>

</html>