<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['setor_localidade'])) {
            $localidades = $_POST['localidade'];
            $setor = $_POST['setor_localidade'];

            $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $stmt = $db->prepare('INSERT INTO "reg_localidades" (localidade_nome, id_setor) VALUES (:localidades, :setor)');
            $stmt->bindValue(':localidades', $localidades, SQLITE3_TEXT);
            $stmt->bindValue(':setor', $setor, SQLITE3_TEXT);
            $stmt->execute();

            // Close the connection
            $db->close();
            
            // Redirecionar para página principal
            header('Refresh: 0; URL=../conf_setor.php');
            exit();
        } else {
            header('Refresh: 0; URL=../conf_setor.php');
        }
    } else {
        header('Refresh: 0; URL=../conf_setor.php');
    }
?>