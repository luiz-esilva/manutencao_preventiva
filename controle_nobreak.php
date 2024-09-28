<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenções Preventivas TI/HUA - Registro de Manutenção de Nobreaks</title>
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
                Registro de Manutenção de Nobreaks
            </div>
            <form action="./php_funcions/cad_nobreak.php" method="POST">
                <div class="card-body">
                    <div class="container-fluid">
                        <p class="card-text">
                            <div class="row">
                                <label for="data_envio">Data de Envio para Manutenção: </label>
                                <input class="form-control" type="date" name="data_envio" id="data_envio" required>
                            </div>
                            <div class="row">
                                <label for="tecnico_responsavel">Técnico Responsável: </label>
                                <?php
                                    include "./model/equipe_tecnica.php";
                                ?>
                            </div>
                            <div class="row">
                                <label for="n_patrimonio">Nº do Patrimônio: </label>
                                <input class="form-control" type="number" name="n_patrimonio" id="n_patrimonio">
                            </div>
                            <div class="row">
                                <label for="n_serie">Nº de Série: </label>
                                <input class="form-control" type="text" name="n_serie" id="n_serie" required>
                            </div>
                            <div class="row" style="margin-bottom: 5px;">
                                <label for="localidade">Setor e localidade: </label>
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
                            <div class="row">
                                <label for="problema_identificado">Problema identificado: </label>
                                <textarea class="form-control" name="problema_identificado" id="problema_identificado" cols="30" rows="5" required></textarea>
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
                Nobreaks Enviados para Manutenção Externa
            </div>
            <div class="card-body">
                <table class="table table-hover align-middle text-center table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TÉCNICO</th>
                            <th>DATA ENVIO</th>
                            <th>DATA RECEBIDO</th>
                            <th>STATUS</th>
                            <th>Nº SÉRIE</th>
                            <th>Nº PATRIMONIO</th>
                            <th>PROBLEMA IDENTIFICADO</th>
                            <th>SETOR</th>
                            <th>LOCALIDADE</th>
                            <th>RECEBER</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                            $dados = $db->query("SELECT mn.id_nobreak as 'id_nobreak', mn.tecnico_responsavel as 'tecnico_responsavel', mn.data_envio as 'data_envio', mn.data_recebimento as 'data_recebimento', mn.status_nobreak as 'status_nobreak', mn.problema_identificado as 'problema_identificado', mn.n_serie as 'n_serie', mn.n_patrimonio as 'n_patrimonio', lo.localidade_nome as 'nome_localidade', st.setor_nome as 'nome_setor' FROM manutencao_nobreaks mn LEFT JOIN reg_localidades lo on lo.id_localidade = mn.id_localidade LEFT JOIN reg_setores st on st.id_setor = lo.id_setor;");
                            while ($row = $dados->fetchArray()) {
                                echo "<tr>";
                                $id_nobreak = $row['id_nobreak'];
                                echo "<td>$id_nobreak</th>";
                                echo "<td>$row[tecnico_responsavel]</th>";
                                $data_envio_formatada = new DateTime($row['data_envio']);
                                echo "<td>" . $data_envio_formatada->format('d/m/Y') . "</td>";
                                if ($row['data_recebimento']) {
                                    $data_recebimento_formatada = new DateTime($row['data_recebimento']);
                                    echo "<td>" . $data_recebimento_formatada->format('d/m/Y') . "</td>"; 
                                } else {
                                    echo "<td> - </td>";
                                }
                                $status = $row['status_nobreak'];
                                echo "<td>$status</td>";
                                $nserie = $row['n_serie'];
                                echo "<td>$nserie</td>";
                                $npatrimonio = $row['n_patrimonio'];
                                echo "<td>$npatrimonio</td>";
                                echo "<td>$row[problema_identificado]</td>";
                                $setor = $row['nome_setor'];
                                echo "<td>$setor</td>";
                                $localidade = $row['nome_localidade'];
                                echo "<td>$localidade</td>";
                                if ($status == "Recebido") {
                                    echo "<td>-</td>";
                                } else {
                                    echo "<td><button class='botao_personalizado' onclick=\"chamarModal_inicia('$id_nobreak','$status','$nserie','$npatrimonio','$setor','$localidade')\" data-bs-toggle='modal' data-bs-target='#modalNobreak'><img src='bootstrap-icons-1.11.2/stop-btn-fill.svg' alt='Stop' width='32' height='32'></button></td>";
                                }
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
    <script>
        function chamarModal_inicia(id_nobreak, status, nserie, npatrimonio, setor, localidade) {
            // Defina o valor do computador selecionado no select do modal
            var input_idnobreak = document.getElementById('id_nobreak');
            var input_status = document.getElementById('status');
            var input_nserie = document.getElementById('nserie');
            var input_npatrimonio = document.getElementById('npatrimonio');
            var input_setor = document.getElementById('setor');
            var input_localidade = document.getElementById('localidade');

            input_idnobreak.value = id_nobreak;
            input_status.value = status;
            input_nserie.value = nserie;
            input_npatrimonio.value = npatrimonio;
            input_setor.value = setor;
            input_localidade.value = localidade;

            var input_data_recebimento = document.getElementById('data_recebimento');
            var data_atual = new Date();

            // Formatar a data no formato "dd-mm-aaaa"
            var dia = data_atual.getDate().toString().padStart(2, '0');
            var mes = (data_atual.getMonth() + 1).toString().padStart(2, '0');
            var ano = data_atual.getFullYear();
            var data_formatada = dia + '-' + mes + '-' + ano;

            input_data_recebimento.value = data_formatada;
        }
    </script>
</body>
</html>
