<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manutenções Preventivas TI/HUA - Descarte de Material</title>
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

        <div class="container-fluid">
            <div class="card" style="margin-top: 15px;">
                <div class="card-header text-center">
                    Descarte de Material
                </div>
                <form action="./php_funcions/descartematerial.php" method="POST">
                    <div class="card-body">
                        <div class="container-fluid">
                            <p class="card-text">
                                <div class="row" style="margin-bottom: 5px;">
                                    <label for="material">Material: </label>
                                    <input class="form-control" name="material" id="material" type="text" required>
                                </div>
                                <div class="row" style="margin-bottom: 5px;">
                                    <label for="patrimonio">Nº de Patrimônio: </label>
                                    <input class="form-control" name="patrimonio" id="patrimonio" type="text" required>
                                </div>
                                <div class="row" style="margin-bottom: 5px;">
                                    <label for="data_entrada_sucata">Data da entrada da Sucata: </label>
                                    <input class="form-control" type="date" name="data_entrada_sucata" id="data_entrada_sucata" required>
                                </div>
                                <div class="row" style="margin-bottom: 5px;">
                                    <label for="tecnico">Técnico: </label>
                                    <?php
                                        include "./model/equipe_tecnica.php";
                                    ?>
                                </div>
                                <div class="row" style="margin-bottom: 5px;">
                                    <label for="localidade">Localidade de retirada do material: </label>
                                    <input class="form-control" list="datalistOptions" name="localidade" id="localidade" placeholder="Pesquisar código do setor / localidade" required>
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
                                <div class="row" style="margin-bottom: 5px;">
                                    <label for="laudo_descarte">Laudo de Descarte: </label>
                                    <textarea class="form-control" type="text" name="laudo_descarte" id="laudo_descarte" cols="30" rows="5"></textarea>
                                </div>
                                <div class="row">
                                    <input class="btn btn-dark" type="submit" value="Registrar">
                                </div>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid" style="margin-top: 15px; margin-bottom: 15px;">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <p class="card-text">
                            <table id="reiniciar_totem" class="table table-hover align-middle text-center table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Material</th>
                                        <th scope="col">Patrimônio</th>
                                        <th scope="col">Entrada</th>
                                        <th scope="col">Saída</th>
                                        <th scope="col">Técnico</th>
                                        <th scope="col">Laudo</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Setor</th>
                                        <th scope="col">Localidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                        $dados = $db->query("SELECT dm.id_descarte, dm.material, dm.patrimonio, dm.entrada, dm.saida, dm.tecnico, dm.laudo, dm.status, lo.localidade_nome, se.setor_nome FROM descarte_material dm LEFT JOIN reg_localidades lo on lo.id_localidade = dm.id_localidade LEFT JOIN reg_setores se on se.id_setor = lo.id_setor;");
                                        while ($row = $dados->fetchArray()) {
                                            echo "<tr>";
                                            $id_descarte = $row['id_descarte'];
                                            echo "<td>$row[id_descarte]</td>";
                                            echo "<td>$row[material]</td>";
                                            echo "<td>$row[patrimonio]</td>";
                                            $data_entrada_formatada = new DateTime($row['entrada']);
                                            echo "<td>" . $data_entrada_formatada->format('d/m/Y') . "</td>";
                                            if (!$row['saida']) {
                                                echo "<td><form action='./php_funcions/descartar.php' method='POST'><button type='submit' class='botao_personalizado' name='id_descarte' value='$id_descarte'><img src='bootstrap-icons-1.11.2/box-arrow-right.svg' width='30' height='30'></button></form></td>";
                                            } else {
                                                echo "<td>$row[saida]</td>";
                                            }
                                            echo "<td>$row[tecnico]</td>";
                                            echo "<td>$row[laudo]</td>";
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