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
        #atualizar{
            height:500px;
            width:500px;
            margin-top:10%;
            margin-left:50%;
            padding-top:50px;
            font-size:50px;   
        }

        .botoes{
            margin-left: 10px;
            cursor: pointer;
            background-color: #EC8E25;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
        }
        .senha-container {
            display: flex;
            align-items: center;
        }
        .mostrar-senha {
            margin-left: 10px;
            cursor: pointer;
            background-color: #EC8E25;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
        }
	</style>

	<!-- menu que fica no topo -->
    <img src="./icone.png" width="100px" style="float:left;">
	    <div class="menu_topo">
            <a href="./index.php" style="background-color: #121212;">Início</a>
		    <a href="./download.php" style="background-color: #121212;">Download</a>
		    <a href="./extras.php" style="background-color: #121212;">Extras</a>
            <a href="./cadastro.php" style="background-color: #121212;">Cadastro</a>
            <a href="./logar.php" style="background-color: #121212;">Logar</a>
            <a href="./ranking.php" style="background-color: #121212;">Ranking</a>
	    </div>
    
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['id']) || isset($_GET['id']) ){
    $id = isset($_POST['id']) ? $_POST['id'] : $_GET['id'];
    

    $servername = "localhost";
    $username = "postgres";
    $password = "33135141";
    $dbname = "candleexorcism";

    try {
        $conn = new PDO("pgsql:host=$servername;port=5432;dbname=$dbname;", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * from usuario where id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $dadosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $email = $dadosUsuario['email'];
        $nome = $dadosUsuario['nome'];
        $senha = $dadosUsuario['senha'];
        $tempoAtingido = $dadosUsuario['tempo_atingido'];

        echo "<div id='atualizar'>";
        echo "<form action='editar_controle.php' method='POST' style='margin-bottom: 10px;'>
        <label for='id' style='color:#EC8E25; font-size:25px;'>ID:</label>
        <input type='text' name='id' value='" . htmlspecialchars($id) . "' readonly>
        </form>";

        echo "<form action='editar_controle.php' method='POST' style='margin-bottom: 10px;'>
        <label for='email' style='color:#EC8E25; font-size:25px;'>Endereço de e-mail:</label>
        <input type='email' name='email' value='" . htmlspecialchars($email) . "' readonly>
        </form>";

        echo "<div class='senha-container'>
        <label for='senha' style='color:#EC8E25; font-size:25px;'>Senha:</label>
        <input type='password' name='senha' id ='senha' value='" . htmlspecialchars($senha) . "' readonly>
        <button class='mostrar-senha' id='toggleSenha'>Mostrar Senha</button>
        </div>";

        echo "<form action='editar_controle.php' method='POST' style='margin-bottom: 10px;'>
        <label for='nome' style='color:#EC8E25; font-size:25px;'>Nome de usuário:</label>
        <input type='text' name='nome' value='" . htmlspecialchars($nome) . "'>
        <input type='hidden' name='id' value='" . htmlspecialchars($id) . "'>
        <input type='submit' value='Atualizar' class='botoes'>
        </form>";

        echo "<form action='editar_controle.php' method='POST' style='margin-bottom: 10px;'>
        <label for='tempo_atingido' style='color:#EC8E25; font-size:25px;'>Tempo Atingido:</label><br>
        
        <label for='minutos' style='color:#EC8E25; font-size:20px;'>Minutos:</label>
        <input type='number' name='minutos' value='" . htmlspecialchars(floor($tempoAtingido / 60)) . "' min='0'><br>

        <label for='segundos' style='color:#EC8E25; font-size:20px;'>Segundos:</label>
        <input type='number' name='segundos' value='" . htmlspecialchars($tempoAtingido % 60) . "' min='0' max='59'><br>

        <input type='hidden' name='id' value='" . htmlspecialchars($id) . "'>
        <input type='submit' value='Atualizar' class='botoes'>
        </form>";


        echo "<form action='admin.php' method='POST' style='margin-bottom: 10px;'>
        <input type='submit' value='RETORNAR'>
        </form>";
        echo "</div>";


    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
<script>
    const toggleSenha = document.getElementById('toggleSenha');
    const senhaInput = document.getElementById('senha');

    toggleSenha.addEventListener('click', function() {
        if (senhaInput.type === 'password') {
            senhaInput.type = 'text';
            toggleSenha.textContent = 'Ocultar';
        } else {
            senhaInput.type = 'password';
            toggleSenha.textContent = 'Mostrar';
        }
    });
</script>

</body>
</html>