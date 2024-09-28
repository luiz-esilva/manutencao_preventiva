<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar se a chave "setor" está definida no array $_POST
    if (isset($_POST['id_toner_novo'], $_POST['id_toner_receb'], $_POST['tecnico'], $_POST['data_recebimento'])) {
        $id_tipo_toner = $_POST['id_toner_receb'];
        $identificacao_toner = $_POST['id_toner_novo'];
        $tecnico = $_POST['tecnico'];
        $dt_entrada = $_POST['data_recebimento'];

        // Evitar injeção de SQL usando prepared statements
        $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        try {
            // Verificar se o registro já existe
            $checkStmt = $db->prepare('SELECT COUNT(*) as count FROM "mov_toner" WHERE id_mov_toner = :id_mov_toner');
            $checkStmt->bindValue(':id_mov_toner', $identificacao_toner, SQLITE3_TEXT);
            $checkResult = $checkStmt->execute();
            $row = $checkResult->fetchArray(SQLITE3_ASSOC);

            if ($row['count'] > 0) {
                // Registro já existe, lidar com isso de alguma maneira
                echo 'Erro: O ID do toner informado já existe registrado no sistema, por favor verifique se inseriu corretamente.';
            } else {
                // Inserir o novo registro
                $stmt = $db->prepare('INSERT INTO "mov_toner" (id_mov_toner, movimentacao, tecnico, dt_entrada, status, id_toner) VALUES (:id_mov_toner, :movimentacao, :tecnico, :dt_entrada, :status, :id_toner)');
                $stmt->bindValue(':id_mov_toner', $identificacao_toner, SQLITE3_TEXT);
                $stmt->bindValue(':movimentacao', "Entrada", SQLITE3_TEXT);
                $stmt->bindValue(':tecnico', $tecnico, SQLITE3_TEXT);
                $stmt->bindValue(':dt_entrada', $dt_entrada, SQLITE3_TEXT);
                $stmt->bindValue(':status', "Em Estoque", SQLITE3_TEXT);
                $stmt->bindValue(':id_toner', $id_tipo_toner, SQLITE3_TEXT);
                $stmt->execute();

                // Redirecionar para a página principal após a inserção no banco de dados
                header('Refresh: 0; URL=../estoque_printers.php');
                exit(); // Certificar-se de que nenhum código adicional seja executado após o redirecionamento
            }
        } catch (Exception $e) {
            echo 'Erro ao inserir no banco de dados: ', $e->getMessage();
        }

        // Fechar a conexão com o banco de dados
        $db->close();
    } else {
        header('Refresh: 3; URL=../estoque_printers.php');
        echo "Erro: Você precisa selecionar um técnico para continuar. Tente novamente em 3 segundos.";
        exit();
    }
} else {
    header('Refresh: 2; URL=../estoque_printers.php');
    echo "Erro: Método de requisição inválido.";
    exit();
}
?>