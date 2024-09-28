<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['data_envio'], $_POST['tecnico'], $_POST['n_serie'], $_POST['localidade'], $_POST['problema_identificado'])) {
            $data_envio = $_POST['data_envio'];
            $tecnico_responsavel = $_POST['tecnico'];
            $n_patrimonio = $_POST['n_patrimonio'];
            $n_serie = $_POST['n_serie'];
            $localidade = $_POST['localidade'];
            $problema_identificado = $_POST['problema_identificado'];
            $status = "Em Manutenção";

            $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $stmt = $db->prepare('INSERT INTO "manutencao_nobreaks" (data_envio, tecnico_responsavel, n_patrimonio, n_serie, id_localidade, problema_identificado, status_nobreak) VALUES (:data_envio, :tecnico_responsavel, :n_patrimonio, :n_serie, :id_localidade, :problema_identificado, :status_nobreak)');
            if (!$stmt) {
                echo 'Erro ao preparar instrução: '. $db->lastErrorMsg();
                exit();
            }
            $stmt->bindValue(':data_envio', $data_envio, SQLITE3_TEXT);
            $stmt->bindValue(':tecnico_responsavel', $tecnico_responsavel, SQLITE3_TEXT);
            $stmt->bindValue(':n_patrimonio', $n_patrimonio, SQLITE3_TEXT);
            $stmt->bindValue(':n_serie', $n_serie, SQLITE3_TEXT);
            $stmt->bindValue(':id_localidade', $localidade, SQLITE3_TEXT);
            $stmt->bindValue(':problema_identificado', $problema_identificado, SQLITE3_TEXT);
            $stmt->bindValue(':status_nobreak', $status, SQLITE3_TEXT);
            $result = $stmt->execute();
            if (!$result) {
                echo 'Erro ao executar instrução: '. $db->lastErrorMsg();
                exit();
            }

            // Close the connection
            $db->close();
            
            // Redirecionar para página principal
            header('Refresh: 0; URL=../controle_nobreak.php');
            exit();
        } else {
            echo "Faltou informações para enviar ao banco.";
            header('Refresh: 2; URL=../controle_nobreak.php');
            exit();
        }
    } else {
        echo "Método não aguardado.";
        header('Refresh: 2; URL=../controle_nobreak.php');
        exit();
    }
?>