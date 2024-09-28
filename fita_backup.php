<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenções Preventivas TI/HUA - Fita de Backup</title>
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
                Registro das Trocas da Fita de Backup
            </div>
            <form action="./php_funcions/conferefita.php" method="POST">
                <div class="card-body">
                    <div class="container">
                        <p class="card-text">
                            <div class="row">
                                <label for="datahora">Data e Hora: </label>
                                <input class="form-control" type="datetime-local" name="datahora" id="datahora" required>
                            </div>
                            <div class="row">
                                <label for="tecnicos">Técnico: </label>
                                <?php
                                    include "./model/equipe_tecnica_s.php";
                                ?>
                            </div>
                            <div class="row">
                                <label for="temperatura_ar">Temperatura do Ar Condicionado: </label>
                                <input class="form-control" type="number" name="temperatura_ar" id="temperatura_ar" required>
                            </div>
                            <div class="row">
                                <label for="observacoes">Observações: </label>
                                <textarea class="form-control" name="observacoes" id="observacoes" cols="30" rows="5"></textarea>
                            </div>
                        </p>
                    </div>
                </div>
                <div class="card-footer text-body-secondary">
                    <div class="container">
                        <div class="row">
                            <input class="btn btn-dark" type="submit" value="Registrar">
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
                        <table id="chk_fita" class="table table-hover align-middle text-center table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Horario</th>
                                    <th scope="col">Técnico</th>
                                    <th scope="col">Ar Condicionado</th>
                                    <th scope="col">Observações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                    $dados = $db->query("SELECT * FROM chk_fita;");
                                    while ($row = $dados->fetchArray()) {
                                        echo "<tr>";
                                        echo "<td>$row[id_fita]</th>";
                                        // Formatando data e hora
                                        $data_formatada = new DateTime($row['datahora']);
                                        echo "<td>" . $data_formatada->format('d/m/Y - H:i') . "</td>";
                                        echo "<td>$row[tecnico]</td>";
                                        echo "<td>$row[temperatura_ar]</td>";
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
        new DataTable('#chk_fita', {
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
