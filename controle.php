<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Candle Exorcism</title>
    <link rel="icon" href="./icone.png">
</head>
<body>
	<!-- css -->
	<style type="text/css">
        body
        {
            background-color: #000000;
            width: 1341px;
            height: 855px;
        }
		.menu_topo 
		{ 
			overflow: hidden;
            margin-right: 0px;
		}

		.menu_topo a
		{
			float: none;
			color: #E1E1E1;
			text-align: center;
			text-decoration: none;
			padding: 14px 16px;
			font-size: 25px;
		}

		.menu_topo a:hover
		{
			color: #EC8E25;
		}

        .menu_topo a:active
		{
			color: #F23604;
		}
	</style>

	<!-- menu que fica no topo -->
    <img src="./icone.png" width="100px" style="float:left;">
	    <div class="menu_topo">
            <a href="./index.php" style="background-color: #121212;">Início</a>
		    <a href="./download.php" style="background-color: #121212;">Download</a>
		    <a href="./extras.php" style="background-color: #121212;">Extras</a>
            <a style="background-color: #EC8E25; color: #F23604">Cadastro</a>
            <a href="./logar.php" style="background-color: #121212;">Logar</a>
            <a href="./ranking.php" style="background-color: #121212;">Ranking</a>
	    </div>
    
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['email']) && isset($_POST['nome']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    $servername = "localhost";
    $username = "postgres";
    $password = "33135141";
    $dbname = "candleexorcism";

    try {
        $conn = new PDO("pgsql:host=$servername;port=5432;dbname=$dbname;", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT COUNT(*) FROM usuario WHERE email = ?");
        $stmt->execute([$email]);
        $countEmail = $stmt->fetchColumn();

        $stmt = $conn->prepare("SELECT COUNT(*) FROM usuario WHERE nome = ?");
        $stmt->execute([$nome]);
        $countNome = $stmt->fetchColumn();

        if ($countEmail > 0) {
            echo '<label style="color: red; font-size: 50px;">Este e-mail já está cadastrado!</label>';
            echo '<form method="post" action="cadastro.php">';
            echo '<input type="submit" value="RETORNAR">';
            echo '</form>';
        } elseif($countNome > 0) {
                echo '<label style="color: red; font-size: 50px;">Este nome já está cadastrado!</label>';
                echo '<form method="post" action="cadastro.php">';
                echo '<input type="submit" value="RETORNAR">';
                echo '</form>';
        }else{
            $usuario = $conn->prepare('INSERT INTO usuario(email,nome,senha) VALUES (?, ?, ?);');
            $usuario->bindParam(1, $email);
            $usuario->bindParam(2, $nome);
            $usuario->bindParam(3, $senha);
            if ($usuario->execute()) {
                header("Location: ./conta.php?nome=" . urlencode($nome));
                exit();
            } else {
                echo "<label>Erro ao cadastrar.</label>";
            }
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>

</body>
</html>