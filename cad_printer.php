<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenções Preventivas TI/HUA - Cadastro de Insumos de Impressoras</title>
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap-icons-1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/person.css">
</head>
    <body>
        <!-- Modal Receber Nobreak -->
        <div class='modal fade' id='modalNobreak' tabindex='-1' aria-labelledby='modalNobreakLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title fs-5' id='modalNobreakLabel'>Recebimento de Nobreak</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <form action="./php_funcions/receber_nobreak.php" method="POST" enctype="multipart/form-data">
                            <div class='modal-body'>
                                <div class="container-fluid">
                                    <div class="row" style="margin-bottom: 5px;">
                                        <input type="text" class="form-control" name="id_nobreak" id="id_nobreak" hidden>                        
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="status" style="padding-left: 4px;font-weight: 500;">Status Atual</label>
                                        <input type="text" class="form-control" name="status" id="status" disabled>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="nserie" style="padding-left: 4px;font-weight: 500;">Nº Série</label>
                                        <input type="text" class="form-control" name="nserie" id="nserie" disabled>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="npatrimonio" style="padding-left: 4px;font-weight: 500;">Nº Patrimonio</label>
                                        <input type="text" class="form-control" name="npatrimonio" id="npatrimonio" disabled>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="setor" style="padding-left: 4px;font-weight: 500;">Setor</label>
                                        <input type="text" class="form-control" name="nome_setor" id="setor" disabled>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="localidade" style="padding-left: 4px;font-weight: 500;">Localidade</label>
                                        <input type="text" class="form-control" name="nome_localidade" id="localidade" disabled>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <input type="text" class="form-control" name="data_recebimento" id="data_recebimento" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                                <button type='submit' class='btn btn-primary'>Receber</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>

        <!-- Adiciona o menu -->
        <?php
            include "./model/navbar.php";
        ?>

        <div class="container-fluid">
            <div class="card" style="margin-top: 15px;">
                <div class="card-header text-center">
                    Cadastro de Impressoras
                </div>
                <form action="./php_funcions/cad_printers.php" method="POST">
                    <div class="card-body">
                        <div class="container-fluid">
                            <p class="card-text">
                                <div class="row">
                                    <label for="nome_impressora">Impressora: </label>
                                    <input class="form-control" type="text" name="nome_impressora" id="nome_impressora" required>
                                    <label for="nserie">Nº de Série: </label>
                                    <input class="form-control" type="text" name="nserie" id="nserie" required>
                                    <label for="patrimonio">Nº de Patrimônio: </label>
                                    <input class="form-control" type="text" name="patrimonio" id="patrimonio" required>
                                    <label for="ip">Endereço de IP: </label>
                                    <input class="form-control" type="text" name="ip" id="ip">
                                    <label for="status">Status: </label>
                                    <select class="form-select" name="status" id="status" required>
                                        <option hidden>Selecione o Status</option>
                                        <option value="Em Operação">Em Operação</option>
                                        <option value="Aguardando retorno para o setor">Aguardando retorno para o setor</option>
                                        <option value="Com Defeito">Com Defeito</option>
                                        <option value="Em Manutenção (Centermaq)">Em Manutenção (Centermaq)</option>
                                        <option value="Aguardando Manutenção (Chamado Aberto)">Aguardando Manutenção (Chamado Aberto)</option>
                                        <option value="Reserva (Na Sala da TI)">Reserva (Na Sala da TI)</option>
                                    </select>
                                    <label for="localidade">Localidade: </label>
                                    <input class="form-control" list="datalistOptions" name="localidade" id="localidade" placeholder="Pesquisar código do setor / localidade">
                                    <datalist id="datalistOptions">
                                        <?php
                                            $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                            $result = $db->query('SELECT reg_localidades.id_localidade, reg_localidades.localidade_nome, reg_setores.setor_nome FROM reg_localidades INNER JOIN reg_setores ON reg_localidades.id_setor = reg_setores.id_setor;');

                                            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                                                echo '<option value="' . $row['id_localidade'] . '">' . $row['setor_nome'] . ' / ' . $row['localidade_nome'] . '</option>';
                                            }

                                            $db->close();
                                        ?>
                                    </datalist>
                                </div>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer text-body-secondary">
                        <div class="container-fluid">
                            <div class="row">
                                <input class="btn btn-dark" type="submit" value="Registrar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid" style="margin-top: 15px;">
            <div class="card">
                <div class="card-header text-center">
                    Estoque de Toners
                </div>
                <div class="card-body">
                    <table class="table table-hover align-middle text-center table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>IMPRESSORA</th>
                                <th>Nº DE SÉRIE</th>
                                <th>PATRIMÔNIO</th>
                                <th>ENDEREÇO DE IP</th>
                                <th>STATUS</th>
                                <th>SETOR</th>
                                <th>LOCALIDADE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                $dados = $db->query("SELECT id_impressora, nome_impressora, nserie, patrimonio, ip, status, localidade_nome, setor_nome FROM impressoras pt LEFT JOIN reg_localidades lo on lo.id_localidade = pt.id_localidade LEFT JOIN reg_setores se on se.id_setor = lo.id_setor;");
                                while ($row = $dados->fetchArray()) {
                                    echo "<tr>";
                                    echo "<td>$row[id_impressora]</td>";
                                    echo "<td>$row[nome_impressora]</td>";
                                    echo "<td>$row[nserie]</td>";
                                    echo "<td>$row[patrimonio]</td>";
                                    echo "<td>$row[ip]</td>";
                                    echo "<td>$row[status]</td>";
                                    echo "<td>$row[setor_nome]</td>";
                                    echo "<td>$row[localidade_nome]</td>";
                                    echo "</tr>";
                                }
                                
                                // Close the connection
                                $db->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="js/jquery-3.5.1.slim.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap-4.5.2.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>