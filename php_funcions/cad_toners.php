<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verificar se a chave "setor" está definida no array $_POST
        if (isset($_POST['nome_toner'], $_POST['tipo_impressora'])) {
            $nome_toner = $_POST['nome_toner'];
            $tipo_toner = $_POST['tipo_impressora'];

            // Evitar injeção de SQL usando prepared statements
            $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $stmt = $db->prepare('INSERT INTO "toner" (nome_toner, tipo_impressora) VALUES (:nome_toner, :tipo_impressora)');
            $stmt->bindValue(':nome_toner', $nome_toner, SQLITE3_TEXT);
            $stmt->bindValue(':tipo_impressora', $tipo_toner, SQLITE3_TEXT);
            $stmt->execute();
        
            // Fechar a conexão com o banco de dados
            $db->close();
            
            // Redirecionar para a página principal após a inserção no banco de dados
            header('Refresh: 0; URL=../cad_insumos.php');
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