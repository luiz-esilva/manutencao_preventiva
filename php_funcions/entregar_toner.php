<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verificar se a chave "setor" está definida no array $_POST
        if (isset($_POST['id_drum_receb'], $_POST['tecnico'], $_POST['dt_saida'])) {
            $id_toner = $_POST['id_drum_receb'];
            $tecnico = $_POST['tecnico'];
            $dt_saida = $_POST['dt_saida'];

            // Evitar injeção de SQL usando prepared statements
            $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $stmt = $db->prepare("UPDATE mov_toner SET status = 'Entregue Centermaq', tecnico = '$tecnico', dt_saida = '$dt_saida' WHERE id_mov_toner = '$id_toner';");
            $stmt->execute();
        
            // Fechar a conexão com o banco de dados
            $db->close();
            
            // Redirecionar para a página principal após a inserção no banco de dados
            header('Refresh: 0; URL=../estoque_toner.php');
            exit(); // Certificar-se de que nenhum código adicional seja executado após o redirecionamento
        } else {
            header('Refresh: 3; URL=../estoque_toner.php');
            echo "Erro: Você precisa selecionar um técnico ou impressora para continuar. Tente novamente em 3 segundos.";
            exit();
            }
    } else {
        // O método da requisição não é POST
        echo "Erro: Método de requisição inválido.";
    }
?>