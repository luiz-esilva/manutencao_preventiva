<?php
    if (!isset($_GET['id'])) {
        echo "Erro: ID do registro não encontrado.";
        exit;
    }

    $id = $_GET['id'];

    $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

    // Now delete the record from the database
    $db->query("DELETE FROM reg_computadores WHERE id_computadores = $id");

    $db->close();

    header('Refresh: 0; URL=../computador.php');
?>