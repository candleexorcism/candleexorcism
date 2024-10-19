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
            <a href="./cadastro.php" style="background-color: #121212;">Cadastro</a>
            <a href="./logar.php" style="background-color: #121212;">Logar</a>
            <a href="./ranking.php" style="background-color: #121212;">Ranking</a>
	    </div>
    
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['id'])){
    $id = $_POST['id'];

    $servername = "localhost";
    $username = "postgres";
    $password = "33135141";
    $dbname = "candleexorcism";

    try {
        $conn = new PDO("pgsql:host=$servername;port=5432;dbname=$dbname;", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("DELETE from usuario where id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: admin.php");




        
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>

</body>
</html>