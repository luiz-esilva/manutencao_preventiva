<?php  
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verificar se a chave "setor" está definida no array $_POST
        if (isset($_POST['material'], $_POST['patrimonio'], $_POST['data_entrada_sucata'], $_POST['tecnico'], $_POST['laudo_descarte'], $_POST['localidade'])) {
            $material = $_POST['material'];
            $patrimonio = $_POST['patrimonio'];
            $data_entrada = $_POST['data_entrada_sucata'];
            $tecnico = $_POST['tecnico'];
            $laudo_descarte = $_POST['laudo_descarte'];
            $localidade = $_POST['localidade'];
            
            // Evitar injeção de SQL usando prepared statements
            $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $stmt = $db->prepare('INSERT INTO "descarte_material" (material, patrimonio, entrada, tecnico, laudo, status, id_localidade) VALUES (:material, :patrimonio, :entrada, :tecnico, :laudo, :status, :localidade)');
            $stmt->bindValue(':material', $material, SQLITE3_TEXT);
            $stmt->bindValue(':patrimonio', $patrimonio, SQLITE3_TEXT);
            $stmt->bindValue(':entrada', $data_entrada, SQLITE3_TEXT);
            $stmt->bindValue(':tecnico', $tecnico, SQLITE3_TEXT);
            $stmt->bindValue('laudo', $laudo_descarte, SQLITE3_TEXT);
            $stmt->bindValue(':status', 'AGUARDANDO DOCUMENTAÇÃO', SQLITE3_TEXT);
            $stmt->bindValue(':localidade', $localidade, SQLITE3_TEXT);
            $stmt->execute();
        
            // Fechar a conexão com o banco de dados
            $db->close();

            // Redirecionar para a página principal após a inserção no banco de dados
            header('Refresh: 0; URL=../descarte_material.php');
            exit(); // Certificar-se de que nenhum código adicional seja executado após o redirecionamento
        } else {
            // A chave "setor" não está definida em $_POST
            echo "Erro: A chave 'setor' não está definida.";
        }
    } else {
        // O método da requisição não é POST
        echo "Erro: Método de requisição inválido.";
    }
?>
