<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manutenções Preventivas TI/HUA - Computadores</title>
        <link rel="stylesheet" href="css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
        <link rel="stylesheet" href="css/bootstrap-utilities.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>

        <!-- Modal Deletar Computador -->
        <div class='modal fade' id='modalDelComputador' tabindex='-1' aria-labelledby='modalDelComputadorLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='modalDelComputadorLabel'>Atenção</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        A exclusão deste computador será permanente !
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                        <button onclick='del_computador()' type='button' class='btn btn-dark' data-bs-toggle='modal' data-bs-target='#modalDelComputador'>Apagar Computador</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Adiciona o menu -->
        <?php
            include "./model/navbar.php";
        ?>

        <div class="container text-center">
            <div class="row">
                <h3>Adicionar um novo computador</h3>
            </div>
            <div class="row" style="margin-bottom: 5px;">
                <form action="./php_funcions/cad_computador.php" method="POST">
                    <div class="row" style="margin-bottom: 5px;">
                        <input class="form-control" type="text" placeholder="Nome do Computador" name="nome_computador" id="nome_computador" required>
                    </div>
                    <div class="row" style="margin-bottom: 5px;">
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
                    <div class="row" style="margin-bottom: 5px;">
                        <select class="form-select" name="periodicidade" id="periodicidade" required>
                            <option value="1">1 mês</option>
                            <option value="3">3 meses</option>
                            <option value="6">6 meses</option>
                            <option value="9">9 meses</option>
                            <option value="12">1 ano</option>
                        </select>
                    </div>
                    <div class="row">
                        <input class="btn btn-dark" type="submit" value="Adicionar Computador">
                    </div>
                </form>
            </div>
            <div class="row">
                <table class="table align-middle text-center table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Computador</th>
                            <th scope="col">Setor</th>
                            <th scope="col">Localidade</th>
                            <th scope="col">Periodicidade</th>
                            <th scope="col">Última Preventiva</th>
                            <th scope="col">Próxima Preventiva</th>
                            <!--<th scope="col">Deletar</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                            $dados = $db->query('SELECT c.id_computadores, c.computador, s.setor_nome, l.localidade_nome, c.periodo_limpeza, c.data_ultimo_realizado FROM reg_computadores c JOIN reg_localidades l ON c.id_localidade = l.id_localidade JOIN reg_setores s ON l.id_setor = s.id_setor;');
                            while ($row = $dados->fetchArray()) {
                                
                                echo "<tr>";
                                echo "<th scope='row'>$row[id_computadores]</th>";
                                echo "<td>$row[computador]</td>";
                                echo "<td>$row[setor_nome]</td>";
                                echo "<td>$row[localidade_nome]</td>";
                                if ($row['periodo_limpeza'] == '12') {
                                    echo "<td>1" . " ano" . "</td>";
                                } else {
                                    echo "<td>$row[periodo_limpeza]" . " meses" . "</td>";
                                }
                                if ($row['data_ultimo_realizado']) {
                                    $data_formatada = new DateTime($row['data_ultimo_realizado']);
                                    echo "<td>" . $data_formatada->format('d/m/Y - H:i') . "</td>";

                                    // Adiciona a quantidade de meses à data
                                    $data_formatada->add(new DateInterval('P' . $row['periodo_limpeza'] . 'M'));
                                    echo "<td>" . $data_formatada->format('d/m/Y - H:i') . "</td>";
                                } else {
                                    echo "<td>NUNCA REALIZADO</td>";
                                    echo "<td>NUNCA REALIZADO</td>";
                                }

                                //echo "<td><button onclick='chamarModal_DelComputador($row[id_computadores])' type='button' class='btn btn-dark' data-bs-toggle='modal' data-bs-target='#modalDelComputador'>Deletar</button></td>";
                                echo "</tr>";
                            }

                            // Close the connection
                            $db->close();
                        ?>
                    </tbody>
                </table>
                <div class="row">
                    <?php
                        $db = new SQLITE3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                        $dados = $db->query('SELECT COUNT(c.id_computadores) as num_computadores FROM reg_computadores c JOIN reg_localidades l ON c.id_localidade = l.id_localidade JOIN reg_setores s ON l.id_setor = s.id_setor;');
                        while ($row = $dados->fetchArray()) {
                            $numero_computadores = $row['num_computadores'];
                        }
                        echo "Computadores cadastrados: " . $numero_computadores;
                        $db->close();
                    ?>
                </div>
            </div>
        </div>

        <script src="js/jquery-3.5.1.slim.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap-4.5.2.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/deletar_computador.js"></script>
    </body>
</html>
