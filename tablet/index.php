<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = $_POST['data'];
        $setor = $_POST['setor'];
        $localizacao = $_POST['localizacao'];
        $porcentagem_drum = $_POST['porcentagem_drum'];
        $imagem = $_FILES['imagem'];

        $nome_arquivo = $imagem['name'];
        $data_hora_atual = date('d-m-Y-H-i-s');
        $novo_nome_arquivo = $data_hora_atual . '-' . $nome_arquivo;

        // Pasta onde o arquivo será salvo
        $upload_dir = 'imgs/';

        // Nome do arquivo
        $upload_file = $upload_dir . basename($imagem['name']);

        // Mime types
        $mime_types = array('image/jpeg', 'image/png', 'image/gif', 'image/bmp');

        // Verifica se o arquivo tem algum dos tipos MIME acima
        if (in_array($imagem['type'], $mime_types)) {
            // Verifica se o arquivo está vazio
            if ($imagem['size'] != 0) {
                // Verifica se houve algum erro com o upload
                if ($imagem['error'] == 0) {
                    // Tenta mover o arquivo do diretório temporário para o diretório especificado
                    if (move_uploaded_file($imagem['tmp_name'], './imgs/' . $novo_nome_arquivo)) {
                        // Armazena a imagem no banco de dados
                        $db = new SQLite3('./db_folder/db_solicitacoes.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                        $stmt = $db->prepare('INSERT INTO "test_drum" (data, setor, localidade, porcentagem_drum, imagem) VALUES (:data, :setor, :localidade, :porcentagem_drum, :imagem)');
                        $stmt->bindValue(':data', $data, SQLITE3_TEXT);
                        $stmt->bindValue(':setor', $setor, SQLITE3_TEXT);
                        $stmt->bindValue(':localidade', $localizacao, SQLITE3_TEXT);
                        $stmt->bindValue(':porcentagem_drum', $porcentagem_drum, SQLITE3_INTEGER);
                        $stmt->bindValue(':imagem', $novo_nome_arquivo, SQLITE3_TEXT);
                        $stmt->execute();

                        // Close the connection
                        $db->close();
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
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitações TI/HUA - Teste de Drums</title>
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid text-center">
        
        <form method="POST" enctype="multipart/form-data">
            <div class="row" style="min-width: 668px; margin-bottom: 15px;">
                <h3 style="margin: 15px 0px 15px 0px;">Solicitações TI/HUA - Teste de Drums</h3>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="data" class="form-label">Data do Teste</label>
                        <input type="date" class="form-control" id="data" name="data" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" placeholder="Setor" class="form-control" id="setor" name="setor" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" placeholder="Localidade" class="form-control" id="localizacao" name="localizacao" required>
                    </div>
                    <div class="mb-3">
                        <label for="porcentagem_drum" class="form-label">Porcentagem Drum: <output id="value_porcentagemdrum"></output></label>
                        <input type="range" class="form-control" min="0" max="100" value="0" id="porcentagem_drum" name="porcentagem_drum" required>
                        <span id="value_porcentagemdrum"></span>
                    </div>
                    <div class="mb-3">
                        <input type="file" class="form-control" name="imagem" accept="image/*" capture="camera" id="imagem" name="imagem" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>

        <table class="table align-middle text-center table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">DATA TESTE</th>
                    <th scope="col">SETOR</th>
                    <th scope="col">LOCALIZAÇÃO</th>
                    <th scope="col">PORCENTAGEM DRUM</th>
                    <th scope="col">IMAGEM</th>
                    <th scope="col">DELETAR</th>
                </tr>
            </thead>

            <!-- Modal -->
            <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Atenção</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        A exclusão deste item será permanente !
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                        <button onclick='deletarRegistro()' type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>Apagar Registro</button>
                    </div>
                    </div>
                </div>
            </div>

            <?php
                $db = new SQLite3('./db_folder/db_solicitacoes.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                $dados = $db->query('SELECT id, data, setor, localidade, porcentagem_drum, imagem FROM "test_drum"');
                while ($row = $dados->fetchArray()) {
                    echo "<tbody>";
                    echo "<tr>";
                    echo "<th scope='row'>$row[id]</th>";
                    echo "<td>".date('d/m/Y', strtotime($row['data']))."</td>";
                    echo "<td>$row[setor]</td>";
                    echo "<td>$row[localidade]</td>";
                    echo "<td>$row[porcentagem_drum]</td>";
                    echo "<td><img src='./imgs/".$row['imagem']."' width='100' height='100'></td>";
                    echo "<td><button onclick='chamarModal($row[id])' type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>Deletar</button></td>";
                    echo "</tr>";
                    echo "</tbody>";
                }

                // Close the connection
                $db->close();
            ?>
        </table>
        
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.esm.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/deletarRegistro_testdrum.js"></script>
    <script>
        const value = document.querySelector("#value_porcentagemdrum");
        const input = document.querySelector("#porcentagem_drum");
        value.textContent = input.value;
        input.addEventListener("input", (event) => {
            value.textContent = event.target.value;
        })
    </script>
</body>
</html>