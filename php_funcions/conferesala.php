<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require '../vendor/autoload.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['tecnico'], $_POST['datahora'], $_POST['obs_sala'])) {
            $nome_tecnico = $_POST['tecnico'];
            $datahora = $_POST['datahora'];
            $foto_sala = $_FILES['foto_sala'];
            $obs_sala = $_POST['obs_sala'];
            // Nome do Arquivo
            $nome_fotosala = $foto_sala['name'];
            // Adicionando data e hora no nome do arquivo
            date_default_timezone_set('Etc/GMT+3');
            $data_hora_atual = date('d-m-Y-H-i-s');
            $novo_nome_fotosala = $data_hora_atual . '-' . $nome_fotosala;
            $data_hora_atual_db = date('d/m/Y H:i');
            // Pasta onde o arquivo será salvo
            $upload_dir = '../imgs/checar_sala/';
            // Caminho completo do arquivo
            $upload_foto_sala = $upload_dir . basename($novo_nome_fotosala);
            // Mime types
            $mime_types = array('image/jpeg', 'image/png', 'image/gif', 'image/bmp');
            // Função para realizar o upload
            function fazerUpload($imagem, $novo_nome, $upload_file) {
                global $mime_types;
                if (in_array($imagem['type'], $mime_types)) {
                    if ($imagem['size'] != 0) {
                        if ($imagem['error'] == 0) {
                            if (move_uploaded_file($imagem['tmp_name'], $upload_file)) {
                                return $novo_nome;
                            } else {
                                echo 'Ocorreu um erro ao mover o arquivo';
                            }
                        } else {
                            echo 'Ocorreu um erro ao enviar o arquivo';
                        }
                    } else {
                        echo 'O arquivo está vazio';
                    }
                } else {
                    echo 'Tipo de arquivo não permitido';
                }
                return false;
            }
            // Realizar o upload das imagens
            $foto_sala_salva = fazerUpload($foto_sala, $novo_nome_fotosala, $upload_foto_sala);

            // Se a imagem foi salva com sucesso, proceder com o armazenamento no banco de dados
            if ($foto_sala_salva) {
                $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                $stmt = $db->prepare('INSERT INTO "chk_sala" (datahora, nome_tecnico, foto_sala, obs_sala) VALUES (:datahora, :nome_tecnico, :foto_sala, :obs_sala)');
                $stmt->bindValue(':datahora', $datahora, SQLITE3_TEXT);
                $stmt->bindValue(':nome_tecnico', $nome_tecnico, SQLITE3_TEXT);
                $stmt->bindValue(':foto_sala', $foto_sala_salva, SQLITE3_TEXT);
                $stmt->bindValue(':obs_sala', $obs_sala, SQLITE3_TEXT);
                $stmt->execute();
                $db->close();

                // Redirecionar para a página anteior
                header('Refresh: 0; URL=../conferir_sala.php');
                exit();
            }
        } else {
            echo "Faltou enviar informações !";
            //echo "<br>Nome do Técnico: " . $_POST['nome_tecnico'] . "<br>Foto da Sala: " . $foto_sala_salva . "<br>Observacoes: " . $obs_sala;
        }
    } else {
        echo "Método incompatível !";
    }
?>
