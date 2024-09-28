<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenções Preventivas TI/HUA - Preventivas Vencidas</title>
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap-icons-1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/person.css">
    <link href="css/datatables.min.css" rel="stylesheet">
</head>
<body>
    <!-- Iniciar Serviço -->
    <div class='modal fade' id='modalIniciarServico' tabindex='-1' aria-labelledby='modalIniciarServicoLabel' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered'>
            <form action="./php_funcions/iniciar_servico.php" method="POST" enctype="multipart/form-data">
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='modalIniciarServicoLabel'>Iniciando Manutenção Preventiva</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class="container-fluid">
                                <div class="row" style="margin-bottom: 5px;">
                                    <select class="form-select" name="computador" id="computador_modal" hidden>
                                        <?php
                                            $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                            $result = $db->query('SELECT id_computadores, computador FROM reg_computadores');
                                            
                                            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                                                echo '<option value="' . $row['id_computadores'] . '">' . $row['computador'] . '</option>';
                                            }
                                            
                                            $db->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="row" style="margin-bottom: 5px;">
                                    <label for="tecnico" style="padding-left: 4px;font-weight: 500;">Selecione o Técnico Responsável:</label>
                                    <?php
                                        include "./model/equipe_tecnica.php";
                                    ?>
                                </div>
                                <div class="row" style="margin-bottom: 5px;">
                                    <label for="imagem_antes" style="padding-left: 4px;font-weight: 500;">Foto Antes da Preventiva:</label>
                                    <input class="form-control" type="file" name="imagem_antes" id="imagem_antes" required>
                                </div>
                                <div class="row" style="margin-bottom: 5px;">
                                    <label for="imagem_patrimonio" style="padding-left: 4px;font-weight: 500;">Foto do Patrimônio:</label>
                                    <input class="form-control" type="file" name="imagem_patrimonio" id="imagem_patrimonio" required>
                                </div>
                                <div class="row" style="margin-bottom: 15px;">
                                    <label for="data_realizado" style="padding-left: 4px;font-weight: 500;">Data da Realização do Serviço:</label>
                                    <input class="form-control" type="datetime-local" name="data_realizado" required>
                                </div>
                                <div class="row" style="margin-bottom: 15px;">
                                    <label for="data_realizado_final" style="padding-left: 4px;font-weight: 500;">Data da Finalização do Serviço:</label>
                                    <input type="datetime-local" class="form-control" name="data_finalizado" id="data_realizado" required>
                                </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                        <button type='submit' class='btn btn-primary'>Executar Preventiva</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Agendamento -->
    <div class='modal fade' id='modalAgenda' tabindex='-1' aria-labelledby='modalIniciarServicoLabel' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered'>
            <form action="./php_funcions/cad_agenda.php" method="POST" enctype="multipart/form-data">
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='modalIniciarServicoLabel'>Agendamento</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class="container-fluid">
                            <div class="row" style="margin-bottom: 5px;">
                            <input class="form-control" type="text" name="id_computadores" id="id_computadores" hidden>
                                <label for="tecnico" style="padding-left: 4px;font-weight: 500;">Quem realizou o agendamento:</label>
                                <?php
                                    include "./model/equipe_tecnica.php";
                                ?>
                            </div>
                            <div class="row" style="margin-bottom: 15px;">
                                <label for="data_agendada" style="padding-left: 4px;font-weight: 500;">Data Agendada:</label>
                                <input class="form-control" type="datetime-local" name="data_agendada" required>
                            </div>
                            <div class="row" style="margin-bottom: 15px;">
                                <label for="observacoes" style="padding-left: 4px;font-weight: 500;">Observações:</label>
                                <input class="form-control" type="text" name="observacoes" required>
                            </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                        <button type='submit' class='btn btn-primary'>Agendar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Adiciona o menu -->
    <?php
        include "./model/navbar.php";
    ?>

    <div class="container-fluid">
        <div class="row text-center">
            <div class="row">
                <h3 class="text-center">Preventivas Vencidas</h3>
                <table id="prev_vencida" class="table table-hover align-middle text-center table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Computador</th>
                            <th scope="col">Setor</th>
                            <th scope="col">Localidade</th>
                            <th scope="col">Última Preventiva</th>
                            <th scope="col">Iniciar Preventiva</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                            $dados = $db->query("SELECT rc.id_computadores, rc.computador, rs.setor_nome, rl.localidade_nome, MIN(rc.data_ultimo_realizado) as data_ultimo_realizado, rc.periodo_limpeza FROM reg_computadores rc JOIN reg_localidades rl ON rc.id_localidade = rl.id_localidade JOIN reg_setores rs ON rl.id_setor = rs.id_setor LEFT JOIN reg_preventiva rp ON rc.id_computadores = rp.id_computadores WHERE rp.id_computadores IS NULL OR datetime(COALESCE(rc.data_ultimo_realizado, 'now'), '+' || rc.periodo_limpeza || ' months') < datetime('now') GROUP BY rc.computador, rs.setor_nome, rl.localidade_nome, rc.periodo_limpeza ORDER BY data_ultimo_realizado DESC;");
                            while ($row = $dados->fetchArray()) {
                                $nome_computador = $row['computador'];
                                $id_computador = $row['id_computadores'];
                                echo "<tr>";
                                echo "<td>$row[computador]</th>";
                                echo "<td>$row[setor_nome]</td>";
                                echo "<td>$row[localidade_nome]</td>";
                                // Verifica se a data da última preventiva é nula
                                if ($row['data_ultimo_realizado']) {
                                    $data_formatada = new DateTime($row['data_ultimo_realizado']);
                                    echo "<td>" . $data_formatada->format('d/m/Y - H:i') . "</td>";
                                } else {
                                    echo "<td> NUNCA REALIZADO </td>";
                                }
                                echo "<td><button class='botao_personalizado' onclick=\"chamarModal_inicia('$nome_computador')\" data-bs-toggle='modal' data-bs-target='#modalIniciarServico'><img src='bootstrap-icons-1.11.2/play-btn-fill.svg' alt='Play' width='32' height='32'></button> / <button class='botao_personalizado' onclick=\"chamarModal_agenda('$id_computador')\" data-bs-toggle='modal' data-bs-target='#modalAgenda'><img src='bootstrap-icons-1.11.2/calendar3.svg' alt='Calendar' width='32' height='25'></button></td>";
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
    <script src="js/iniciar_servico.js"></script>
    <script src="js/datatables.min.js"></script>
    <script>
        // Pega o elemento do campo data_realizado
        var dataRealizado = document.getElementById('data_realizado');

        // Obtém a data e hora atual
        var agora = new Date();

        // Calcula o deslocamento de tempo em milissegundos
        var deslocamento = agora.getTimezoneOffset() * 60 * -1000;

        // Adiciona o deslocamento de tempo à data e hora atual
        var dataLocal = new Date(agora.getTime() + deslocamento);

        // Define o valor do campo data_realizado como a data e hora local formatada
        dataRealizado.value = dataLocal.toISOString().slice(0, -8);

        new DataTable('#prev_vencida', {
            language: {
                info: 'Exibindo página _PAGE_ de _PAGES_ paginas, foram encontrados _MAX_ preventivas',
                infoEmpty: 'Nenhum dado encontrado',
                infoFiltered: '(filtrado _MAX_ total resultados)',
                lengthMenu: 'Exibir _MENU_ linhas por página',
                search: "Pesquisar:",
                zeroRecords: 'Sua busca não retornou nenhuma informação',
                paginate: {
                    first: "Primeiro",
                    last: "Último",
                    next: "Próximo",
                    previous: "Anterior"
                }
            },
            dom: '<f>rt<"bottom"p><"clear">',
            lengthMenu: [ [15], [15] ]
        });                   
    </script>
    <script>
        function chamarModal_agenda(nome_computador) {
            function alterartitulo() {
                document.getElementById("id_computadores").value = nome_computador;
            }
            setTimeout(alterartitulo, 200);
        }
    </script>
</body>
</html>
