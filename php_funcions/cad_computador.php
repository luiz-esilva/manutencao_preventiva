<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['localidade'], $_POST['nome_computador'], $_POST['periodicidade'])) {
            $localidades = $_POST['localidade'];
            $computador = $_POST['nome_computador'];
            $periodicidade = $_POST['periodicidade'];

            $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $stmt = $db->prepare('INSERT INTO "reg_computadores" (computador, id_localidade, periodo_limpeza) VALUES (:computador, :localidade, :periodicidade)');
            $stmt->bindValue(':computador', $computador, SQLITE3_TEXT);
            $stmt->bindValue(':localidade', $localidades, SQLITE3_TEXT);
            $stmt->bindValue(':periodicidade', $periodicidade, SQLITE3_TEXT);
            $stmt->execute();

            // Close the connection
            $db->close();
            
            // Redirecionar para página principal
            header('Refresh: 0; URL=../computador.php');
            exit();
        } else {
            header('Refresh: 0; URL=../computador.php');
        }
    } else {
        header('Refresh: 0; URL=../computador.php');
    }
?>