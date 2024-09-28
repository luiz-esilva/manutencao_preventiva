<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['computador'], $_POST['tecnico'], $_POST['data_realizado'])) {

            $computador = $_POST['computador'];
            $tecnico = $_POST['tecnico'];
            $imagem_antes = $_FILES['imagem_antes'];
            $imagem_patrimonio = $_FILES['imagem_patrimonio'];
            $data_realizado = $_POST['data_realizado'];
            $data_finalizado = $_POST['data_finalizado'];

            // Nome do Arquivo
            $nome_foto_antes = $imagem_antes['name'];
            $nome_foto_patrimonio = $imagem_patrimonio['name'];

            // Adicionando data e hora no nome do arquivo
            $data_hora_atual = date('d-m-Y-H-i-s');
            $novo_nome_antes = $data_hora_atual . '-' . $nome_foto_antes;
            $novo_nome_patrimonio = $data_hora_atual . '-' . $nome_foto_patrimonio;

            // Pasta onde o arquivo será salvo
            $upload_dir = '../imgs/preventiva/';

            // Caminho completo do arquivo
            $upload_file_antes = $upload_dir . basename($novo_nome_antes);
            $upload_file_patrimonio = $upload_dir . basename($novo_nome_patrimonio);

            // Mime types
            $mime_types = array('image/jpeg', 'image/png', 'image/gif', 'image/bmp');

            // Função para realizar o upload
            function fazerUpload($imagem, $novo_nome, $upload_file)
            {
                global $mime_types;

                if (in_array($imagem['type'], $mime_types)) {
                    if ($imagem['size'] != 0) {
                        if ($imagem['error'] == 0) {
                            if (move_uploaded_file($imagem['tmp_name'], $upload_file)) {
                                return $novo_nome;
                            } else {
                                echo 'Ocorreu um erro ao mover o arquivo.';
                            }
                        } else {
                            echo 'Ocorreu um erro ao enviar o arquivo.';
                        }
                    } else {
                        echo 'O arquivo está vazio.';
                    }
                } else {
                    echo 'Tipo de arquivo não permitido.';
                }

                return false;
            }

            // Realizar o upload das imagens
            $imagem_antes_salva = fazerUpload($imagem_antes, $novo_nome_antes, $upload_file_antes);
            $imagem_patrimonio_salva = fazerUpload($imagem_patrimonio, $novo_nome_patrimonio, $upload_file_patrimonio);

            // Se ambas as imagens foram salvas com sucesso, proceder com o armazenamento no banco de dados
            if ($imagem_antes_salva && $imagem_patrimonio_salva) {
                $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                $stmt = $db->prepare('INSERT INTO "reg_preventiva" (id_computadores, tecnico, imagem_antes, imagem_patrimonio, data_realizado, data_realizado_final) VALUES (:computador, :tecnico, :img_antes, :img_patrimonio, :data_realizado, :data_finalizado)');
                $stmt->bindValue(':computador', $computador, SQLITE3_TEXT);
                $stmt->bindValue(':tecnico', $tecnico, SQLITE3_TEXT);
                $stmt->bindValue(':img_antes', $imagem_antes_salva, SQLITE3_TEXT);
                $stmt->bindValue(':img_patrimonio', $imagem_patrimonio_salva, SQLITE3_TEXT);
                $stmt->bindValue(':data_realizado', $data_realizado, SQLITE3_TEXT);
                $stmt->bindValue(':data_finalizado', $data_finalizado, SQLITE3_TEXT);
                $stmt->execute();
                $stmt = $db->prepare("UPDATE reg_computadores SET data_ultimo_realizado = :data_realizado WHERE id_computadores = :computador");
                $stmt->bindValue(':data_realizado', $data_finalizado, SQLITE3_TEXT);
                $stmt->bindValue(':computador', $computador, SQLITE3_TEXT);
                $stmt->execute();
                $stmt = $db->prepare("UPDATE reg_computadores SET data_agendada = NULL, observacoes_agendamento = NULL, tecnico_agendou = NULL WHERE data_agendada IS NOT NULL AND id_computadores = :computador;");
                $stmt->bindValue(':computador', $computador, SQLITE3_TEXT);
                $stmt->execute();
                // Fechar a conexão
                $db->close();

                // Redirecionar para página principal
                header('Refresh: 0; URL=../preventivas_vencidas.php');
                exit();
            } else {
                echo 'Erro ao salvar as imagens.';
            }
        } else {
            //header('Refresh: 0; URL=../preventivas_vencidas.php');
            echo 'Faltou enviar arquivos';
        }
    } else {
        //header('Refresh: 0; URL=../preventivas_vencidas.php');
        echo 'Metodo incompatível';
    }
?>