<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['tecnico'])) {
            $tecnico = $_POST['tecnico'];
            $foto_maleta = $_FILES['foto_maleta'];
            
            // Verificar Checkbox
            if (isset($_POST['fita_duplaface'])) {
                $fita_duplaface = $_POST['fita_duplaface'];
            } else {
                $fita_duplaface = "NÃO SELECIONADO";
            }
            
            if (isset($_POST['fita_larga'])) {
                $fita_larga = $_POST['fita_larga']; 
            } else {
                $fita_larga = "NÃO SELECIONADO";
            }

            if (isset($_POST['rolo_velcro'])) {
                $rolo_velcro = $_POST['rolo_velcro'];
            } else {
                $rolo_velcro = "NÃO SELECIONADO";
            }

            if (isset($_POST['fita_hellerman'])) {
                $fita_hellerman = $_POST['fita_hellerman'];
            } else {
                $fita_hellerman = "NÃO SELECIONADO";
            }

            if (isset($_POST['spray_alcool'])) {
                $spray_alcool = $_POST['spray_alcool'];
            } else {
                $spray_alcool = "NÃO SELECIONADO";
            }

            if (isset($_POST['pano_limpo'])) {
                $pano_limpo = $_POST['pano_limpo'];
            } else {
                $pano_limpo = "NÃO SELECIONADO";
            }

            if (isset($_POST['keystone_bticino'])) {
                $keystone_bticino = $_POST['keystone_bticino'];
            } else {
                $keystone_bticino = "NÃO SELECIONADO";
            }

            if (isset($_POST['keystone_schneider'])) {
                $keystone_schneider = $_POST['keystone_schneider'];
            } else {
                $keystone_schneider = "NÃO SELECIONADO";
            }

            if (isset($_POST['pote_rj45'])) {
                $pote_rj45 = $_POST['pote_rj45'];
            } else {
                $pote_rj45 = "NÃO SELECIONADO";
            }

            if (isset($_POST['caneta_marcador'])) {
                $caneta_marcador = $_POST['caneta_marcador'];
            } else {
                $caneta_marcador = "NÃO SELECIONADO";
            }

            if (isset($_POST['caneta_comum'])) {
                $caneta_comum = $_POST['caneta_comum'];
            } else {
                $caneta_comum = "NÃO SELECIONADO";
            }

            if (isset($_POST['phillips_fina'])) {
                $phillips_fina = $_POST['phillips_fina'];
            } else {
                $phillips_fina = "NÃO SELECIONADO";
            }

            if (isset($_POST['phillips_finagrande'])) {
                $phillips_finagrande = $_POST['phillips_finagrande'];
            } else {
                $phillips_finagrande = "NÃO SELECIONADO";
            }

            if (isset($_POST['phillips_grossa'])) {
                $phillips_grossa = $_POST['phillips_grossa'];
            } else {
                $phillips_grossa = "NÃO SELECIONADO";
            }

            if (isset($_POST['tork_t10'])) {
                $tork_t10 = $_POST['tork_t10'];
            } else {
                $tork_t10 = "NÃO SELECIONADO";
            }

            if (isset($_POST['fenda_pequena'])) {
                $fenda_pequena = $_POST['fenda_pequena'];
            } else {
                $fenda_pequena = "NÃO SELECIONADO";
            }

            if (isset($_POST['teste_multimetro'])) {
                $teste_multimetro = $_POST['teste_multimetro'];
            } else {
                $teste_multimetro = "NÃO SELECIONADO";
            }

            if (isset($_POST['teste_cabos'])) {
                $teste_cabos = $_POST['teste_cabos'];
            } else {
                $teste_cabos = "NÃO SELECIONADO";
            }

            if (isset($_POST['patchcord'])) {
                $patchcord = $_POST['patchcord'];
            } else {
                $patchcord = "NÃO SELECIONADO";
            }

            if (isset($_POST['punchdown'])) {
                $punchdown = $_POST['punchdown'];
            } else {
                $punchdown = "NÃO SELECIONADO";
            }

            if (isset($_POST['alicate_crimpar'])) {
                $alicate_crimpar = $_POST['alicate_crimpar'];
            } else {
                $alicate_crimpar = "NÃO SELECIONADO";
            }

            if (isset($_POST['alicate_corte'])) {
                $alicate_corte = $_POST['alicate_corte'];
            } else {
                $alicate_corte = "NÃO SELECIONADO";
            }

            if (isset($_POST['tesoura'])) {
                $tesoura = $_POST['tesoura'];
            } else {
                $tesoura = "NÃO SELECIONADO";
            }

            if (isset($_POST['decapador_cabos'])) {
                $decapador_cabos = $_POST['decapador_cabos'];
            } else {
                $decapador_cabos = "NÃO SELECIONADO";
            }

            if (isset($_POST['estilete'])) {
                $estilete = $_POST['estilete'];
            } else {
                $estilete = "NÃO SELECIONADO";
            }

            if (isset($_POST['escova'])) {
                $escova = $_POST['escova'];
            } else {
                $escova = "NÃO SELECIONADO";
            }

            // Nome do Arquivo
            $nome_foto_maleta = $foto_maleta['name'];

            // Adicionando data e hora no nome do arquivo
            date_default_timezone_set('Etc/GMT+3');
            $data_hora_atual = date('d-m-Y-H-i-s');
            $novo_nome_foto_maleta = $data_hora_atual . '-' . $nome_foto_maleta;
            $data_hora_atual_db = date('d/m/Y H:i');

            // Pasta onde o arquivo será salvo
            $upload_dir = '../imgs/checar_maleta/';

            // Caminho completo do arquivo
            $upload_foto_maleta = $upload_dir . basename($novo_nome_foto_maleta);

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
            $foto_maleta_salva = fazerUpload($foto_maleta, $novo_nome_foto_maleta, $upload_foto_maleta);

            // Se a imagem foi salva com sucesso, proceder com o armazenamento no banco de dados
            if ($foto_maleta_salva) {
                $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                $stmt = $db->prepare('INSERT INTO "chk_maleta" (nome_tecnico, foto_maleta, data_hora, fita_duplaface, fita_larga, rolo_velcro, fita_hellerman, spray_alcool, pano_limpo, keystone_bticino, keystone_schneider, pote_rj45, caneta_marcador, caneta_comum, phillips_fina, phillips_finagrande, phillips_grossa, tork_t10, fenda_pequena, teste_multimetro, teste_cabos, patchcord, punchdown, alicate_crimpar, alicate_corte, tesoura, decapador_cabos, estilete, escova) VALUES (:nome_tecnico, :foto_maleta, :data_hora, :fita_duplaface, :fita_larga, :rolo_velcro, :fita_hellerman, :spray_alcool, :pano_limpo, :keystone_bticino, :keystone_schneider, :pote_rj45, :caneta_marcador, :caneta_comum, :phillips_fina, :phillips_finagrande, :phillips_grossa, :tork_t10, :fenda_pequena, :teste_multimetro, :teste_cabos, :patchcord, :punchdown, :alicate_crimpar, :alicate_corte, :tesoura, :decapador_cabos, :estilete, :escova)');
                $stmt->bindValue(':nome_tecnico', $tecnico, SQLITE3_TEXT);
                $stmt->bindValue(':foto_maleta', $foto_maleta_salva, SQLITE3_TEXT);
                $stmt->bindValue(':data_hora', $data_hora_atual_db, SQLITE3_TEXT);
                $stmt->bindValue(':fita_duplaface', $fita_duplaface, SQLITE3_TEXT);
                $stmt->bindValue(':fita_larga', $fita_larga, SQLITE3_TEXT);
                $stmt->bindValue(':rolo_velcro', $rolo_velcro, SQLITE3_TEXT);
                $stmt->bindValue(':fita_hellerman', $fita_hellerman, SQLITE3_TEXT);
                $stmt->bindValue(':spray_alcool', $spray_alcool, SQLITE3_TEXT);
                $stmt->bindValue(':pano_limpo', $pano_limpo, SQLITE3_TEXT);
                $stmt->bindValue(':keystone_bticino', $keystone_bticino, SQLITE3_TEXT);
                $stmt->bindValue(':keystone_schneider', $keystone_schneider, SQLITE3_TEXT);
                $stmt->bindValue(':pote_rj45', $pote_rj45, SQLITE3_TEXT);
                $stmt->bindValue(':caneta_marcador', $caneta_marcador, SQLITE3_TEXT);
                $stmt->bindValue(':caneta_comum', $caneta_comum, SQLITE3_TEXT);
                $stmt->bindValue(':phillips_fina', $phillips_fina, SQLITE3_TEXT);
                $stmt->bindValue(':phillips_finagrande', $phillips_finagrande, SQLITE3_TEXT);
                $stmt->bindValue(':phillips_grossa', $phillips_grossa, SQLITE3_TEXT);
                $stmt->bindValue(':tork_t10', $tork_t10, SQLITE3_TEXT);
                $stmt->bindValue(':fenda_pequena', $fenda_pequena, SQLITE3_TEXT);
                $stmt->bindValue(':teste_multimetro', $teste_multimetro, SQLITE3_TEXT);
                $stmt->bindValue(':teste_cabos', $teste_cabos, SQLITE3_TEXT);
                $stmt->bindValue(':patchcord', $patchcord, SQLITE3_TEXT);
                $stmt->bindValue(':punchdown', $punchdown, SQLITE3_TEXT);
                $stmt->bindValue(':alicate_crimpar', $alicate_crimpar, SQLITE3_TEXT);
                $stmt->bindValue(':alicate_corte', $alicate_corte, SQLITE3_TEXT);
                $stmt->bindValue(':tesoura', $tesoura, SQLITE3_TEXT);
                $stmt->bindValue(':decapador_cabos', $decapador_cabos, SQLITE3_TEXT);
                $stmt->bindValue(':estilete', $estilete, SQLITE3_TEXT);
                $stmt->bindValue(':escova', $escova, SQLITE3_TEXT);
                $stmt->execute();
                $db->close();

                // Redirecionar para a página anterior
                header('Refresh: 0; URL=../conferir_maleta.php');
                exit();
            }
        } else {
            echo "Faltou enviar informações !";
        }
    } else {
        echo "Método incompatível !";
    }
?>