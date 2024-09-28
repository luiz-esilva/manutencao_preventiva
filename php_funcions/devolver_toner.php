<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verificar se a chave "setor" está definida no array $_POST
        if (isset($_POST['id_toner_retorno'], $_POST['tecnico'])) {
            $id_toner_retorno = $_POST['id_toner_retorno'];
            $tecnico = $_POST['tecnico'];

            // Evitar injeção de SQL usando prepared statements
            $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $stmt = $db->prepare("UPDATE mov_toner SET status = 'Em Estoque', movimentacao = 'Entrada', tecnico = '$tecnico', dt_saida = NULL, cod_centermaq = NULL, dtped_centermaq = NULL WHERE id_mov_toner = '$id_toner_retorno';");
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