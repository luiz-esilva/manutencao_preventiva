<?php
    if (!isset($_GET['id'])) {
        echo "Erro: ID do registro não encontrado.";
        exit;
    }

    $id = $_GET['id'];

    $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

    // Now delete the record from the database
    $db->query("DELETE FROM reg_localidades WHERE id_localidade = $id");

    $db->close();

    header('Refresh: 0; URL=../conf_setor.php');
?>