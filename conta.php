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
        .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

        .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
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

$servername = "localhost";
$username = "postgres";
$password = "33135141";
$dbname = "candleexorcism";

try {
    $conn = new PDO("pgsql:host=$servername;port=5432;dbname=$dbname;", $username, $password);
    if (isset($_GET['erro']) && $_GET['erro'] == 'nomeexistente') {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            alert('O nome de usuário já existe. Por favor, escolha outro.');
            // Remove o parâmetro 'erro' da URL após o alerta
            if (window.history.replaceState) {
                const url = new URL(window.location.href);
                url.searchParams.delete('erro');  // Remove o parâmetro 'erro'
                window.history.replaceState({}, document.title, url.toString());
            }
        });
    </script>";
    }
    if (isset($_GET['nome'])) {
        $nome = htmlspecialchars($_GET['nome']);

        $stmt = $conn->prepare("SELECT id, senha, email, tempo_atingido FROM usuario WHERE nome = :nome");
            $stmt->bindParam(':nome', $nome);
            $stmt->execute();
            $dadosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);
            $email = $dadosUsuario['email'];
            
            echo "<div style='width:500px; height:500px; margin-left:10%;'>";
            echo "<h1 style='color:#EC8E25; font-size:35px'>Detalhes da conta:</h1>";
            echo "<h2 style='color:#EC8E25; font-size:25px; display:inline;'>Endereço de e-mail: $email</h2>";
            echo "<br> <br>";
            echo "<h2 style='color:#EC8E25; font-size:25px; display:inline;'>Nome de usuário: $nome</h2>";
            echo "<button onclick='mudarnome(event)' style='width:70px; height:50px; background-color:black; color:white; margin-left: 20px;'>Alterar Nome</button>";
            
            if ($dadosUsuario) {
                $senha = htmlspecialchars($dadosUsuario['senha']);
                echo "<div class='senha-container'>
                    <h2 style='color:#EC8E25; font-size:25px; display:inline;'>Senha:</h2>
                    <input type='password' id='senha' name='senha' value='$senha' readonly>
                    <button class='mostrar-senha' id='toggleSenha' type='button'>Mostrar</button>
                    <button onclick='mudarsenha(event)' style='width:70px; height:50px; background-color:black; color:white; margin-left: 20px;'>Alterar Senha</button>;
                </div>";

                $tempoAtingido = $dadosUsuario['tempo_atingido'];
                if (empty($tempoAtingido)) {
                    echo "<h2 style='color:#EC8E25; font-size:25px'>Tempo atingido: Não disponível.</h2>";
                } else {
                    echo "<h2 style='color:#EC8E25; font-size:25px'>Tempo atingido: $tempoAtingido</h2>";
                }
            } else {
                echo "<h1 style='color:#EC8E25; font-size:35px'>Nome de usuário não fornecido.</h1>";
                echo "<h2 style='color:#EC8E25; font-size:25px'>Tempo atingido: Não registrado ainda!.</h2>";
            }
            
            echo "<form id='delete' method='POST' action='deletar_conta.php' style='margin-top: 20px;'>";
            echo "<input type='hidden' name='nome' value='$nome'>";
            echo "<button type='submit' onclick='confirmDeletion(event)' style='width:70px; height:50px; background-color:red; color:white;'>Deletar Conta</button>";
            echo "</form>";
            echo "</div>";
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
   <script>
        function confirmDeletion(event) {
            event.preventDefault();
            let confirmation = confirm("Tem certeza que deseja deletar sua conta? Esta ação não pode ser desfeita.");
            if (confirmation) {
                document.getElementById('delete').submit()
            }
        }
        function mudarnome(event) {
            let novoNome = prompt("Por favor, insira o novo nome de usuário:");
            if (novoNome) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = 'mudar_nome.php';

                let inputNome = document.createElement('input');
                inputNome.type = 'hidden';
                inputNome.name = 'novo_nome';
                inputNome.value = novoNome;

                let inputNomePHP = document.createElement('input');
                inputNomePHP.type = 'hidden';
                inputNomePHP.name = 'nome_atual'; 
                inputNomePHP.value = '<?php echo $nome; ?>';; 
                
                form.appendChild(inputNomePHP);
                form.appendChild(inputNome);
                document.body.appendChild(form);
                form.submit();
        }
    }

    function mudarsenha(event) {
            let novaSenha = prompt("Por favor, insira sua nova senha:");
            if (novaSenha) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = 'mudar_senha.php';

                let inputSenha = document.createElement('input');
                inputSenha.type = 'hidden';
                inputSenha.name = 'nova_senha';
                inputSenha.value = novaSenha;

                let inputID = document.createElement('input');
                inputID.type = 'hidden';
                inputID.name = 'id'; 
                inputID.value = '<?php echo $dadosUsuario['id']; ?>';

                let inputNome = document.createElement('input');
                inputNome.type = 'hidden';
                inputNome.name = 'nome'; 
                inputNome.value = '<?php echo $nome; ?>';
                
                form.appendChild(inputID);
                form.appendChild(inputSenha);
                form.appendChild(inputNome);
                document.body.appendChild(form);
                form.submit();
        }
    }

    const toggleSenha = document.getElementById('toggleSenha');
    const senhaInput = document.getElementById('senha');

    toggleSenha.addEventListener('click', function() {
       event.preventDefault();
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