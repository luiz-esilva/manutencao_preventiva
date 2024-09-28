<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['id_nobreak'], $_POST['data_recebimento'])) {
            $id_nobreak = $_POST['id_nobreak'];
            $data_recebimento = $_POST['data_recebimento'];
            $status_nobreak = "Recebido";
            
            $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $stmt = $db->prepare('UPDATE manutencao_nobreaks SET status_nobreak = :status_nobreak, data_recebimento = :data_recebimento WHERE id_nobreak = :id');
            $stmt->bindValue(':status_nobreak', $status_nobreak, SQLITE3_TEXT);
            $stmt->bindValue(':data_recebimento', $data_recebimento, SQLITE3_TEXT);
            $stmt->bindValue(':id', $id_nobreak, SQLITE3_TEXT);
            $stmt->execute();

            $db->close();

            header('Refresh: 0; URL=../controle_nobreak.php');
        } else {
            echo "Nenhum dado recebido";
        }
    }
?>