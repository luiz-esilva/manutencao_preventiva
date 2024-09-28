<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verificar se a chave "setor" está definida no array $_POST
        if (isset($_POST['nome_impressora'], $_POST['nserie'], $_POST['patrimonio'], $_POST['ip'], $_POST['status'], $_POST['localidade'])) {
            $nome_impressora = $_POST['nome_impressora'];
            $nserie = $_POST['nserie'];
            $patrimonio = $_POST['patrimonio'];
            $ip = $_POST['ip'];
            $status = $_POST['status'];
            $localidade = $_POST['localidade'];

            // Evitar injeção de SQL usando prepared statements
            $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $stmt = $db->prepare('INSERT INTO "impressoras" (nome_impressora, nserie, patrimonio, ip, status, id_localidade) VALUES (:nome_impressora, :nserie, :patrimonio, :ip, :status, :localidade)');
            $stmt->bindValue(':nome_impressora', $nome_impressora, SQLITE3_TEXT);
            $stmt->bindValue(':nserie', $nserie, SQLITE3_TEXT);
            $stmt->bindValue(':patrimonio', $patrimonio, SQLITE3_TEXT);
            $stmt->bindValue(':ip', $ip, SQLITE3_TEXT);
            $stmt->bindValue(':status', $status, SQLITE3_TEXT);
            $stmt->bindValue(':localidade', $localidade, SQLITE3_TEXT);
            $stmt->execute();
        
            // Fechar a conexão com o banco de dados
            $db->close();
            
            // Redirecionar para a página principal após a inserção no banco de dados
            header('Refresh: 0; URL=../cad_printer.php');
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