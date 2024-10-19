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
            height: 627px;
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

        .enviar a{
            margin-top:272px;
            color: #E1E1E1;
            background-color: #121212;
            text-align: center;
            width: 200px;
            height: 35px;
        }

        .enviar a:hover
        {
            color: #EC8E25;

        }

        .enviar a:active
        {
            color: #F23604;
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
            <a style="background-color: #EC8E25; color: #F23604">Logar</a>
            <a href="./ranking.php" style="background-color: #121212;">Ranking</a>
	    </div>
        <div style="color:#E1E1E1; margin-left:536px; margin-right:536px; margin-top:193px; margin-bottom:193px; ">
    <h1 style="color:#EC8E25; font-size:35px">Logar</h1>

    <form action="./controle_logar.php" method="post">
        <label>E-mail</label>
        <input type="email" name="email" id="email" required>
        <br><br>
        <div class="senha-container">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <button class="mostrar-senha" id="toggleSenha">Mostrar</button>
        </div>
        <br>
        <input class="enviar" type="submit" value="Logar" style="margin-left:1px; color:#E1E1E1; background-color:#121212; text-align:center; width:268px; height:35px;">
        <a href="cadastro.php" style="font-size:15px; padding-left:25%;"> Não possuo uma conta </a>
    </form>
    </div>

    <script>
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