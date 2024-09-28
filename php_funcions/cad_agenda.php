<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verificar se a chave "setor" está definida no array $_POST
        if (isset($_POST['id_computadores'], $_POST['tecnico'], $_POST['data_agendada'], $_POST['observacoes'])) {
            $id_computadores = $_POST['id_computadores'];
            $tecnico = $_POST['tecnico'];
            $data_agendada = $_POST['data_agendada'];
            $observacoes = $_POST['observacoes'];

            // Evitar injeção de SQL usando prepared statements
            $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $stmt = $db->prepare('UPDATE "reg_computadores" SET data_agendada = :data_agendada, observacoes_agendamento = :observacoes_agendamento, tecnico_agendou = :tecnico_agendou WHERE id_computadores = "'.$id_computadores.'";');
            $stmt->bindValue(':data_agendada', $data_agendada, SQLITE3_TEXT);
            $stmt->bindValue(':observacoes_agendamento', $observacoes, SQLITE3_TEXT);
            $stmt->bindValue(':tecnico_agendou', $tecnico, SQLITE3_TEXT);
            $stmt->execute();
        
            // Fechar a conexão com o banco de dados
            $db->close();
            
            // Redirecionar para a página principal após a inserção no banco de dados
            header('Refresh: 0; URL=../preventivas_vencidas.php');
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