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
            height: 1050px;
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

        .btn_download a{
            position: relative;
            display:inline-block;
            margin-top:30px;
            margin-left: 570px;
            margin-right: 570px;
            color: #E1E1E1;
            background-color: #121212;
            text-align: center;
            width: 200px;
            height: 35px;
        }

        .btn_download a:hover
        {
            color: #EC8E25;

        }

        .btn_download a:active
        {
            color: #F23604;
        }

        .imagem
        {
            border-style:solid;
            border-color:#EC8E25;
            border-width:3px;
        }
        
        //<a href="./icone.png" style="font-size:35px; margin-left:601px; margin-right:601px; text-decoration:none;" download>download</a>
	</style>

	<!-- menu que fica no topo -->
    <img src="./icone.png" width="100px" style="float:left;">
	    <div class="menu_topo">
            <a href="./index.php" style="background-color: #121212;">Início</a>
		    <a href="./download.php" style="background-color: #121212;">Download</a>
		    <a style="background-color: #EC8E25; color: #F23604">Extras</a>
            <a href="./cadastro.php" style="background-color: #121212;">Cadastro</a>
            <a href="./logar.php" style="background-color: #121212;">Logar</a>
            <a href="./ranking.php" style="background-color: #121212;">Ranking</a>
	    </div>

        <br><br><br><br>
        <h1 style="color:#EC8E25; font-size:35px; margin-left:510px; margin-right:510px;">Download de imagens</h1>

        <img src="./icone.png" class="imagem" style="width:480px; height:300px; margin-left:430px;">

        <div class="btn_download">
            <a href="./icone.png" download style="font-size:30px; text-decoration:none; ">Download</a>
        </div>

        <br><br><br><br>

        <img src="./background.png" class="imagem" style="width:480px; height:300px; margin-left:430px;">

        <div class="btn_download">
            <a href="./background.png" download style="font-size:30px; text-decoration:none; ">Download</a>
        </div>
        
</body>
</html>