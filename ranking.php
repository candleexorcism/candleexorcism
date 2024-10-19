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
        .pagination {
        text-align: center;
        margin-top: 20px;
    }

    .pagination a, .pagination strong {
        display: inline-block;
        padding: 10px 15px;
        margin: 0 5px;
        border: 2px solid #EC8E25;
        border-radius: 5px;
        color: #E1E1E1; 
        text-decoration: none;
    }

    .pagination a:hover {
        background-color: #EC8E25;
        color: #000;
    }

    .pagination strong {
        background-color: #F23604;
        color: white;
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
            <a style="background-color: #EC8E25; color: #F23604">Ranking</a>
	    </div>
        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

            $servername = "localhost";
            $username = "postgres";
            $password = "33135141";
            $dbname = "candleexorcism";
            try {
                $conn = new PDO("pgsql:host=$servername;port=5432;dbname=$dbname;", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $resultadospagina = 15;
                $pagina = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                $comeco = ($pagina - 1) * $resultadospagina;
                $query = "SELECT 
                DENSE_RANK() OVER (ORDER BY tempo_atingido ASC) as posicao,
                nome, tempo_atingido 
                FROM usuario 
                ORDER BY tempo_atingido ASC
                LIMIT :limit OFFSET :offset";

                $stmt = $conn->prepare($query);
                $stmt->bindValue(':limit', $resultadospagina, PDO::PARAM_INT);
                $stmt->bindValue(':offset', $comeco, PDO::PARAM_INT);
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $totalQuery = "SELECT COUNT (*) from usuario";
                $totalStmt = $conn->prepare($totalQuery);
                $totalStmt->execute();
                $totalResults = $totalStmt->fetchColumn();
                $totalPages = ceil($totalResults / $resultadospagina);
                
                echo "<table border='1px'; width='1000px' height='500px' bgcolor='#000000' style='margin-left: 25%; margin-top: 5%; color:white; font-size:30px;'>";
                echo "<tr>";
                echo "<th>Posição</th>";
                echo "<th>Nome</th>";
                echo "<th>Tempo atingido</th>";
                echo "</tr>";
                function tempovalido($user) {
                    return !empty($user['tempo_atingido']) && (float)$user['tempo_atingido'] > 0;
                }

                $usuariosValidos = array_filter($data, 'tempoValido');

                usort($usuariosValidos, function($a, $b) {
                    return(float)$a['tempo_atingido'] <=> (float)$b['tempo_atingido'];
                });
                foreach ($usuariosValidos as $key => $user){
                    if (!tempovalido($user)){
                        continue;
                    }
                    $posicaoGlobal = $comeco + $key;
                    echo "<tr>";
                    if ($posicaoGlobal === 0){
                    echo "<td bgcolor=#FFD700>" . ($posicaoGlobal + 1) ."º Lugar" . "</td>";    
                    }
                    elseif($posicaoGlobal === 1){
                    echo "<td bgcolor='#C0C0C0';> " . ($posicaoGlobal + 1) ."º Lugar" . "</td>";    
                    }
                    elseif($posicaoGlobal === 2){
                    echo "<td bgcolor='#CD7F32';> " . ($posicaoGlobal + 1) ."º Lugar" . "</td>";    
                    }else{
                    echo "<td> " . ($posicaoGlobal + 1) ."º Lugar" . "</td>";
                    }
                    echo "<td> " . htmlspecialchars($user['nome']) . "</td>";

                    $tempo = (float)$user['tempo_atingido'];
                    $milissegundos = ($tempo - floor($tempo)) * 1000; 
                    $tempoInteiro = floor($tempo); 

                    if ($tempoInteiro >= 3600) { 
                        $horas = floor($tempoInteiro / 3600); 
                        $minutos = floor(($tempoInteiro % 3600) / 60); 
                        $segundos = $tempoInteiro % 60; 
                        echo "<td> " . $horas . " horas, " . $minutos . " minutos, " . $segundos . " segundos e " . round($milissegundos) . " milissegundos</td>";
                    } elseif ($tempoInteiro >= 60) { 
                        $minutos = floor($tempoInteiro / 60);
                        $segundos = $tempoInteiro % 60;
                        echo "<td> " . $minutos . " minutos, " . $segundos . " segundos e " . round($milissegundos) . " milissegundos</td>";
                    } elseif ($tempoInteiro >= 1.0) {
                        echo "<td>" . $tempoInteiro . " segundos e " . round($milissegundos) . " milissegundos</td>";
                    } else {
                        echo "<td>" . round($milissegundos) . " milissegundos</td>";
                    }
                }
                echo "</table>";
                echo '<div class="pagination" style="text-align: center; margin-top: 20px;">';
                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i == $pagina) {
                        echo '<strong>' . $i . '</strong> ';
                    } else {
                        echo '<a href="?page=' . $i . '">' . $i . '</a> ';
                    }
                }
                echo '</div>';
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        ?>
    </body>
    </html>