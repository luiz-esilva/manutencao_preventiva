<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verificar se a chave "setor" está definida no array $_POST
        if (isset($_POST['setor'])) {
            $setor = $_POST['setor'];

            // Evitar injeção de SQL usando prepared statements
            $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $stmt = $db->prepare('INSERT INTO "reg_setores" (setor_nome) VALUES (:setor)');
            $stmt->bindValue(':setor', $setor, SQLITE3_TEXT);
            $stmt->execute();
        
            // Fechar a conexão com o banco de dados
            $db->close();
            
            // Redirecionar para a página principal após a inserção no banco de dados
            header('Refresh: 0; URL=../conf_setor.php');
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