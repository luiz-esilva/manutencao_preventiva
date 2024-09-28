<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenções Preventivas TI/HUA - Checar Sala</title>
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="/bootstrap-icons-1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/datatables.min.css" rel="stylesheet">
</head>
<body>
    <!-- Adiciona o menu -->
    <?php
        include "./model/navbar.php";
    ?>

    <!-- Modal Formulário -->
    <div class="modal modal-lg fade" id="modalCheck" tabindex="-1" aria-labelledby="modalCheckLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="./php_funcions/conferesala.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalCheckLabel">Checklist Sala de Manutenção</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="row">
                                    <div class="row">
                                        <label for="datahora">Data e Hora</label>
                                        <input class="form-control" type="datetime-local" name="datahora" id="datahora" required>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                        <label for="tecnico">Técnico</label>
                                        <?php
                                            include "./model/equipe_tecnica.php";
                                        ?>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                        <label for="foto_maleta">Imagem da Sala (Pós Organização)</label>
                                        <input class="form-control" type="file" name="foto_sala" id="foto_sala" required>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                        <label for="obs_sala">Observações</label>
                                        <input class="form-control" type="text" name="obs_sala" id="obs_sala" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                        <button type='submit' class='btn btn-primary'>Salvar Dados</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container text-center">
        <div class="row">
            <h3>Cronograma de Verificação</h3>
            <div>Diariamente no início do expediente</div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <button class="btn btn-dark" type="submit" data-bs-toggle='modal' data-bs-target='#modalCheck'>Checar Sala</button>
        </div>
        <div class="container text-center" style="margin-top: 10px;">
            <div class="row">
                <table id="checks_sala" class="table table-hover align-middle text-center table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">DATA</th>
                            <th scope="col">TÉCNICO</th>
                            <th scope="col">FOTO</th>
                            <th scope="col">OBSERVAÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                            $dados = $db->query("SELECT id_sala, datahora,  nome_tecnico, foto_sala, obs_sala FROM chk_sala;");
                            while ($row = $dados->fetchArray()) {
                                echo "<tr>";
                                echo "<td>$row[id_sala]</td>";
                                // Formatando data e hora
                                $data_formatada = new DateTime($row['datahora']);
                                echo "<td>" . $data_formatada->format('d/m/Y - H:i') . "</td>";
                                echo "<td>$row[nome_tecnico]</td>";
				                $caminho_imagem = $row['foto_sala'];
                                echo "<td><a href='./imgs/checar_sala/$caminho_imagem' target='_blank'><img src='./imgs/checar_sala/$row[foto_sala]' width='100' height='100'></a></td>";
                                echo "<td>$row[obs_sala]</td>";
                                echo "</tr>";
                            }
                            
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
        new DataTable('#checks_sala', {
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
	    order: [[0, 'desc']],
            dom: '<f>rt<"bottom"p><"clear">',
            lengthMenu: [ [15], [15] ]
        });     
    </script>
</body>
</html>
