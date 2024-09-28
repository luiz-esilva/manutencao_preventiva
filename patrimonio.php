<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenções Preventivas TI/HUA - Preventivas Realizadas</title>
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap-icons-1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/person.css">
</head>
<body>
    <!-- Adiciona o menu -->
    <?php
        include "./model/navbar.php";
    ?>
    
    <div class="container-fluid">
        <div class="card" style="margin-top: 15px;">
            <div class="card-header text-center">
                Transferência de Patrimônio
            </div>
            <form action="./php_funcions/transferencia_patrimonio.php" method="POST">
                <div class="card-body">
                    <div class="container-fluid">
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
                                <label for="n_patrimonio">Nº do Patrimônio: </label>
                                <input class="form-control" type="number" name="n_patrimonio" id="n_patrimonio" required>
                            </div>
                            <div class="row" style="margin-bottom: 5px;">
                                <label for="localidade">Setor e localidade: </label>
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
                            <div class="row">
                                <label for="observacoes">Observações: </label>
                                <textarea class="form-control" name="observacoes" id="observacoes" cols="30" rows="5" required></textarea>
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
                <?php
                    $meses = array(
                        "01" => '<b>Janeiro</b>',
                        "02" => '<b>Fevereiro</b>',
                        "03" => '<b>Março</b>',
                        "04" => '<b>Abril</b>',
                        "05" => '<b>Maio</b>',
                        "06" => '<b>Junho</b>',
                        "07" => '<b>Julho</b>',
                        "08" => '<b>Agosto</b>',
                        "09" => '<b>Setembro</b>',
                        "10" => '<b>Outubro</b>',
                        "11" => '<b>Novembro</b>',
                        "12" => '<b>Dezembro</b>'
                      );

                    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                        $mesAtual = date('m');
                        $nomeMes = $meses[$mesAtual];
                        echo "Tranferências de patrimônio";
                    } 
                    
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (isset($_POST['mes_patrimonio'])) {
                            $mes_patrimonio = $_POST['mes_patrimonio'];
                            $mes_ano = explode(',', $mes_patrimonio);
                            $mes = "<b>" . $mes_ano[0] . "</b>";
                            $ano = "<b>" . $mes_ano[1] . "</b>";
                            echo "Transferências de patrimônio realizadas no mês de " . $mes . " de " . $ano;
                        }
                    }
                ?>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <form method="POST" style="display: flex;">
                      <select class="form-select" name="mes_patrimonio" id="mes_patrimonio">
                            <?php
                                function mes_portugues($mes_ingles) {
                                    $meses = array(
                                        "01" => "Janeiro",
                                        "02" => "Fevereiro",
                                        "03" => "Março",
                                        "04" => "Abril",
                                        "05" => "Maio",
                                        "06" => "Junho",
                                        "07" => "Julho",
                                        "08" => "Agosto",
                                        "09" => "Setembro",
                                        "10" => "Outubro",
                                        "11" => "Novembro",
                                        "12" => "Dezembro"
                                    );
                                    return $meses[$mes_ingles];
                                }

                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                
                                $result = $db->query('SELECT STRFTIME("%m / %Y", datahora) AS datahora_mes_ano FROM patrimonio GROUP BY datahora_mes_ano ORDER BY datahora_mes_ano ASC;');
                                
                                while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                                    // Formatando a data e hora no formato "MES / ANO"
                                    $mes = explode(' / ', $row['datahora_mes_ano']);
                                    $mes_format = mes_portugues($mes[0]);
                                    $ano_format = $mes[1];
                                    echo '<option value="' . $mes_format . ',' . $ano_format . '">' . $mes_format . ' / '  . $ano_format . '</option>';
                                }
                                
                                $db->close();
                            ?>
                        </select>
                        <input id="filtro_patrimonio" style="margin-left: 10px;" class="btn btn-dark" type="submit" value="Buscar">
                    </form>
                </div>
                <div class="container-fluid">
                    <form method="POST" action="./php_funcions/mail_custos.php">
                        <input class="btn btn-danger" value="Enviar e-mail" type="submit" style="width: 100%; margin-top: 10px;">
                    </form>
                </div>
                <div class="container-fluid">
                    <p class="card-text">
                        <table id="chk_fita" class="table table-hover align-middle text-center table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Horario</th>
                                    <th scope="col">Técnico</th>
                                    <th scope="col">Nº de Patrimônio</th>
                                    <th scope="col">Observações</th>
                                    <th scope="col">E-Mail</th>
                                    <th scope="col">Setor</th>
                                    <th scope="col">Localidade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

                                        $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                        $dados = $db->query("SELECT id_patrimonio, datahora, tecnico, n_patrimonio, observacoes, enviado, localidade_nome, setor_nome FROM patrimonio pt LEFT JOIN reg_localidades lo on lo.id_localidade = pt.id_localidade LEFT JOIN reg_setores se on se.id_setor = lo.id_setor WHERE pt.enviado = 'Não Enviado';");
                                        while ($row = $dados->fetchArray()) {
                                            echo "<tr>";
                                            echo "<td>$row[id_patrimonio]</th>";
                                            // Formatando data e hora
                                            $data_formatada = new DateTime($row['datahora']);
                                            echo "<td>" . $data_formatada->format('d/m/Y - H:i') . "</td>";
                                            echo "<td>$row[tecnico]</td>";
                                            echo "<td>$row[n_patrimonio]</td>";
                                            echo "<td>$row[observacoes]</td>";
                                            echo "<td>$row[enviado]</td>";
                                            echo "<td>$row[setor_nome]</td>";
                                            echo "<td>$row[localidade_nome]</td>";
                                            echo "</tr>";
                                        }

                                        // Close the connection
                                        $db->close();
                                    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                        if  (isset($_POST['mes_patrimonio'])) {
                                            $meses = array(
                                                'Janeiro' => '01',
                                                'Fevereiro' => '02',
                                                'Março' => '03',
                                                'Abril' => '04',
                                                'Maio' => '05',
                                                'Junho' => '06',
                                                'Julho' => '07',
                                                'Agosto' => '08',
                                                'Setembro' => '09',
                                                'Outubro' => '10',
                                                'Novembro' => '11',
                                                'Dezembro' => '12'
                                            );
                                            $mes_obtido = $_POST['mes_patrimonio'];
                                            $mes = explode(',', $mes_obtido);
                                            $mes_query = $meses[$mes[0]];

                                            $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                            $dados = $db->query("SELECT id_patrimonio, datahora, tecnico, n_patrimonio, observacoes, enviado, localidade_nome, setor_nome FROM patrimonio pt LEFT JOIN reg_localidades lo on lo.id_localidade = pt.id_localidade LEFT JOIN reg_setores se on se.id_setor = lo.id_setor WHERE strftime('%m', datahora) = '$mes_query';");
                                            while ($row = $dados->fetchArray()) {
                                                echo "<tr>";
                                                echo "<td>$row[id_patrimonio]</th>";
                                                // Formatando data e hora
                                                $data_formatada = new DateTime($row['datahora']);
                                                echo "<td>" . $data_formatada->format('d/m/Y - H:i') . "</td>";
                                                echo "<td>$row[tecnico]</td>";
                                                echo "<td>$row[n_patrimonio]</td>";
                                                echo "<td>$row[observacoes]</td>";
                                                echo "<td>$row[enviado]</td>";
                                                echo "<td>$row[setor_nome]</td>";
                                                echo "<td>$row[localidade_nome]</td>";
                                                echo "</tr>";
                                            }

                                            // Close the connection
                                            $db->close();
                                            }
                                    }
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
</body>
</html>
