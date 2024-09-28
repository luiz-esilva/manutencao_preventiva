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
    <link href="css/datatables.min.css" rel="stylesheet">
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

        <div class="container-fluid" style="margin-left: 10px;">
            <div class="row text-center">
                <div class="row">
                    <h3 class="text-center">Preventivas Agendadas</h3>
                    <table id="prev_vencida" class="table table-hover align-middle text-center table-bordered table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Computador</th>
                                <th scope="col">Setor</th>
                                <th scope="col">Localidade</th>
                                <th scope="col">Agendado Por</th>
                                <th scope="col">Agendado Para</th>
                                <th scope="col">Observações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                $dados = $db->query("SELECT rc.computador, st.setor_nome, lo.localidade_nome, rc.data_agendada, rc.observacoes_agendamento, rc.tecnico_agendou FROM reg_computadores rc LEFT JOIN reg_localidades lo on lo.id_localidade = rc.id_localidade LEFT JOIN reg_setores st on st.id_setor = lo.id_setor WHERE rc.data_agendada IS NOT NULL;");
                                while ($row = $dados->fetchArray()) {
                                    echo "<tr>";
                                    echo "<td>$row[computador]</th>";
                                    echo "<td>$row[setor_nome]</td>";
                                    echo "<td>$row[localidade_nome]</td>";
                                    echo "<td>$row[tecnico_agendou]</td>";
                                    $data_formatada = new DateTime($row['data_agendada']);
                                    echo "<td>" . $data_formatada->format('d/m/Y - H:i') . "</td>";
                                    echo "<td>$row[observacoes_agendamento]</td>";
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
        <script src="js/datatables.min.js"></script>
        <script>
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
            order: [[4, 'desc']],
                dom: '<f>rt<"bottom"p><"clear">',
                lengthMenu: [ [15], [15] ]
            });     
    </script>
    </body>
</html>