<?php
    if (!isset($_GET['id'])) {
        echo "Erro: ID do registro não encontrado.";
        exit;
    }

    $id = $_GET['id'];

    $db = new SQLite3('db_solicitacoes.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

    // Prepare a SELECT query to get the filename of the image
    $stmt = $db->prepare('SELECT imagem FROM test_drum WHERE id = :id');
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

    // Execute the query and get the result
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);

    // Check if an image filename was found
    if ($row && isset($row['imagem'])) {
        // Delete the image file from the disk
        unlink('./imgs/' . $row['imagem']);
    }

    // Now delete the record from the database
    $db->query("DELETE FROM test_drum WHERE id = $id");

    $db->close();

    header("Location: index.php"); // Redireciona para a página original com mensagem
?>