<?php  
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['id_descarte'])) {
            $id_descarte = $_POST['id_descarte'];
            $data_hoje = date('d/m/Y');
            
            // Evitar injeção de SQL usando prepared statements
            $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $stmt = $db->prepare("UPDATE descarte_material SET saida = '$data_hoje', status = 'MATERIAL DESCARTADO' WHERE id_descarte = '$id_descarte';");
            $stmt->execute();
        
            // Fechar a conexão com o banco de dados
            $db->close();

            
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