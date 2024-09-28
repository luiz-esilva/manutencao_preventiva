<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenções Preventivas TI/HUA - Cadastro de Setores</title>
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

    <!-- Modal Setores -->
    <div class='modal fade' id='modalSetor' tabindex='-1' aria-labelledby='modalSetorLabel' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='modalSetorLabel'>Atenção</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    A exclusão deste setor será permanente !
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                    <button onclick='del_setor()' type='button' class='btn btn-dark' data-bs-toggle='modal' data-bs-target='#modalSetor'>Apagar Setor</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Localidades -->
    <div class='modal fade' id='modalLocalidades' tabindex='-1' aria-labelledby='modalLocalidadesLabel' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='modalLocalidadesLabel'>Atenção</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    A exclusão desta localidade será permanente !
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                    <button onclick='del_localidades()' type='button' class='btn btn-dark' data-bs-toggle='modal' data-bs-target='#modalLocalidades'>Apagar Localidade</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Adiciona o menu -->
    <?php
        include "./model/navbar.php";
    ?>

    <div class="container text-center">
        <!-- Texto inicial -->
        <div class="row">
            <div class="col-12">
                <h3>SETORES / LOCALIDADES</h3>
            </div>
        </div>
        <!-- Duas colunas contendo conteúdo do site -->
        <div class="row">
            <!-- Adicionar Setor -->
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <h3>Cadastro de Setores</h3>
                </div>
                <form method="POST" action="./php_funcions/cad_setor.php" enctype="multipart/form-data" style="padding: 0px 5px 0px 5px; margin-bottom: 10px;">
                    <div class="row" style="margin-bottom: 5px;">
                        <input class="form-control" type="text" placeholder="Setor" name="setor" id="setor" required>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-dark">Adicionar Setor</button>
                    </div>
                </form>
            </div>
            <!-- Adicionar Localidade -->
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <h3>Cadastro de Localidades</h3>
                </div>
                <form method="POST" action="./php_funcions/cad_localidades.php" enctype="multipart/form-data" style="padding: 0px 5px 0px 5px; margin-bottom: 10px;">
                    <div class="row" style="margin-bottom: 5px;">
                        <input class="form-control" type="text" placeholder="Localidade" name="localidade" id="localidade" required>
                    </div>
                    <div class="row">
                        <select class="form-select" name="setor_localidade" id="setor_localidade" style="margin-bottom: 5px;" required>
                            <option selected disabled value="selecione">Selecione um setor</option>
                            <?php
                                // Conexão com o banco de dados
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                // Consulta para buscar os setores
                                $result = $db->query('SELECT id_setor, setor_nome FROM reg_setores');

                                    

                                // Preencher o select com os dados dos setores
                                while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                                    echo '<option value="' . $row['id_setor'] . '">' . $row['setor_nome'] . '</option>';
                                }

                                // Close the connection
                                $db->close();
                            ?>
                        </select>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-dark" onclick="validar_adclocalidade()">Adicionar Localidade</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Duas colunas contendo as tabelas com resultados vindo do banco -->
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <h3>Setores cadastrados</h3>
                </div>
                <div class="row" style="padding: 0px 5px 0px 5px; margin-bottom: 10px;">
                    <table class="table align-middle text-center table-striped table-bordered table-sm">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Setor</th>
                                <th scope="col">Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                $dados = $db->query('SELECT id_setor, setor_nome FROM "reg_setores"');
                                while ($row = $dados->fetchArray()) {
                                    echo "<tr>";
                                    echo "<th scope='row'>$row[id_setor]</th>";
                                    echo "<td>$row[setor_nome]</td>";
                                    echo "<td><button onclick='chamarModal_setores($row[id_setor])' type='button' class='btn btn-dark' data-bs-toggle='modal' data-bs-target='#modalSetor'>Deletar</button></td>";
                                    echo "</tr>";
                                }

                                // Close the connection
                                $db->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <h3>Localidades cadastradas</h3>
                </div>
                <div class="row" style="padding: 0px 5px 0px 5px; margin-bottom: 10px;">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">   
                            <select class="form-select" name="setores" id="setores" style="margin-bottom: 5px;" required>
                                <option selected disabled value="selecione">Selecione um setor</option>
                                <?php
                                    // Conexão com o banco de dados
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                    // Consulta para buscar os setores
                                    $result = $db->query('SELECT id_setor, setor_nome FROM reg_setores');

                                    

                                    // Preencher o select com os dados dos setores
                                    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                                        echo '<option value="' . $row['id_setor'] . '">' . $row['setor_nome'] . '</option>';
                                    }

                                    // Close the connection
                                    $db->close();
                                ?>
                            </select>
                            <button type="submit" onclick="validar_busclocalidade()" class="btn btn-dark">Buscar</button>
                        </div>
                    </form>
                    <table class="table align-middle text-center table-striped table-bordered table-sm" style="margin-top: 12px;">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Setor</th>
                                <th scope="col">Localidade</th>
                                <th scope="col">Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    if (isset($_POST['setores'])) {
                                        $busca_setor = $_POST['setores'];
                                    
                                        $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                        $dados = $db->query("SELECT reg_localidades.id_localidade, reg_localidades.localidade_nome, reg_setores.setor_nome FROM reg_localidades INNER JOIN reg_setores ON reg_localidades.id_setor = reg_setores.id_setor WHERE reg_localidades.id_setor = $busca_setor;");
                                        while ($row = $dados->fetchArray()) {
                                            echo "<tr>";
                                            echo "<th scope='row'>$row[id_localidade]</th>";
                                            echo "<td>$row[localidade_nome]</td>";
                                            echo "<td>$row[setor_nome]</td>";
                                            echo "<td><button onclick='chamarModal_localidades($row[id_localidade])' type='button' class='btn btn-dark' data-bs-toggle='modal' data-bs-target='#modalLocalidades'>Deletar</button></td>";
                                            echo "</tr>";
                                        }
        
                                        // Close the connection
                                        $db->close();
                                    } else {
                                        $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                        $dados = $db->query("SELECT reg_localidades.id_localidade, reg_localidades.localidade_nome, reg_setores.setor_nome FROM reg_localidades INNER JOIN reg_setores ON reg_localidades.id_setor = reg_setores.id_setor;");
                                        while ($row = $dados->fetchArray()) {
                                            echo "<tr>";
                                            echo "<th scope='row'>$row[id_localidade]</th>";
                                            echo "<td>$row[localidade_nome]</td>";
                                            echo "<td>$row[setor_nome]</td>";
                                            echo "<td><button onclick='chamarModal_localidades($row[id_localidade])' type='button' class='btn btn-dark' data-bs-toggle='modal' data-bs-target='#modalLocalidades'>Deletar</button></td>";
                                            echo "</tr>";
                                        }
        
                                        // Close the connection
                                        $db->close();
                                    }
                                } else {
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                    $dados = $db->query("SELECT reg_localidades.id_localidade, reg_localidades.localidade_nome, reg_setores.setor_nome FROM reg_localidades INNER JOIN reg_setores ON reg_localidades.id_setor = reg_setores.id_setor;");
                                    while ($row = $dados->fetchArray()) {
                                        echo "<tr>";
                                        echo "<th scope='row'>$row[id_localidade]</th>";
                                        echo "<td>$row[localidade_nome]</td>";
                                        echo "<td>$row[setor_nome]</td>";
                                        echo "<td><button onclick='chamarModal_localidades($row[id_localidade])' type='button' class='btn btn-dark' data-bs-toggle='modal' data-bs-target='#modalLocalidades'>Deletar</button></td>";
                                        echo "</tr>";
                                    }
    
                                    // Close the connection
                                    $db->close();
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.5.2.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/deletar_localidade.js"></script>
    <script src="js/deletar_setor.js"></script>
    <script>
        function validar_adclocalidade() {
            var setorSelect = document.getElementById('setor_localidade');
            var selectedValue = setorSelect.options[setorSelect.selectedIndex].value;

            // Verificar se o valor selecionado é diferente do valor padrão
            if (selectedValue === 'selecione') {
                alert('Por favor, selecione um setor antes de adicionar a localidade.');
            } else {
                // Envie o formulário ou execute outras ações conforme necessário
                document.forms[0].submit(); // Isso assume que o seu formulário é o primeiro na página
            }
        }
    </script>
    <script>
        function validar_busclocalidade() {
            var setorSelect = document.getElementById('setores');
            var selectedValue = setorSelect.options[setorSelect.selectedIndex].value;

            // Verificar se o valor selecionado é diferente do valor padrão
            if (selectedValue === 'selecione') {
                alert('Por favor, selecione um setor antes de filtrar a localidade.');
            } else {
                // Envie o formulário ou execute outras ações conforme necessário
                document.forms[0].submit(); // Isso assume que o seu formulário é o primeiro na página
            }
        }
    </script>
</body>
</html>
