<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenções Preventivas TI/HUA - Reiniciar Totem</title>
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/datatables.min.css" rel="stylesheet">
</head>
<body>
    <!-- Adiciona o menu -->
    <?php
        include "./model/navbar.php";
    ?>

    <div class="container">
        <div class="card" style="margin-top: 15px;">
            <div class="card-header text-center">
                Reiniciar Totem
            </div>
            <form action="./php_funcions/conferetotem.php" method="POST">
                <div class="card-body">
                    <div class="container">
                        <p class="card-text">
                            <div class="row" style="margin-bottom: 5px;">
                                <label for="datahora_restart">Data e Hora: </label>
                                <input class="form-control" type="datetime-local" name="datahora_restart" id="datahora_restart" required>
                            </div>
                            <div class="row" style="margin-bottom: 5px;">
                                <label for="tecnicos">Técnico: </label>
                                <?php
                                    include "./model/equipe_tecnica_s.php";
                                ?>
                            </div>
                            <div class="row" style="margin-bottom: 5px;">
                                <label for="observacoes_totem">Observações: </label>
                                <textarea class="form-control" type="text" name="observacoes_totem" id="observacoes_totem" cols="30" rows="5"></textarea>
                            </div>
			    <div class="row">
				<input class="btn btn-dark" type="submit" value="Registrar">
			    </div>
                        </p>
                    </div>
                </div>
                <div class="card-footer text-body-secondary">
                    <div class="container">
                        <div class="row">
			    <div class="text-center">Realizar ação preferencialmente toda Quinta Feira as 08:00</div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container" style="margin-top: 15px;">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <p class="card-text">
                        <table id="reiniciar_totem" class="table table-hover align-middle text-center table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Horario</th>
                                    <th scope="col">Técnico</th>
                                    <th scope="col">Observações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                    $dados = $db->query("SELECT * FROM chk_totem;");
                                    while ($row = $dados->fetchArray()) {
                                        echo "<tr>";
                                        echo "<td>$row[id_totem]</th>";
                                        // Formatando data e hora
                                        $data_formatada = new DateTime($row['datahora_restart']);
                                        echo "<td>" . $data_formatada->format('d/m/Y - H:i') . "</td>";
                                        echo "<td>$row[tecnico]</td>";
                                        echo "<td>$row[observacoes]</td>";
                                        echo "</tr>";
                                    }

                                    // Close the connection
                                    $db->close();
                                ?>
                            </tbody>
                        </table>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.5.2.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/datatables.min.js"></script>
    <script>
        new DataTable('#reiniciar_totem', {
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
