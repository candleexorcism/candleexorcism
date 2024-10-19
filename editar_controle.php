<?php

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        
    }
    
    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
        
    }

if (isset($_POST['minutos']) && isset($_POST['segundos'])) {
    $minutos = (int)$_POST['minutos'];
    $segundos = (int)$_POST['segundos'];    
    $tempoatingido = ($minutos * 60) + $segundos;

}else {
    $tempoatingido = null;
}
    
    try {
        $conn = new PDO("pgsql:host=localhost;port=5432;dbname=candleexorcism", "postgres", "pgadmin");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(!empty($nome)){
            $stmt = $conn->prepare("UPDATE usuario SET nome = :nome WHERE id = :id");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
    }
            if($tempoatingido !== null){
            $stmt = $conn->prepare("UPDATE usuario SET tempo_atingido = :tempo_atingido WHERE id = :id");
            $stmt->bindParam(':tempo_atingido', $tempoatingido);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            }
            header("Location: editar.php?id=$id");
            exit();
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
?>
