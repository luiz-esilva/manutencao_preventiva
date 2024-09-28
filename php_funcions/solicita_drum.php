<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verificar se a chave "setor" está definida no array $_POST
        if (isset($_POST['id_toner_usado_sol'], $_POST['tecnico'], $_POST['cod_centermaq'], $_POST['dt_pedido_sol'])) {
            $id_drum = $_POST['id_toner_usado_sol'];
            $tecnico = $_POST['tecnico'];
            $cod_centermaq = $_POST['cod_centermaq'];
            $dt_pedido = $_POST['dt_pedido_sol'];

            // Evitar injeção de SQL usando prepared statements
            $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $stmt = $db->prepare("UPDATE mov_unid_imagem SET status = 'Solicitado', tecnico = '$tecnico', cod_centermaq = '$cod_centermaq', dtped_centermaq = '$dt_pedido' WHERE id_mov_unidimagem = '$id_drum';");
            $stmt->execute();
        
            // Fechar a conexão com o banco de dados
            $db->close();
            
            // Redirecionar para a página principal após a inserção no banco de dados
            header('Refresh: 0; URL=../estoque_drum.php');
            exit(); // Certificar-se de que nenhum código adicional seja executado após o redirecionamento
        } else {
            header('Refresh: 3; URL=../estoque_drum.php');
            echo "Erro: Você precisa selecionar um técnico ou impressora para continuar. Tente novamente em 3 segundos.";
            exit();
            }
    } else {
        // O método da requisição não é POST
        echo "Erro: Método de requisição inválido.";
    }
?>