<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verificar se a chave "setor" está definida no array $_POST
        if (isset($_POST['id_toner_usado'], $_POST['tecnico'], $_POST['impressora'], $_POST['data_uso'])) {
            $id_toner = $_POST['id_toner_usado'];
            $tecnico = $_POST['tecnico'];
            $impressora = $_POST['impressora'];
            $dt_entrada = $_POST['data_uso'];

            // Verifica se já existe um toner na impressora
            $consulta = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $resultado = $consulta->query("SELECT * FROM mov_toner WHERE id_impressora = '$impressora' AND status = 'Em Uso';");
            while ($row = $resultado->fetchArray(SQLITE3_ASSOC)) {
                if ($row) {
                    // Altera o toner atual da impressora para "A Solicitar"
                    $stmt = $consulta->prepare("UPDATE mov_toner SET status = 'A Solicitar', movimentacao = 'Saida', tecnico = '$tecnico', dt_entrada = '$dt_entrada' WHERE id_mov_toner = '$row[id_mov_toner]';");
                    $stmt->execute();
                }
            }
            $consulta->close();

            // Evitar injeção de SQL usando prepared statements
            $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $stmt = $db->prepare("UPDATE mov_toner SET id_impressora = '$impressora', tecnico = '$tecnico', status = 'Em Uso' WHERE id_mov_toner = '$id_toner';");
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